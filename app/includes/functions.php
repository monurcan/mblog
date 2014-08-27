<?php
/**
 * Mini Blog Script
 * @author Mehmet Onurcan KAYA <monurcan55@gmail.com>
 * @version 1.0
 * @since: 2013
*/

use dflydev\markdown\MarkdownParser;
use \Suin\RSSWriter\Feed;
use \Suin\RSSWriter\Channel;
use \Suin\RSSWriter\Item;

function sortFunction($a, $b){
	$arra = explode('_', $a);
	$arrb = explode('_', $b);
	preg_match('#([0-9]+)-([0-9]+)-([0-9]+)#is', $arra[0], $resultsa);
	preg_match('#([0-9]+)-([0-9]+)-([0-9]+)#is', $arrb[0], $resultsb);

	return strtotime($resultsb[0]) - strtotime($resultsa[0]);
}

function get_post_names($category){
	static $_cache = array();

	if(empty($_cache)){
		if(isset($category)){
			$_cache = array_reverse(glob('posts/'.$category.'/*.md'));
		}else {
			$_cache = array_reverse(glob('posts/*/*.md'));
		}
	}
	usort($_cache, "sortFunction");
	return $_cache;
}

function get_page_names(){
	static $_cache = array();

	if(empty($_cache)){
		$_cache = array_reverse(glob('pages/*.md'));
	}
	
	return $_cache;
}

function get_posts($page = 1, $perpage = 0, $category){
	if($perpage == 0){
		$perpage = config('posts.perpage');
	}

	if(!isset($p)){
		$posts = get_post_names($category);
	}else {
		$posts = get_post_names($category, 1);
	}

	$posts = array_slice($posts, ($page-1) * $perpage, $perpage);
	$tmp = array();

	$md = new MarkdownParser();
	foreach($posts as $k=>$v){
		$post = new stdClass;
		$arr = explode('_', $v);
		preg_match('#([0-9]+)-([0-9]+)-([0-9]+)#is', $arr[0], $results);
		preg_match('#\/(.*)\/#is', $arr[0], $category);
		$post->date = strtotime($results[0]);
		$post->category = strtr(trim($category[0], "/"), '-', ' ');
		$post->url = site_url().date('Y/m', $post->date).'/'.str_replace('.md','',$arr[1]);
		$content = $md->transformMarkdown(file_get_contents($v));
		$arr = explode('</h1>', $content);
		$post->title = str_replace('<h1>','',$arr[0]);
		preg_match('#<img src="(.*)" alt#is', $arr[1], $t);
		$post->thumb = isset($t[1]) ? $t[1] : "/assets/img/thumb.jpg";
		$post->body = preg_replace('#<h4>(.*)</h4>#is', '', preg_replace('#<p><img src="(.*)" alt="thumb(.*)" /></p>#is', '', $arr[1]));
		$tmp[] = $post;
	}

	return $tmp;
}

function get_pages($page = 1, $perpage = 0){
	if($perpage == 0){
		$perpage = config('posts.perpage');
	}

	$posts = get_page_names();
	$posts = array_slice($posts, ($page-1) * $perpage, $perpage);
	$tmp = array();

	$md = new MarkdownParser();
	
	foreach($posts as $k=>$v){
		$post = new stdClass;
		$arr = explode('_', $v);
		$post->date = strtotime(str_replace('pages/','',$arr[0]));
		$content = $md->transformMarkdown(file_get_contents($v));
		$arr = explode('</h1>', $content);
		$post->title = str_replace('<h1>','',$arr[0]);
		$post->body = $arr[1];
		$tmp[] = $post;
	}

	return $tmp;
}

function find_post($year, $month, $name){
	foreach(get_post_names() as $index => $v){
		if(strpos($v, "$year-$month") !== false && strpos($v, $name.'.md') !== false){
			$arr = get_posts($index+1, 1);
			$similar = get_post_names($arr[0]->category);
			$md = new MarkdownParser();
			for($i = 0; $i < 3; $i++){
				$arrp = explode('_', $similar[$i]);
				preg_match('#([0-9]+)-([0-9]+)-([0-9]+)#is', $arrp[0], $results);
				$url = site_url().date('Y/m', strtotime($results[0])).'/'.str_replace('.md','',$arrp[1]);
				$content = $md->transformMarkdown(file_get_contents($similar[$i]));
				$arrp = explode('</h1>', $content);
				preg_match('#<img src="(.*)" alt#is', $arrp[1], $t);
				
				$arr[0]->similar[$i] = array(str_replace('<h1>','',$arrp[0]), isset($t[1]) ? $t[1] : "/assets/img/thumb.jpg", $url);
			}
			return $arr[0];
		}
	}

	return false;
}

function find_page($title){
	foreach(get_page_names() as $index => $v){
		if(strpos($v, $title.'.md') !== false){
			$arr = get_pages($index+1,1);
			return $arr[0];
		}
	}

	return false;
}

function has_pagination($page = 1){
	$total = count(get_post_names());

	return array(
		'prev'=> $page > 1,
		'next'=> $total > $page*config('posts.perpage')
	);
}

function not_found(){
	error(404, render('404', null, false));
}

function generate_rss($posts){
	$feed = new Feed();
	$channel = new Channel();
	
	$channel
		->title(config('blog.title'))
		->description(config('blog.description'))
		->url(site_url())
		->appendTo($feed);

	foreach($posts as $p){
		$item = new Item();
		$item
			->title($p->title)
			->description($p->body)
			->url($p->url)
			->appendTo($channel);
	}
	
	echo $feed;
}

function generate_json($posts){
	return json_encode($posts);
}

function turkish_date($time){  
	$days = array("Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi");

	$months =array(NULL, "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
	
	$date = date("d",$time)." ".$months[date("n",$time)]." ".date("Y",$time).", ".$days[date("w",$time)];
	return $date;
}

function str_tolower($text){
	return str_replace(array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z", "Q", "W", "X"), array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı", "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t", "u", "ü", "v", "y", "z", "q", "w", "x"), $text);
}