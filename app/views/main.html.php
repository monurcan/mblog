<ul class="popular_posts">
	<li class="imp">
		<div class="details">
			<span>JAVA</span>DENEME YAZI BURADA
		</div>
		<img src="<?php echo config("blog.siteurl") ?>assets/img/thumbL.png">
	</li>
	<li><img src="<?php echo config("blog.siteurl") ?>assets/img/thumb.jpg"></li>
	<li><img src="<?php echo config("blog.siteurl") ?>assets/img/thumb.jpg"></li>
	<li><img src="<?php echo config("blog.siteurl") ?>assets/img/thumb.jpg"></li>
	<li><img src="<?php echo config("blog.siteurl") ?>assets/img/thumb.jpg"></li>
	<li><img src="<?php echo config("blog.siteurl") ?>assets/img/thumb.jpg"></li>
	<li><img src="<?php echo config("blog.siteurl") ?>assets/img/thumb.jpg"></li>

	<div class="hello">
		<?php echo config('blog.authorbio'); ?>
	</div>
</ul>

<div style="height: 330px; "></div>

<div class="modal">
	<h1><span>ULUSA</span> SESLENİS</h1>
	<p>
		<iframe width="321" height="230" src="//www.youtube.com/embed/INHVxA-rM48?rel=0" frameborder="0" allowfullscreen></iframe>
	</p>
</div>

<div class="modal">
	<h1>BEN <span>KİMİM Kİ</span></h1>
	<p>
		<img src="<?php echo site_url() ?>assets/img/thumb.jpg">
		<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut accumsan ligula neque, id imperdiet lorem scelerisque eu. Proin risus non feugiat deneme asd example</span><div style="margin-bottom: -18px; "></div> risus non feugiat molestie, massa augue egestas est, quis volutpat augue ligula et nibh. Vivamus in nisi adipiscing, semper magna in, tincidunt enim. Aenean pellentesque eleifend pharetra. In non augue sed diam placerat viverra. Suspendisse in turpis in ante pharetra ullamcorper. <a href="<?php echo site_url() ?>page/about">{devamı}</a>
	</p>
</div>

<div class="modal">
	<h1><span>TWİTTER'DAN</span> İNCİLER</h1>
	<p class="twitter">
		<inline style="position: relative; top: 12px; left: 12px; ">Tweetler yükleniyor, bekleyin...</inline>
	</p>
</div>
<script type="text/javascript">
	$(function(){
		function parseTwitterDate(tdate) {
			var system_date = new Date(Date.parse(tdate));
			var user_date = new Date();
			var diff = Math.floor((user_date - system_date) / 1000);
			if (diff <= 1) {return "şuan";}
			if (diff < 20) {return diff + " saniye önce";}
			if (diff <= 3540) {return Math.round(diff / 60) + " dakika önce";}
			if (diff <= 5400) {return "1 saat önce";}
			if (diff <= 86400) {return Math.round(diff / 3600) + " saat önce";}
			if (diff <= 129600) {return "1 gün önce";}
			if (diff < 604800) {return Math.round(diff / 86400) + " gün önce";}
			if (diff <= 777600) {return "1 hafta önce";}
			return "on " + system_date;
		}
		
		var $twitter = $('.twitter');
		$.getJSON('<?php echo site_url(); ?>tweets.txt', function(data){
			var total = data.length, i = 0;
			$twitter.html('');
			for (i; i < total; i++){
				var tweet = data[i].text;
				var date = parseTwitterDate(data[i].created_at);
				var url = 'https://twitter.com/' + data[i].user.screen_name +'/status/' + data[i].id_str;
				$twitter.append('<div class="tweet"><a href="' + url + '">' + tweet + '</a> (' + date + ')</div>');
			}
		});
	});
</script>
<style>
	#container {
		min-height: 1px!important;
	}
</style>