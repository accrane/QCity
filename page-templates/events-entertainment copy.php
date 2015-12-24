<?php
/**
 * Template Name: Events & Entertainment
 */

get_header(); ?>

<?php get_template_part('inc/events'); ?>

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
                <div class="button button-thirds button-thirds-first">
                	<a href="<?php bloginfo('url'); ?>/submit-an-event">promote your event</a>
                </div>
                <div class="button button-thirds button-thirds-last">
                	<a href="<?php bloginfo('url'); ?>/event-list">view all events</a>
                </div>
                
                
  			<?php endwhile; // end of the loop. ?>              
<!-- 
			Events Query 3 days
           

======================================================== --> 
<?php 
$today = date('Ymd');
$i = 0;
/*

		TODAY  FEATURED
		!!!!!!!!!!!!!!!!
		
		Show Premium and Featured
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => array('featured', 'premium')
		),
	),
	'meta_key' => 'event_date',
    'meta_value' => $today,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) : 
	while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 $image = get_field('event_image'); 
	 $size = 'thumbnail';
	 $thumb = $image['sizes'][ $size ];
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $cost = get_field('cost_of_event');
	 $startDateSubmitted = get_field('event_start_date_submitted'); 
	 $endDateSubmitted = get_field('event_end_date_submitted');
	 $imageSubmitted = get_field('event_image_submitted'); 
	 /*echo '<pre>';
	 print_r($image);
	 echo '</pre>';*/
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
//  run the date only once
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	?>
    
    <div class="featured-event">
    
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
    
    	<div class="featured-event-image">
        <div class="featured-event-featured">FEATURED</div>
        <?php if( $image != '' ) { ?>
        		<img src="<?php echo $thumb; ?>" />
        <?php } ?>
        </div><!-- featured event image -->
        <div class="featured-event-content">
        	<h2><?php the_title(); ?></h2>
            <div class="fe-location"><?php echo $location; ?></div>
            <div class="fe-start"><?php echo $start; ?></div>
            <div class="fe-cost"><?php echo $cost; ?></div>
        </div><!-- featured event content -->
        
    </div><!-- featured event -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		TODAY NOT FEATURED
---------------------------------
*/

// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'featured',
			'operator' => 'NOT IN',
		),
	),
	'meta_key' => 'event_date',
    'meta_value' => $today,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) :  
	while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	$date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1 
	
	?>
    
    <div class="eventlist">
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
        
        	<h2><?php the_title(); ?></h2>
        
    </div><!-- event list -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();

$i = 0;
/*echo '<pre>';
print_r($today);*/
// Add a day
$newdate = new DateTime(date("Ymd"));
$newdate->modify('+1 day');
$tomorrow = $newdate->format('Ymd');
/*echo '<pre>';
print_r($tomorrow);*/

/*

		TOMORROW  FEATURED
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => array('featured', 'premium')
		),
	),
    'meta_key' => 'event_date',
    'meta_value' => $tomorrow,
    'meta_compare' => '='
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 $image = get_field('event_image'); 
	 $size = 'thumbnail';
	 $thumb = $image['sizes'][ $size ];
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $startDateSubmitted = get_field('event_start_date_submitted'); 
	 $endDateSubmitted = get_field('event_end_date_submitted');
	 $imageSubmitted = get_field('event_image_submitted'); 
	 $cost = get_field('cost_of_event');
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	?>
    
    <div class="featured-event">
    
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
    
    	<div class="featured-event-image">
        <div class="featured-event-featured">FEATURED</div>
        <?php if( $image != '' ) { ?>
        		<img src="<?php echo $thumb; ?>" />
        <?php } ?>
        </div><!-- featured event image -->
        <div class="featured-event-content">
        	<h2><?php the_title(); ?></h2>
            <div class="fe-location"><?php echo $location; ?></div>
            <div class="fe-start"><?php echo $start; ?></div>
            <div class="fe-cost"><?php echo $cost; ?></div>
        </div><!-- featured event content -->
        
    </div><!-- featured event -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		TOMORROW NOT FEATURED
---------------------------------
*/

// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'featured',
			'operator' => 'NOT IN',
		),
	),
    'paged' => $paged,
	'meta_key' => 'event_date',
    'meta_value' => $tomorrow,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	 ?>
    
    <div class="eventlist">
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
        
        	<h2><?php the_title(); ?></h2>
        
    </div><!-- event list -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();



$i = 0;
/*echo '<pre>';
print_r($today);*/
// Add a day
$newdate = new DateTime(date("Ymd"));
$newdate->modify('+2 day');
$twoDaysOut = $newdate->format('Ymd');
/*echo '<pre>';
print_r($tomorrow);*/

/*

		Two Days  FEATURED
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => array('featured', 'premium')
		),
	),
    'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '='
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 $image = get_field('event_image'); 
	 $size = 'thumbnail';
	 $thumb = $image['sizes'][ $size ];
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $startDateSubmitted = get_field('event_start_date_submitted'); 
	 $endDateSubmitted = get_field('event_end_date_submitted');
	 $imageSubmitted = get_field('event_image_submitted'); 
	 $cost = get_field('cost_of_event');
	/* echo '<pre>';
	 print_r($image);
	 echo '</pre>';*/
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	?>
    
    <div class="featured-event">
    
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
    
    	<div class="featured-event-image">
        <div class="featured-event-featured">FEATURED</div>
        <?php if( $image != '' ) { ?>
        		<img src="<?php echo $thumb; ?>" />
        <?php } ?>
        </div><!-- featured event image -->
        <div class="featured-event-content">
        	<h2><?php the_title(); ?></h2>
            <div class="fe-location"><?php echo $location; ?></div>
            <div class="fe-start"><?php echo $start; ?></div>
            <div class="fe-cost"><?php echo $cost; ?></div>
        </div><!-- featured event content -->
        
    </div><!-- featured event -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		2 Day NOT FEATURED
---------------------------------
*/

// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'featured',
			'operator' => 'NOT IN',
		),
	),
    'paged' => $paged,
	'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	 ?>
    
    <div class="eventlist">
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
        
        	<h2><?php the_title(); ?></h2>
        
    </div><!-- event list -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();




$i = 0;
/*echo '<pre>';
print_r($today);*/
// Add a day
$newdate = new DateTime(date("Ymd"));
$newdate->modify('+3 day');
$twoDaysOut = $newdate->format('Ymd');
/*echo '<pre>';
print_r($tomorrow);*/

/*

		3 Days  FEATURED
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => array('featured', 'premium')
		),
	),
    'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '='
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 $image = get_field('event_image'); 
	 $size = 'thumbnail';
	 $thumb = $image['sizes'][ $size ];
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $startDateSubmitted = get_field('event_start_date_submitted'); 
	 $endDateSubmitted = get_field('event_end_date_submitted');
	 $imageSubmitted = get_field('event_image_submitted'); 
	 $cost = get_field('cost_of_event');
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	?>
    
    <div class="featured-event">
    
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
    
    	<div class="featured-event-image">
        <div class="featured-event-featured">FEATURED</div>
        <?php if( $image != '' ) { ?>
        		<img src="<?php echo $thumb; ?>" />
        <?php } ?>
        </div><!-- featured event image -->
        <div class="featured-event-content">
        	<h2><?php the_title(); ?></h2>
            <div class="fe-location"><?php echo $location; ?></div>
            <div class="fe-start"><?php echo $start; ?></div>
            <div class="fe-cost"><?php echo $cost; ?></div>
        </div><!-- featured event content -->
        
    </div><!-- featured event -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		3 Day NOT FEATURED
---------------------------------
*/

// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'featured',
			'operator' => 'NOT IN',
		),
	),
    'paged' => $paged,
	'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	 ?>
    
    <div class="eventlist">
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
        
        	<h2><?php the_title(); ?></h2>
        
    </div><!-- event list -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();



$i = 0;
/*echo '<pre>';
print_r($today);*/
// Add a day
$newdate = new DateTime(date("Ymd"));
$newdate->modify('+4 day');
$twoDaysOut = $newdate->format('Ymd');
/*echo '<pre>';
print_r($tomorrow);*/

/*

		4 Days  FEATURED
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => array('featured', 'premium')
		),
	),
    'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '='
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 $image = get_field('event_image'); 
	 $size = 'thumbnail';
	 $thumb = $image['sizes'][ $size ];
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $startDateSubmitted = get_field('event_start_date_submitted'); 
	 $endDateSubmitted = get_field('event_end_date_submitted');
	 $imageSubmitted = get_field('event_image_submitted'); 
	 $cost = get_field('cost_of_event');
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	?>
    
    <div class="featured-event">
    
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
    
    	<div class="featured-event-image">
        <div class="featured-event-featured">FEATURED</div>
        <?php if( $image != '' ) { ?>
        		<img src="<?php echo $thumb; ?>" />
        <?php } ?>
        </div><!-- featured event image -->
        <div class="featured-event-content">
        	<h2><?php the_title(); ?></h2>
            <div class="fe-location"><?php echo $location; ?></div>
            <div class="fe-start"><?php echo $start; ?></div>
            <div class="fe-cost"><?php echo $cost; ?></div>
        </div><!-- featured event content -->
        
    </div><!-- featured event -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		4 Day NOT FEATURED
---------------------------------
*/

// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'featured',
			'operator' => 'NOT IN',
		),
	),
    'paged' => $paged,
	'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	 ?>
    
    <div class="eventlist">
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
        
        	<h2><?php the_title(); ?></h2>
        
    </div><!-- event list -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();




$i = 0;
/*echo '<pre>';
print_r($today);*/
// Add a day
$newdate = new DateTime(date("Ymd"));
$newdate->modify('+5 day');
$twoDaysOut = $newdate->format('Ymd');
/*echo '<pre>';
print_r($tomorrow);*/

/*

		5 Days  FEATURED
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => array('featured', 'premium')
		),
	),
    'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '='
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 $image = get_field('event_image'); 
	 $size = 'thumbnail';
	 $thumb = $image['sizes'][ $size ];
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $startDateSubmitted = get_field('event_start_date_submitted'); 
	 $endDateSubmitted = get_field('event_end_date_submitted');
	 $imageSubmitted = get_field('event_image_submitted'); 
	 $cost = get_field('cost_of_event');
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	?>
    
    <div class="featured-event">
    
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
    
    	<div class="featured-event-image">
        <div class="featured-event-featured">FEATURED</div>
        <?php if( $image != '' ) { ?>
        		<img src="<?php echo $thumb; ?>" />
        <?php } ?>
        </div><!-- featured event image -->
        <div class="featured-event-content">
        	<h2><?php the_title(); ?></h2>
            <div class="fe-location"><?php echo $location; ?></div>
            <div class="fe-start"><?php echo $start; ?></div>
            <div class="fe-cost"><?php echo $cost; ?></div>
        </div><!-- featured event content -->
        
    </div><!-- featured event -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		5 Day NOT FEATURED
---------------------------------
*/

// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'featured',
			'operator' => 'NOT IN',
		),
	),
    'paged' => $paged,
	'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	 ?>
    
    <div class="eventlist">
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
        
        	<h2><?php the_title(); ?></h2>
        
    </div><!-- event list -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();



$i = 0;
/*echo '<pre>';
print_r($today);*/
// Add a day
$newdate = new DateTime(date("Ymd"));
$newdate->modify('+6 day');
$twoDaysOut = $newdate->format('Ymd');
/*echo '<pre>';
print_r($tomorrow);*/

/*

		6 Days  FEATURED
---------------------------------
*/
// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => array('featured', 'premium')
		),
	),
    'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '='
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 $image = get_field('event_image'); 
	 $size = 'thumbnail';
	 $thumb = $image['sizes'][ $size ];
	 $location = get_field('venue_address');
	 $start = get_field('event_start_time');
	 $startDateSubmitted = get_field('event_start_date_submitted'); 
	 $endDateSubmitted = get_field('event_end_date_submitted');
	 $imageSubmitted = get_field('event_image_submitted'); 
	 $cost = get_field('cost_of_event');
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	?>
    
    <div class="featured-event">
    
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
    
    	<div class="featured-event-image">
        <div class="featured-event-featured">FEATURED</div>
        <?php if( $image != '' ) { ?>
        		<img src="<?php echo $thumb; ?>" />
        <?php } ?>
        </div><!-- featured event image -->
        <div class="featured-event-content">
        	<h2><?php the_title(); ?></h2>
            <div class="fe-location"><?php echo $location; ?></div>
            <div class="fe-start"><?php echo $start; ?></div>
            <div class="fe-cost"><?php echo $cost; ?></div>
        </div><!-- featured event content -->
        
    </div><!-- featured event -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		6 Day NOT FEATURED
---------------------------------
*/

// Start query
	$wp_query = new WP_Query();
    $wp_query->query(array(
    'post_type'=>'event',
    'tax_query' => array(
		array(
			'taxonomy' => 'event_category',
			'field'    => 'slug',
			'terms'    => 'featured',
			'operator' => 'NOT IN',
		),
	),
    'paged' => $paged,
	'meta_key' => 'event_date',
    'meta_value' => $twoDaysOut,
    'meta_compare' => '=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) :  
	 while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	 
	 $date = DateTime::createFromFormat('Ymd', get_field('event_date')); 
	$i++;
	if( $i == 1 ) {
	?>
    <div class="event-page-date"><?php echo $date->format('l, F j, Y'); ?></div>
    <?php 
	} // if i == 1
	 ?>
    
    <div class="eventlist">
    <div class="featured-event-content-details">
        	<a href="<?php the_permalink(); ?>">DETAILS</a>
        </div><!-- featured event content -->
        
        	<h2><?php the_title(); ?></h2>
        
    </div><!-- event list -->
    
<?php
endwhile; endif; wp_reset_query(); wp_reset_postdata();
/*

		Go out 8 Days
---------------------------------
*/
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
/*

		ENTERTAINMENT CATEGORY
---------------------------------
*/
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
    'order' => 'ASC'
));
    if ($wp_query->have_posts()) : 
	while ($wp_query->have_posts()) :  $wp_query->the_post(); 
	$featured = get_field('featured_post');
	$i++;
	
	
	// 			Get featured if one
		//   ______________________________________________________________
		if( $featured ) :
		$post = get_post($sponsoredPost); 
		setup_postdata( $post ); ?>
        
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
		
		<?php
        wp_reset_postdata();
		$i = 2;
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
    <?php } else { ?>
    
    <div class="small-post">
            <a href="<?php the_permalink(); ?>">
            <div class="small-post-thumb">
            <?php if ( has_post_thumbnail() ) {
                            the_post_thumbnail('thumbnail');
                        } ?>
            </div><!-- small post thumb -->
            <div class="small-post-content">
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
        	<?php get_template_part('ads/right-big'); ?>
        </div><!-- widget area -->
        
        
                
          
        
			

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>