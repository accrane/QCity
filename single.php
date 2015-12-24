<?php
/**
 * The Template for displaying all single posts
 *
 */

get_header(); 

if( in_category('6') ) {
	get_template_part('ads/leaderboard-interior-health');
} else {
	get_template_part('ads/leaderboard-interior');
}
?>

	<div id="primary" class="">
		<div id="content" role="main" class="wrapper">

<!-- 
			Main Content

======================================================== --> 			
			<div class="site-content">
			<?php while ( have_posts() ) : the_post(); 
			$id = get_the_ID();
			$terms = get_the_terms($id, 'category');
			$video = get_field( 'video_single_post' );
			$storyImage = get_field( 'story_image' );
			$title = $storyImage['title'];
			$alt = $storyImage['alt'];
			$size = 'large';
			$thumb = $storyImage['sizes'][ $size ];
			?>

				<header class="archive-header">
				<div class="border-title">
                    <div class="catname"><?php $category = get_the_category( $id );
echo $category[0]->cat_name;?></div>
                </div><!-- border title -->
				</header><!-- .archive-header -->
                
                <div class="entry-content">
                <?php 
				 	if( $video != '' ) :
						echo $video;
					else:
				 	if ( $storyImage != '' ) { 
					
					/*echo '<pre>';
					print_r($storyImage);
					echo '</pre>';*/
					
					?>
                   <div class="f_image">
						<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" title="<?php echo $title; ?>" />
                      
							<?php echo $storyImage['caption'] ?>
                     
                   </div>   
                 <?php } endif;?>
                 
                <h1 class="posttitle"><?php the_title(); ?></h1> 
				 
                    
                <div class="clear"></div>
                
                <div class="author">
                <?php $guestAuthor = get_field('author_name');
					if( $guestAuthor != '' ) {
						echo $guestAuthor;
					} else { ?>
                By <?php echo get_the_author(); } ?>
                </div><!-- author -->
                <div class="postdate"><?php echo get_the_date(); ?></div>
                	<?php the_content(); ?>
                </div><!-- entry content -->
                
                 <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="recommend" data-show-faces="true" data-share="true"></div>
                 
                 <div class="clear"></div>
                 
                <div class="footer-meta">
                	Categorized: <?php the_category(', '); ?>
                </div><!-- footer meta -->
                
                <!-- Your like button code -->
   
                
                
                <div class="author-info">
                <?php 
						if( $guestAuthor != '' ) { ?>
							<div class="author-description">
								<h2><?php echo $guestAuthor; ?></h2>
                          </div><!-- author desc -->
						<?php } else { ?>
					<div class="author-avatar">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
                    <?php } ?>
				</div><!-- .author-info -->
                

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
        	<?php 
			if( in_category('6') ) {
				get_template_part('ads/right-big-health'); 
			} else {
				get_template_part('ads/right-big'); 
			} ?>
            <?php 
			if( in_category('6') ) {
				get_template_part('ads/right-small-health'); 
			} else {
				get_template_part('ads/right-small'); 
			} ?>
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
<?php get_template_part('inc/events'); ?>
	

<?php get_footer(); ?>