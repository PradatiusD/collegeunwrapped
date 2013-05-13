</div>
<!-- Close Mainbody and start footer
  ================================================== -->
<div class="clear"></div>
<div id="footer">
    <div class="container clearfix">
    	<div class="four columns"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left') ) ?></div>
        <div class="four columns"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left Center') ) ?> </div>
        <div class="four columns"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right Center') ) ?></div>
        <div class="four columns"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right') ) ?></div>
        <div class="clear"></div>
	</div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<!--Custom Javascript Calls-->
<script type="text/javascript" src="<?php echo home_url(); ?>/index.php?ag_customjs_var=js"></script>
<!-- Theme Hook -->
<?php wp_footer(); ?>
</div>
<!-- JQuery to remove all and force click featured -->
<script>
jQuery('.filterall').hide();
jQuery('.segment-2').eq(0).css('background','none');
jQuery(document).ready(function($){
	$('div.container.clearfix.slideshow.isotopecontainer.isotope').hide();
	setTimeout(function () {
    	$('.segment-2').eq(0).find('a').trigger('click');
    	$('div.container.clearfix.slideshow.isotopecontainer.isotope').show();  
	}, 1500);
	$('#ag_news_widget-2 a, #ag_news_widget-3 a').attr('href', 'http://kiajovanie.com/blog');
})
</script>

<!-- Close Site Container
  ================================================== -->
</body>
</html>