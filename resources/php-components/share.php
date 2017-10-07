<div class="share">

<?php 
	$domain = get_page_link();
	$urlencode_domain = urlencode( $domain );
	$domain = preg_replace('#^https?://#', '', rtrim($domain,'/'));
?>

	<span class="c-share__title">Dela:</span>

	<div class="c-share__facebook-wrap" data-href="http://<?php echo $domain ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlencode_domain; ?>&amp;src=sdkpreparse"><div class="c-share__facebook"></div></a></div>

	<a class="c-share__twitter" href="https://twitter.com/intent/tweet?url=<?php echo $urlencode_domain ?>"></a>
</div>
