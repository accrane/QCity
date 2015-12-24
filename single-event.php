<?php
/**
 * The Template for displaying all single events
 *
 * @package WordPress
 *
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main" class="wrapper">

			<?php while ( have_posts() ) : the_post(); ?>

				<header class="archive-header">
				<div class="border-title">
                    <h1><?php the_title(); ?></h1>
                </div><!-- border title -->
				</header><!-- .archive-header -->
                
                <div class="entry-content">
                <?php
                	$startDate = DateTime::createFromFormat('Ymd', get_field('event_date'));
					$endDate = DateTime::createFromFormat('Ymd', get_field('end_date'));
					//$startDateSubmitted = get_field('event_start_date_submitted'); 
					//$endDateSubmitted = get_field('event_end_date_submitted');
					$start = get_field('event_start_time');
					 $end = get_field('event_end_time');
					 $contact = get_field('event_contact');
					 $email = get_field('event_email');
					 $phone = get_field('phone');
					 $cost = get_field('cost_of_event');
					 $venueName = get_field('name_of_venue');
					 $location = get_field('venue_address');
					 $tickets = get_field('link_for_tickets_registration');
					 //$tix = get_field('website_link');
					/* if (strpos($tix, 'http://') !== false) {
					 	$tickets = $tix;
					 } else {
						$tickets = 'http://' . $tix; 
					 }*/
					  $weblink = get_field('website_link');
					 /*if (strpos($link, 'http://') !== false) {
					 	$weblink = $link;
					 } else {
						$weblink = 'http://' . $link; 
					 }*/
					 $details = get_field('details');
					 //$categories = get_field('choose_categories');
					 $postId = get_the_ID();
					 $eventCat = get_the_terms( $postId, 'event_cat' );
					 $eventCategory = $eventCat[0]->name;
					 $image = get_field('event_image'); 
					//$imageSubmitted = get_field('event_image_submitted'); 
					 $size = 'large';
					 $thumb = $image['sizes'][ $size ];
					 $eventType = get_field('event_type');
					 
					 
	 				/*echo '<pre>';
					print_r($eventCat);
					echo '</pre>';*/
				?>
    <div class="business-details">
    <?php if(has_term('featured', 'event_category')) {
		$boxClass = '';
		echo '<div class="featured-event-featured-single"><div class="featured-text">FEATURED</div></div>';
	} ?>
    
    
                <?php if( $image != '' ) { ?>
                <div class="eventimage">
                <img src="<?php echo $thumb; ?>" />
                </div>
                <?php } ?>
                
                <div class="event-single-details">
                
               <div class="fe-location date"><strong>Date:</strong>
               
              
				<?php 
			
				if ( $endDate != '' ) { 
					echo $startDate->format('m/d') . ' - ' . $endDate->format('m/d/Y');
				} elseif( $startDate != '' ) { 
					echo ' ' . $startDate->format('m/d/Y');
				} elseif( $endDateSubmitted != '' ) {
					echo $startDateSubmitted;
				} else {
					echo $startDateSubmitted . ' - ' . $endDateSubmitted;
				}
				?>
            </div><!-- date -->
            
            	<?php if( $location != '' ) { ?>
                <div class="fe-start"><strong>Location:</strong> <?php echo $location; ?></div>
                <?php } ?>
                
                <?php if( $start != '' ) { ?>
                <div class="fe-start"><strong>Start Time:</strong> <?php echo $start; ?></div>
                <?php } ?>
                
                <?php if( $end != '' ) { ?>
                <div class="fe-start"><strong>End Time:</strong> <?php echo $end; ?></div>
                <?php } ?>
                
                <?php if( $cost != '' ) { ?>
                <div class="fe-start"><strong>Cost:</strong> <?php echo $cost; ?></div>
                <?php } ?>
                
                <?php if( $venueName != '' ) { ?>
                <div class="fe-start"><strong>Venue:</strong> <?php echo $venueName; ?></div>
                <?php } ?>
                
                <?php if( $eventCat != '' ) { ?>
                <div class="fe-start"><strong>Type of Event:</strong>
                <?php echo $eventCat[0]->name;
						// count the number of categories, loop through them and echo
						/*$numCat = count($categories);
						$looNum = 0;
						foreach( $eventCat as $cat ) {
						$loopNum++;
							if( $loopNum == $numCat ) {
								echo $cat[0]->name;
							} else {
								echo $cat[0]->name . ', '; 
							}
						}*/
					?>
                
                </div>
                <?php } ?>
                
                <?php if( $contact != '' ) { ?>
                <div class="fe-start"><strong>Contact:</strong> <?php echo $contact; ?></div>
                <?php } ?>
                
                <?php if( $phone != '' ) { ?>
                <div class="fe-start"><strong>Contact Phone:</strong> <?php echo $phone; ?></div>
                <?php } ?>
                
                <?php if( $email != '' ) { ?>
                <div class="fe-start"><strong>Contact Email:</strong>
                		<a href="mailto:<?php echo antispambot($email); ?>">
                          <?php echo antispambot($email); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php if( $tickets != '' ) { ?>
                <div class="fe-website"><a target="_blank" href="<?php echo $tickets; ?>">Tickets</a></div>
                <?php } ?>
                <div class="clear"></div>
                <?php if( $weblink != '' ) { ?>
                <div class="fe-website"><a target="_blank" href="<?php echo $weblink; ?>">visit website</a></div>
                <?php } ?>
                
                
                
                
                </div><!-- event single details -->
                <div class="clear"></div>
              <?php echo $details; ?>
					<?php the_content(); ?>
                </div><!-- business details -->
<div class="single-event-dropdown">
<script>
    $(function(){
      // bind change event to select
      $('#eventtype').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
	
</script>                
                <?php 
$url = get_bloginfo('url');
$cDir = $url . '/event-list';
//echo $url;

$denomargs = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => true, 
    'fields'            => 'all', 
); 

$dterms = get_terms('event_cat', $denomargs);

/*echo '<pre>';
print_r($dterms);
echo '<pre>';*/
?>
<form id="category-select" class=""  action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

        <select name='eventtype' id='eventtype' class="eventtype"  >
        	<?php 
			echo '<option class="">View by Event Type</option>';
			echo '<option class="" value="' . $cDir . '">All</option>';
			foreach( $dterms as $dterm ) :
				echo '<option class="level-0" value="'.$url.'/event-category/'.$dterm->slug.'">'.$dterm->name.'</option>';
			endforeach;
			
			?>
        </select>

		<noscript>
			<input type="submit" value="View" />
		</noscript>
</form>
                
  </div><!-- signle event dropdown -->               
              
               
                <?php /*$time_date = get_field('event_date');
			$endDate = get_field('end_date');
			$post_date = substr($time_date, 0, 10);
						print_r($post_date);*/ ?>
                
					</div><!-- .entry-content -->
<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="recommend" data-show-faces="true" data-share="true"></div>
				<?php //comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>
            
            

		</div><!-- #content -->
	</div><!-- #primary -->

<!-- 
			Ad Zone

======================================================== -->        
        <div class="widget-area">
        	<?php get_template_part('ads/right-big'); ?>
        </div><!-- widget area -->
        
<?php get_footer(); ?>