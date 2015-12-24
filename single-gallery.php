<?php
/**
 * The Template for displaying all Gallery Single Posts
 *
 */

get_header(); ?>
<script type='text/javascript'>
// Single view PHoto gallery
/*$(document).ready(function() {
    fixFlexsliderHeight();
});

$(window).load(function() {
    fixFlexsliderHeight();
});

$(window).resize(function() {
    fixFlexsliderHeight();
});*/


	
	
jQuery(document).ready(function ($) {
	$('.photos').flexslider({
          animation: "slide",
		  //smoothHeight:true,
		   controlNav:true,
          animationSpeed: 400,
          animationLoop: false,
		  slideshow: false,
          //itemMargin: 5,
          minItems: 1,
          maxItems: 1,
		  start: function(slider){
            $('body').removeClass('loading');
            flexslider = slider;
				slider.find('.current-slide').text(slider.currentSlide+1);
    			slider.find('.total-slides').text(slider.count);
          },
		  after: function(slider) {
				slider.find('.current-slide').text(slider.currentSlide+1);
				slider.find('.total-slides').text(slider.count);
			}
        });
		
	function fixHeight() {
      var maxHeight = 0,
          slides = el.find('.slides'),
          data = el.data('flexslider');
      slides.children()
        .height('auto')
        .each(function() {
          maxHeight = Math.max(maxHeight, $(this).height());
        })
        .height(maxHeight);
      slides.height(maxHeight);
      data && (data.h = maxHeight);
    }
    win.load(fixHeight);
    win.resize($.throttle ? $.throttle(250, fixHeight) : fixHeight);
    fixHeight();
		
});
</script>
	<div id="primary" class="">
		<div id="content" role="main" class="wrapper">

<!-- 
			Main Content

======================================================== --> 			
			<div class="site-content">
			<?php while ( have_posts() ) : the_post(); 
			
			?>

				<header class="archive-header">
				<div class="border-title">
                    <h1><?php the_title();?></h1>
                </div><!-- border title -->
				</header><!-- .archive-header -->
                
                
                
                 
                   <?php if(have_rows('photos')) : ?>
                   <div class="photos">
                   
                   <div class="slidecounter">
                       <div class="current-slide"></div>
                       <div class="of">of</div> 
                       <div class="total-slides"></div>
                   </div>
                   
          				<ul class="slides">
                   
				   <?php while(have_rows('photos')) : the_row(); 
				   		$photo = get_sub_field('photo');
						$size = 'large'; 
						$thumb = $photo['sizes'][ $size ];
						/*echo '<pre>';
						print_r($photo);
						echo '</pre>';*/
				   ?>
                   <li>
                   	<img src="<?php echo $thumb; ?>" />
                    <figcaption>
							<?php echo $photo['caption']; ?>
                        </figcaption>
                    </li>
                
                   <?php endwhile; ?>
                   
                   
                   </ul>
                   </div>
                   <?php endif; ?>
                   
                <div class="entry-content below-gallery">
                	<?php the_content(); ?>
                </div><!-- entry content -->
                

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'twentytwelve' ) . '</span> previous' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', 'next <span class="meta-nav">' . _x( '', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php //comments_template( '', true );
				echo do_shortcode('[fbcomments width="375" count="off" num="5" countmsg="comments!"]');
				
				 ?>

			<?php endwhile; // end of the loop. ?>
            </div><!-- entry content -->
            
<!-- 
			Ad Zone

======================================================== -->        
        <div class="widget-area">
        	<?php get_template_part('ads/right-big'); ?>
            <?php get_template_part('ads/right-small'); ?>
        </div><!-- widget area -->
        
        <div class="clear"></div>
        
<!-- 
			Related Posts

======================================================== --> 
 			<?php  wp_related_posts(); ?>
            <div class="clear"></div>
            
            
</div><!-- #content -->
	</div><!-- #primary -->
    
    
<!-- 
			Events

======================================================== --> 
<?php //get_template_part('inc/events'); ?>



		

<?php get_footer(); ?>