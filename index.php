<?php
require 'vendor/autoload.php';
require 'app/includes/dispatch.php';
require 'app/includes/functions.php';

error_reporting(0);
config('source', 'app/config.ini');
get('/index', function(){
	$posts = get_posts(1, 10);
	
    render('main', array(
		'posts' => $posts,
		'has_pagination' => has_pagination(1)
	));
});

// Blog
get('/blog', function(){
	$page = from($_GET, 'page');
	$page = $page ? (int)$page : 1;
	
	$posts = get_posts($page);
	
	if(empty($posts) || $page < 1){
		not_found();
	}

	render('blog', array(
		'page' => $page,
		'posts' => $posts,
		'has_pagination' => has_pagination($page),
		'title' => 'Blog | '.config('blog.title')
	));
});

// Blog categories
get('/blog/:cat', function($cat){
	$page = from($_GET, 'page');
	$page = $page ? (int)$page : 1;

	$posts = get_posts($page, 0, $cat);
	
	if(empty($posts) || $page < 1){
		not_found();
	}
	
	render('blog', array(
		'page' => $page,
		'posts' => $posts,
		'has_pagination' => has_pagination($page),
		'category' => $cat,
		'title' => 'Blog | '.config('blog.title')
	));
});

// The post page
get('/:year/:month/:name', function($year, $month, $name){
	$post = find_post($year, $month, $name);
	define('post', 1);

	if(!$post){
		not_found();
	}

	render('post', array(
		'title' => $post->title.' | '.config('blog.title'),
		'p' => $post
	));
});

// Search
get('/search/:q', function($q){
	echo "arama burda";
});

// The JSON API
get('/api/json', function(){
	header('Content-type: application/json');
	echo generate_json(get_posts(1, 10));
});

// Show the RSS feed
get('/rss', function(){
	header('Content-Type: application/rss+xml');
	echo generate_rss(get_posts(1, 30));
});

// Private pages
get('/page/:title', function($title){
	$page = find_page($title);

	if(!$page){
		not_found();
	}

	render('page', array(
		'title' => $page->title .' | ' . config('blog.title'),
		'p' => $page
	));
});

get('.*',function(){
	not_found();
});

// Serve the blog
dispatch();