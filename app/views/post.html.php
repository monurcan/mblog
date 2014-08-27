<div class="post">
    <div class="thumb <?php echo $p->category; ?>" style="background: url('<?php echo $p->thumb ?>'); background-size: cover; ">
        <div></div>
        <a href="<?php echo site_url()."blog/".strtr($p->category, ' ', '-') ?>"><span><?php echo $p->category ?></span></a>
    </div>
	<h3><?php echo $p->title ?></h3>
    <ul class="details">
        <li><div class="icon date"></div><?php echo turkish_date($p->date) ?></li>
        <li><div class="icon view"></div>Mehmet Onurcan KAYA</li>
        <li><div class="icon comment"></div><a href="<?php echo $p->url ?>#disqus_thread"></a></li>
    </ul>
	<article>
        <?php echo $p->body ?>
        <ul class="social">
            <li><div class="icon face-bg"><div class="fb-like" data-href="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></div></li>
            <li><div class="icon twitter-bg"><a href="https://twitter.com/share" class="twitter-share-button" data-text="Bir makaleyi beğendim:" data-via="monurcan">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div></li>
            <li><div class="icon google-bg"><div class="g-plusone" data-size="medium"></div></div></li>
            <li>
                <div class="icon download"></div>
                <span>DOSYALARI INDIR</span>
                <span>
                    <span class="icon view"></span>
                </span>
            </li>
        </ul>
    </article>
</div>

<div class="similar">
    <h3><span>ILGINIZI ÇEKEBILECEK DIGER YAZILAR</span></h3>
    <?php foreach($p->similar as $key){
    ?>
    <div class="p"><a href="<?php echo $key[2]; ?>">
        <img src="<?php echo $key[1]; ?>" />
        <span><?php echo $key[0]; ?></span>
    </a></div>
    <?php
    } ?>
</div>

<div class="commentt">
    <h3><span>YAZI HAKKINDA GÖRÜSLERINIZI BILDIRIN</span></h3>
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = 'denemeblogphpmarkdown'; // required: replace example with your forum shortname
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript><a href="http://disqus.com/?ref_noscript">Yorumları.</a> görebilmek için lütfen tarayıcınızda JavaScript'i etkinleştirin.</noscript>
</div>

<div id="fb-root"></div>
<script type="text/javascript">
var disqus_shortname = 'denemeblogphpmarkdown';
(function () {
    var s = document.createElement('script'); s.async = true;
    s.type = 'text/javascript';
    s.src = '//' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=459122204112507&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'tr'}
</script>