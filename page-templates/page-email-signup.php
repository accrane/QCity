<?php
/**
 * Template Name: Email Signup
 */

get_header(); ?>

	<div id="primary" class="">
		<div id="content" role="main" class="wrapper">

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
                <h1 class="pagetitle"><?php the_title(); ?></h1>
					<?php the_content(); ?>
                    
                    <!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="//qcitymetro.us9.list-manage.com/subscribe/post?u=e54d1e33a32d5cca664a10a7d&amp;id=fa8b71dad0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<h2>Subscribe to our mailing list</h2>
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div class="mc-field-group">
	<label for="mce-MMERGE3">Zip Code </label>
	<input type="text" value="" name="MMERGE3" class="" id="mce-MMERGE3">
</div>
<div class="mc-field-group input-group">
    <strong>Qcitymetro Going Out Guide </strong>
    <ul><li><input type="checkbox" value="1" name="group[21061][1]" id="mce-group[21061]-21061-0"><label for="mce-group[21061]-21061-0">Events, Entertainment, Restaurants</label></li>
</ul>
</div>
<div class="mc-field-group input-group">
    <strong>Business Charlotte </strong>
    <ul><li><input type="checkbox" value="2" name="group[21065][2]" id="mce-group[21065]-21065-0"><label for="mce-group[21065]-21065-0">Newsletter For Small Business Owners</label></li>
</ul>
</div>
<div class="mc-field-group input-group">
    <strong>Faith Matters </strong>
    <ul><li><input type="checkbox" value="4" name="group[21069][4]" id="mce-group[21069]-21069-0"><label for="mce-group[21069]-21069-0">A Newsletter For Believers</label></li>
</ul>
</div>
<div class="mc-field-group input-group">
    <strong>Qcitymetro Newsletter </strong>
    <ul><li><input type="checkbox" value="8" name="group[21073][8]" id="mce-group[21073]-21073-0"><label for="mce-group[21073]-21073-0">A Weekly News Update</label></li>
</ul>
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_e54d1e33a32d5cca664a10a7d_fa8b71dad0" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[3]='MMERGE3';ftypes[3]='zip';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->
                    
					</div><!-- .entry-content -->
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>