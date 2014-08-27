<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title) ? _h($title) : config('blog.title') ?><?php echo isset($title) ? '' : ' | '.config('blog.description') ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" user-scalable="no" />
	<meta name="description" content="<?php echo config('blog.description')?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php echo config('blog.title')?>  Feed" href="<?php echo site_url()?>rss" />
	<link href="<?php echo site_url() ?>assets/css/style.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
		var effect = function(){
			$(".effect:eq(1)").css("width", $(".logo").offset().left + 245);
			$(".effect:eq(2)").css("width", $(".logo").offset().left + 280);
			$(".effect:eq(0)").css("width", $(".logo").offset().left + 310);
		}
		$(function(){
			effect();
			$(window).on("resize", function(){
				effect();
			});

			$(document).scroll(function(){
				if($(document).scrollLeft() != 0){
					$(document).scrollLeft(0);
				}
			});

			$.getJSON('<?php echo site_url(); ?>last-comments.txt', function(data){
				var total = data.length, i = 0;
				for(i; i < total; i++){
					$("#container #menu ul.comments li:eq(" + i + ") h4").html("<a href='" + data[i].pageURL + "'>" + data[i].pageTitle.replace(" | M. Onurcan KAYA", "").substr(0, 13) + "...</a> için <a href='" + data[i].authorProfileURL + "'><b>" + data[i].authorName.substr(0, 11) + "</b></a>").siblings("span").text(data[i].message).siblings("img").attr("src", data[i].authorAvatar);
				}
			});
		});
	</script>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<!-- HEADER -->
	<header>
		<div>
			<!-- Logo -->
			<a href="<?php echo site_url() ?>" class="logo">
				m.onurcan<b>kaya<span>.</span></b>
				<p><?php echo config('blog.description')?></p>
			</a>
			<!--#Logo -->
			
			<!-- Menu -->
			<ul>
				<li <?php echo !isset($title) ? 'class="active"' : null ?>><a href="<?php echo site_url() ?>">Anasayfa</a></li>
				<li <?php echo @$title == 'Hakkımda | '.config('blog.title') ? 'class="active"' : null ?>><a href="<?php echo site_url() ?>page/about">Hakkımda</a></li>
				<li <?php echo @$title == 'Kütüphane | '.config('blog.title') ? 'class="active"' : null ?>><a href="<?php echo site_url() ?>lib">Kütüphane</a></li>
				<li <?php echo (@$title == 'Blog | '.config('blog.title') || @post == 1) ? 'class="active"' : null ?>><a href="<?php echo site_url() ?>blog">Blog</a></li>
				<li <?php echo @$title == 'İletişim | '.config('blog.title') ? 'class="active"' : null ?>><a href="<?php echo site_url() ?>page/contact">Iletisim</a></li>
			</ul>
			<!--#Menu -->

			<!-- Search -->
			<form action="/search/" method="GET">
				<input type="text" name="q" placeholder="arama yap." autocomplete="off">
				<button>
					<div class="icon"></div>
				</button>
			</form>
			<!--#Search -->

			<!-- Effects -->
			<div class="effect" style="opacity: 0.14; "></div>
			<div class="effect"></div>
			<div class="effect"></div>
			<!-- #Effects -->
		</div>
	</header>
	<!-- [END]HEADER -->

	<!-- TITLE -->
	<?php if(isset($title) && @post != 1): ?>
	<div id="title">
		<p>
			.<?php echo str_tolower(preg_replace("/\| ".config('blog.title').'/', null, $title)) ?>
		</p>
	</div>
	<?php endif ?>
	<!-- [END]TITLE -->
	
	<?php if(!isset($title)): ?>
		<div class="popular_posts_bg"></div>
	<?php endif ?>

	<!-- CONTAINER -->
	<section id="container" <?php echo (@$title == 'Kütüphane | '.config('blog.title') || @$title == 'Blog | '.config('blog.title') || @post == 1) ? 'style="border-right: 1000px solid #fff; "' : null ?>>
		<?php if(@$title == 'Kütüphane | '.config('blog.title') || @$title == 'Blog | '.config('blog.title') || @post == 1): ?>
			<!-- MENU -->
			<aside id="menu">
				<div class="sidebar">
					<h2><span>Sosyal Aglar</span></h2>
					<div class="social">
						<a href="#"><span class="icon face"></span></a>
						<a href="#"><span class="icon twitter"></span></a>
						<a href="#"><span class="icon google"></span></a>
						<a href="#"><span class="icon youtube"></span></a>
						<a href="<?php echo site_url() ?>rss"><span class="icon rss"></span></a>
					</div>
				</div>
				<div class="subs">
					<h4>ABONE OL</h4>
					<div><input type="email" placeholder="E-posta adresinizi girin, entera basın."></div>
				</div>
				<div class="sidebar">
					<h2><span>Son Yorumlar</span></h2>
					<ul class="comments">
						<li>
							<img src="<?php echo site_url() ?>assets/img/avatar.png" width="54" height="54">
							<h4>Yorumlar <b>Yükleniyor...</b></h4>
							<span>Lütfen bekleyin, yorumlar yükleniyor...</span>
						</li>
						<li>
							<img src="<?php echo site_url() ?>assets/img/avatar.png" width="54" height="54">
							<h4>Yorumlar <b>Yükleniyor...</b></h4>
							<span>Lütfen bekleyin, yorumlar yükleniyor...</span>
						</li>
						<li>
							<img src="<?php echo site_url() ?>assets/img/avatar.png" width="54" height="54">
							<h4>Yorumlar <b>Yükleniyor...</b></h4>
							<span>Lütfen bekleyin, yorumlar yükleniyor...</span>
						</li>
						<li>
							<img src="<?php echo site_url() ?>assets/img/avatar.png" width="54" height="54">
							<h4>Yorumlar <b>Yükleniyor...</b></h4>
							<span>Lütfen bekleyin, yorumlar yükleniyor...</span>
						</li>
					</ul>
				</div>
				<div class="sidebar">
					<h2><span>Sponsor Baglantilar</span></h2>
					<ul class="sponsors">
						<li>133 x 133<br>REKLAM ALANI</li>
						<li>133 x 133<br>REKLAM ALANI</li>
						<li>133 x 133<br>REKLAM ALANI</li>
						<li>133 x 133<br>REKLAM ALANI</li>
					</ul>
				</div>
				<a href="#"><div class="donate">
					<div class="icon cola"></div>
					<span>BI' TANE KOLA ISMARLA</span>
				</div></a>
			</aside>
			<!-- [END]MENU -->
		<?php endif ?>

		<!-- CONTENT -->
		<div id="<?php echo (@$title == 'Kütüphane | '.config('blog.title') || @$title == 'Blog | '.config('blog.title') || @post == 1) ? 'n' : null ?>content">
			<?php echo content(); ?>
		</div>
		<!-- [END]CONTENT -->
	
		<!-- FOOTER -->
		<footer>
			<div>
				<b>&copy; Copyleft 2014</b> / <span>Mehmet Onurcan KAYA</span> - GNU General Public Licence.

				<section class="right">
					<div>.nebula<span>script</span></div>
					<a href="#" class="button">hemen indir!</a>
				</section>
			</div>
		</footer>
		<!-- [END]FOOTER -->
	</section>
	<!-- [END]CONTAINER -->
</body>
</html>