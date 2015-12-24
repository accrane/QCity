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
<div class="business-header">
	
    <div class="button viewmore-short">
    <a href="<?php bloginfo('url'); ?>/submit-an-event">Add your Event to this directory</a>
    </div><!-- button -->

<div class="business-header-right">

<div class="header-select">  
<h3>Search by Event Type</h3> 
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
<form id="category-select" class="category-select"  action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

        <select name='eventtype' id='eventtype'  >
        	<?php 
			echo '<option class="">Select an Event Type</option>';
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
</div><!-- header select -->
<?php //get_term_link( 'skin-care', $taxonomy ); ?> 
</div><!-- business header right -->  
</div><!-- business header --> 