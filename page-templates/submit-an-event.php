<?php
/**
 * Template Name: Submit an Event
 */

get_header(); ?>

	<div id="primary" class="">
		<div id="content" role="main" class="wrapper">

			<?php while ( have_posts() ) : the_post(); 
			
			$standardBenefits = get_field('benefits');
			$standardCost = get_field('cost');
			$standardLink = get_field('link');
			$featuredBenefits = get_field('featured_benefits');
			$featuredCost = get_field('featured_cost');
			$featuredLink = get_field('featured_link');
			$premiumBenefits = get_field('premium_benefits');
			$premiumCost = get_field('premium_cost');
			$premiumLink = get_field('premium_link');
			
			?>
				<header class="archive-header">
				<div class="border-title">
                    <h1><?php the_title(); ?></h1>
                </div><!-- border title -->
			</header><!-- .archive-header -->
            
            <div class="entry-content">
            <?php the_content(); ?>
            
            <section id="third" class="third-first">
            	<h5>Standard Events</h5>
                <div class="">
                    <h4>Benefits:</h4>
                    <?php echo $standardBenefits; ?>
                    <div class="clear"></div>
                    <h4>Cost: <?php echo $standardCost; ?></h4>
                </div>
                <div class="button viewmore-short">
                	<a href="<?php echo $standardLink; ?>">Submit a Standard Event</a>
                </div><!-- button -->
            </section><!-- thirds -->
            
            <section id="third" class="third-first">
            	<h5>Featured Events</h5>
                <div class="">
                    <h4>Benefits:</h4>
                    <?php echo $featuredBenefits; ?>
                    <div class="clear"></div>
                    <h4>Cost: <?php echo $featuredCost; ?></h4>
                </div>
                <div class="button viewmore-short">
                	<a href="<?php echo $featuredLink; ?>">Submit a Featured Event</a>
                </div><!-- button -->
            </section><!-- thirds -->
            
            <section id="third" class="third-last">
            	<h5>Premium Events</h5>
                <div class="">
                    <h4>Benefits:</h4>
                    <?php echo $premiumBenefits; ?>
                    <div class="clear"></div>
                    <h4>Cost: <?php echo $premiumCost; ?></h4>
                </div>
                <div class="button viewmore-short">
                	<a href="<?php echo $premiumLink; ?>">Submit a Premium Event</a>
                </div><!-- button -->
           </section><!-- thirds -->
            
            
            </div><!-- entry content -->
            
            
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>