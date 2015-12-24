<?php
/**
 * Template Name: Events & Entertainment
 */

get_header(); 

?>

<?php get_template_part('inc/events'); ?>
<?php 
 ?>
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
	<div id="primary" class="">
		<div id="content" role="main" class="wrapper">

<?php while ( have_posts() ) : the_post(); ?>

<div class="site-content">

    <header class="archive-header">
        <div class="border-title">
        	<h1><?php the_title(); ?></h1>
        </div><!-- border title -->
    </header><!-- .archive-header -->


<div class="inner-content">
    <div class="button button-thirds button-thirds-first">
    	<a href="<?php bloginfo('url'); ?>/submit-an-event">Submit an event</a>
    </div>
    <!--<div class="button button-thirds button-thirds-first">
    	<a href="<?php bloginfo('url'); ?>/submit-an-event">promote your event</a>
    </div>-->
    <div class="button button-thirds button-thirds-last">
    	<a href="<?php bloginfo('url'); ?>/event-list">view all events</a>
    </div>

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
<form id="category-select" class="button button-thirds button-thirds-first"  action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

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



<?php endwhile; // end of the loop. 


// for query of today and forward
$today = date('Ymd');
$i = 0;
// Set the date to break out of loop at the bottom
$enddate = new DateTime(date("Ymd"));
$enddate->modify('+10 day');
$stop = $enddate->format('Ymd');
/*

	Query for the Next 10 days
		
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
	'meta_key' => 'event_date',
    'meta_value' => $today,
    'meta_compare' => '>='
));
    if ($wp_query->have_posts()) : 
	while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	
	 // our Event variables
	 $title = get_the_title();
	 $permalink = get_the_permalink();
	 $image = get_field('event_image'); 
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $cost = get_field('cost_of_event');
	 $postId = get_the_ID();
	 $terms = wp_get_post_terms( $postId, 'event_category' );
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	 $eDate = $date->format('Ymd');
	 // create the array
	 
	 $mySort = array (
	 	'date' => $eDate,
		'title' => $title,
		'permalink' => $permalink,
		'location' => $location,
		'time' => $start,
		'cost' => $cost,
		'image' => $image,
		'terms' => $terms
	 );
	 
	 // put in new array
	 $newQuery[] = $mySort;
	 
	 endwhile; 
	endif; // end loop query

/*
		Comparison function for the sort
	
===========================================*/	
function cmp($a, $b) {
   $result = 0;
   
   if ( $a['date'] == $b['date'] ) {
      // Dates are same so compare names within the date.
      if ( $a['terms']['0']->slug['0'] < $b['terms']['0']->slug['0'] )
         $result = -1;
      else
         if ( $a['terms']['0']->slug['0'] > $b['terms']['0']->slug['0'] )
            $result = 1;
   }
   else {
      // Dates differ so just compare on date.
      if ( $a['date'] < $b['date'] )
         $result = -1;
      else
         $result = 1;
   }
   return $result;
}


// sort the Query
usort($newQuery,'cmp');

$prevDay = '';

	foreach ($newQuery as $value) : 
	// get the term
	$currentTerm = $value['terms']['0']->slug;
	// set the date
	$getDate = $value['date'];
	$newD = DateTime::createFromFormat('Ymd', $getDate);
	$day = $newD->format('l, F j, Y');
	// set image
	$image = $value['image']['sizes']['thumbnail'];
	// Fill in the day
	if( $getDate != $prevDay ) {
	?>
    <div class="event-page-date"><?php echo $day; ?></div>
    <?php 
	$prevDay = $getDate;
	} // if month is not empty
	// Show different if premium or featuerd
	if( $currentTerm == 'premium' || $currentTerm == 'featured' ) :
	?>
    
    <div class="featured-event">
    	<div class="featured-event-content-details">
        	<a href="<?php echo $value['permalink']; ?>">DETAILS</a>
        </div><!-- featured event content -->
        <div class="featured-event-content-details-text">DETAILS</div><!-- featured event content -->
    <div class="featured-event-image">
            <div class="featured-event-featured">
            	<div class="featured-text">FEATURED</div>
            </div><!-- featured-event-featured -->
            <?php if( $image != '' ) { ?>
                    <img src="<?php echo $image; ?>" />
            <?php } ?>
        </div><!-- featured event image -->
       <div class="featured-event-content">
        	<h2><?php echo $value['title']; ?></h2>
            <div class="fe-location"><?php echo $value['location']; ?></div>
            <div class="fe-start"><?php echo $value['time']; ?></div>
            <div class="fe-cost"><?php echo $value['cost']; ?></div>
        </div><!-- featured event content -->
     </div><!-- featured event -->
    
    <?php else: ?>
    
    <div class="eventlist">
    	<div class="featured-event-content-details">
        	<a href="<?php echo $value['permalink']; ?>">DETAILS</a>
        </div><!-- featured event content -->
        <div class="featured-event-content-details-text">DETAILS</div><!-- featured event content -->
        	<h2><?php echo $value['title']; ?></h2>
     </div><!-- event list -->
    
    <?php endif; ?>
    
<?php
// Only go out 10 days..., then get out.
if( $value['date'] >= $stop ) {break;}
// end resorted loop
endforeach;
?>


    <div class="button button-thirds button-thirds-first">
    	<a href="<?php bloginfo('url'); ?>/submit-an-event">Submit an event</a>
    </div>
    <div class="button button-thirds button-thirds-first">
    	<a href="<?php bloginfo('url'); ?>/submit-an-event">promote your event</a>
    </div>
    <div class="button button-thirds button-thirds-last">
    	<a href="<?php bloginfo('url'); ?>/event-list">view all events</a>
    </div>  
</div><!-- innter content -->
<!-- 
			Entertainment Category

======================================================== -->             
            <div class="inner-area">
<?php
// term of Entertainment Category
$term = 'category_5';
$featuredPost = get_field('post', $term);
/*

		ENTERTAINMENT CATEGORY
---------------------------------
*/
// get featured to use way at the bottom
//$post = $featuredPost; 
setup_postdata( $post ); 
//$featured = get_field('featured_post');
 wp_reset_postdata();
$i=0;
$tax = 'entertainment';
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'post',
    'posts_per_page' => 10,
    'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $tax,
		),
	),
   // 'order' => 'DESC'
));
    if ($wp_query->have_posts()) : 
	while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	
	$i++;
	
	
	// 			Get featured if one
		//   ______________________________________________________________
		if( $featuredPost ) :
		if( $i == 1 ) {
		$post = $featuredPost; 
		setup_postdata( $post ); ?>
        
        <div class="large-post">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="postthumb-full">
                 <?php the_post_thumbnail('large'); ?>
             </div><!-- post thumb -->
         <?php } ?>
                 <h2><?php the_title(); ?></h2>
                 <div class="postdate"><?php echo get_the_date(); ?></div>
             <div class="entry-content"><?php the_excerpt(); ?></div>
                <div class="q-readmore-gold"><a href="<?php the_permalink(); ?>">Read more</a></div>
        </div><!-- large post -->
		
		<?php
        wp_reset_postdata();
		$i = 2;
		}
		endif;
	?>
	
    
    <?php if( $i == 1 ) { ?>
        <div class="large-post">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="postthumb-full">
                 <?php the_post_thumbnail('thumbnail'); ?>
             </div><!-- post thumb -->
         <?php } ?>
                 <h2><?php the_title(); ?></h2>
                 <div class="postdate"><?php echo get_the_date(); ?></div>
             <div class="entry-content"><?php the_excerpt(); ?></div>
                <div class="q-readmore-gold"><a href="<?php the_permalink(); ?>">Read more</a></div>
        </div><!-- large post -->
    <?php } else { 
	
	
	if ( has_post_thumbnail() ) {
		$smallClass = 'small-post-content';
	} else {
		$smallClass = 'small-post-content-full';
	}
	
	
	
	?>
    
    <div class="small-post">
            <a href="<?php the_permalink(); ?>">
           
            <?php if ( has_post_thumbnail() ) { ?>
             <div class="small-post-thumb">
						<?php the_post_thumbnail('thumbnail'); ?>
                 </div><!-- small post thumb -->
              <?php } ?>
            
            <div class="<?php echo $smallClass; ?>">
                <h3><?php echo $tax; ?></h3>
                <div class="clear"></div>
                <h2><?php the_title(); ?></h2>
            </div><!-- small post content -->
            </a>
    </div><!-- smalll post -->
		
	<?php } ?>
    
    
<?php 	endwhile; endif; ?> 
            </div><!-- inner area -->
            
            </div><!-- site content -->
            
<!-- 
			Ad Zone

======================================================== -->        
        <div class="widget-area">
        	<?php 
			get_template_part('ads/right-big'); 
			get_template_part('ads/right-small');
			get_template_part('ads/right-rail');
			?>
        </div><!-- widget area -->
        
        </div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>