<table id="categories">
	<tr>
		<td><a href="<?php echo site_url() ?>blog/php-notlari" <?php echo $category == 'php-notlari' ? 'class="active"' : null ?>><div class="icon php"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/js-dersleri" <?php echo $category == 'js-dersleri' ? 'class="active"' : null ?>><div class="icon jquery"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/css-molasi" <?php echo $category == 'css-molasi' ? 'class="active"' : null ?>><div class="icon css"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/biraz-da-html" <?php echo $category == 'biraz-da-html' ? 'class="active"' : null ?>><div class="icon html"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/java-egitimi" <?php echo $category == 'java-egitimi' ? 'class="active"' : null ?>><div class="icon java"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/mobil" <?php echo $category == 'mobil' ? 'class="active"' : null ?>><div class="icon andro"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/wp-kodlari" <?php echo $category == 'wp-kodlari' ? 'class="active"' : null ?>><div class="icon wp"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/tasarim-ipuclari" <?php echo $category == 'tasarim-ipuclari' ? 'class="active"' : null ?>><div class="icon design"></div></a></td>
		<td><a href="<?php echo site_url() ?>blog/diger" <?php echo $category == 'diger' ? 'class="active"' : null ?>><div class="icon phs"></div></a></td>
	</tr>
	<tr>
		<td><a href="<?php echo site_url() ?>blog/php-notlari" <?php echo $category == 'php-notlari' ? 'class="active"' : null ?>>PHP Notları</a></td>
		<td><a href="<?php echo site_url() ?>blog/js-dersleri" <?php echo $category == 'js-dersleri' ? 'class="active"' : null ?>>JS Dersleri</a></td>
		<td><a href="<?php echo site_url() ?>blog/css-molasi" <?php echo $category == 'css-molasi' ? 'class="active"' : null ?>>CSS Molası</a></td>
		<td><a href="<?php echo site_url() ?>blog/biraz-da-html" <?php echo $category == 'biraz-da-html' ? 'class="active"' : null ?>>Biraz da HTML</a></td>
		<td><a href="<?php echo site_url() ?>blog/java-egitimi" <?php echo $category == 'java-egitimi' ? 'class="active"' : null ?>>Java Egitimi</a></td>
		<td><a href="<?php echo site_url() ?>blog/mobil" <?php echo $category == 'mobil' ? 'class="active"' : null ?>>Mobil</a></td>
		<td><a href="<?php echo site_url() ?>blog/wp-kodlari" <?php echo $category == 'wp-kodlari' ? 'class="active"' : null ?>>WP Kodları</a></td>
		<td><a href="<?php echo site_url() ?>blog/tasarim-ipuclari" <?php echo $category == 'tasarim-ipuclari' ? 'class="active"' : null ?>>Tasarım İpuçları</a></td>
		<td><a href="<?php echo site_url() ?>blog/diger" <?php echo $category == 'diger' ? 'class="active"' : null ?>>Diğer</a></td>
	</tr>
</table>

<?php foreach($posts as $p):?>
	<div class="posts">
		<h3><a href="<?php echo $p->url ?>"><?php echo $p->title ?></a></h3>
		<article><?php echo substr($p->body, 0, 410) ?></article>
		<div class="thumb <?php echo $p->category; ?>" style="background: url('<?php echo $p->thumb; ?>'); background-size: cover; ">
			<div></div>
			<span><?php echo $p->category ?></span>
		</div>
		<a href="<?php echo $p->url ?>"><div class="read_m">DEVAMINI OKU</div></a>
	</div>
<?php endforeach;?>

<?php if(ceil(count(get_post_names()) / config('posts.perpage')) != 1): ?>
<ul class="paginition">
<?php if ($has_pagination['prev']):?>
	<a href="?page=<?php echo $page-1?>"><li class="newer"><span><</span></li></a>
<?php endif;?>

<?php
	for($i = 1; $i <= ceil(count(get_post_names()) / config('posts.perpage')); $i++){
		echo "<a href='?page=".$i."'><li";
		echo $page == $i ? " class='active'" : null;
		echo ">".$i."</li></a>";
	}
?>

<?php if ($has_pagination['next']):?>
	<a href="?page=<?php echo $page+1?>"><li class="older"><span>></span></li></a>
<?php endif;?>
</ul>
<?php endif;?>

<script type="text/javascript">
$(function(){
	$("#categories tr td").hover(function(){
		$("#categories tr td").removeClass("hover");
		$("#categories tr:nth-child(1) td:eq("+ $(this).index() +")").addClass("hover");
		$("#categories tr:nth-child(2) td:eq("+ $(this).index() +")").addClass("hover");
	}, function(){
		$("#categories tr td").removeClass("hover");
	});
});
</script>