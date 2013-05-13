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
<!-- Programatic twitter -->

<script type="text/javascript">
    jQuery(document).ready(function($){

        function twitterShare () {
            // Get the unique portfolio item URL as well as the title of the post 
            var pageURL = $('.portfolio h3 a').attr('href');
            console.log(pageURL);

            var postTitle = $('.portfolio h3 a').text()
            console.log(postTitle);

            //Place the variables inside the twitter button widget
            var twitterButton = '<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+pageURL+'" data-text="'+postTitle+'" data-via="CUnwrapped" data-hashtags="CUnwrapped" style="display:none">Tweet</a>';
            console.log(twitterButton);

            // Now put that code at the end of the entry content and fade it in

            $('.ajaxcontent').append(twitterButton);

            $('.ajaxcontent .twitter-share-button').fadeIn('slow');
        }

        //Make this function fire when a person clicks on a slide post only if it is inside the homepage
        $("body").on("mouseenter", "#ajaxouter", function(){
                if (document.URL === "http://collegeunwrapped.com/"){
                    console.log('Hovered into ajax');
                    twitterShare();
                    $.getScript('http://platform.twitter.com/widgets.js');
                }
            });
        $("body").on("mouseleave", "#ajaxouter", function(){
            $('#ajaxouter .twitter-share-button').remove();
            });
    })
</script>


<!-- Close Site Container
  ================================================== -->
</body>
</html>