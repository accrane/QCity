<?php
/**
 * Template Name: Event Submit Premium
 */
add_filter('acf/update_value', 'wp_kses_post', 10, 1);
acf_form_head();
// sanitize inputs


get_header(); ?>

	<div id="primary" class="">
		<div id="content" role="main" class="wrapper">

			<?php while ( have_posts() ) : the_post(); ?>
				
				<div class="entry-content">
                <h1 class="pagetitle"><?php the_title(); ?></h1>
                
				<?php the_content();
				$return = get_bloginfo('url') . '/submit-an-event/submit-premium-event/pay-premium-event/'; 
                $formArg = array (
					'id' => 'acf-premium-event-form',
					'post_id'		=> 'new_post',
					'return' => $return,
					'post_title' => true,
					///'post_content' => true,
					'form' => true,
					'fields' => array(
						'event_date',
						'end_date',
						'event_start_time',
						'event_end_time',
						'event_contact',
						'event_email',
						'phone',
						'cost_of_event',
						'name_of_venue',
						'venue_address',
						'link_for_tickets_registration',
						'website_link',
						'details',
						'choose_categories',
						'event_image',
						'event_type',
						
					),
					'new_post'		=> array(
						'post_type'		=> 'event',
						'post_status'		=> 'pending',
						'post_title'    => 'My Event post',
						'tax_input'      => array('event_category'=>'premium')
						),
					'submit_value'		=> 'Add My Event'
					);
                //echo '<p>Start Date: ' . the_field("event_date") . '</p>';
                acf_form($formArg);
                
                ?>
                            
                </div><!-- entry content -->
                
                
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>