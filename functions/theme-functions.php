<?php
// This theme uses wp_nav_menu() in one location.

register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );
register_nav_menu( 'sitemap', __( 'Sitemap Menu', 'twentytwelve' ) );
register_nav_menu( 'footer', __( 'Footer Menu', 'twentytwelve' ) );
	
// This theme uses a custom image size for featured images, displayed on "standard" posts.
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
add_image_size('event',150,125,array('center','center'));
add_image_size('photo',400,250,array('center','center'));
add_image_size('thirds',400,278,array('center','center'));
add_image_size('small',250,9999 );
// OPtions page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}
// Guest Author
/*add_filter( 'the_author', 'guest_author_name' );
add_filter( 'get_the_author_display_name', 'guest_author_name' );

function guest_author_name( $name ) {
global $post;

$author = get_field( $post->ID, 'author_name', true );

if ( $author )
$name = $author;

return $name;
}*/
/*-------------------------------------
	Custom client login, link and title.
---------------------------------------*/
function my_login_logo() { ?>
<style type="text/css">
  body.login div#login h1 a {
  	background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
  	background-size: 327px 67px;
  	width: 327px;
  	height: 67px;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Change Link
function loginpage_custom_link() {
	return the_permalink();
}
add_filter('login_headerurl','loginpage_custom_link');

/*-------------------------------------
	Favicon.
---------------------------------------*/
function mytheme_favicon() { 
 echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/images/favicon.ico" >'; 
} 
add_action('wp_head', 'mytheme_favicon');
// wordpress excerpt
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
// Excerpt Function
function get_excerpt($count){
  // whatever you want to append on the end of the last word
  $words = '...';
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = wp_trim_words($excerpt, $count, $words);
  $excerpt = strip_shortcodes($excerpt);
  return $excerpt;
}
/*// Title Function
function ac_get_title($count){
  // whatever you want to append on the end of the last word
  $postId = get_the_ID();
  $words = '...';
  $title = get_the_title($postId);
  $title = strip_tags($title);
  $title = wp_trim_words($title, $count, $words);
  return $title;
}*/

// Title Function
function ac_get_title($count){
  // whatever you want to append on the end of the last word
  $postId = get_the_ID();
  $words = '...';
  $title = get_the_title($postId);
  $title = strip_tags($title);
  $title = substr($title, 0, $count);
  $title = $title . '...';
  return $title;
}

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    echo '';
}
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'News';
        $labels->singular_name = 'News';
        $labels->add_new = 'Add News';
        $labels->add_new_item = 'Add News';
        $labels->edit_item = 'Edit News';
        $labels->new_item = 'News';
        $labels->view_item = 'View News';
        $labels->search_items = 'Search News';
        $labels->not_found = 'No News found';
        $labels->not_found_in_trash = 'No News found in Trash';
    }
    add_action( 'init', 'change_post_object_label' );
    add_action( 'admin_menu', 'change_post_menu_label' );
	
	
add_filter('gettext','custom_enter_title');

function custom_enter_title( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'church_listing' == $post_type )
        return 'Church Name';

    return $input;
}
add_filter( 'acf/get_valid_field', 'change_input_labels');
function change_input_labels($field) {
//$formId = $_POST['acf']['id'];
/*$formId = $_POST['acf']['id'];
echo '<pre>';
print_r($formId);
echo '</pre>';*/
if( is_page(474) ) {
	if($field['name'] == '_post_title') {
		$field['label'] = 'Church Name';
	}
//}
}

if( is_page(219) ) {
	if($field['name'] == '_post_content') {
		$field['label'] = 'Business Details';
	}
//}
}
	//if($field['name'] == '_post_content') {
		//$field['label'] = 'Custom Content Title';
	//}
		
	return $field;
		
}
/*-------------------------------------------------------------------------------
	Custom Columns
-------------------------------------------------------------------------------*/

function my_page_columns($columns)
{
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' 	=> 'Title',
		'thumbnail'	=>	'Thumbnail',
		'event' 	=> 'Event Date',
		//'author'	=>	'Author',
		//'date'		=>	'Date',
	);
	return $columns;
}

function my_custom_columns($column)
{
	global $post;
	if($column == 'event')
	{
			$date = DateTime::createFromFormat('Ymd', get_field('event_date'));
			$startDateSubmitted = get_field('event_start_date_submitted'); 
			
			/*echo '<pre>';
			print_r($startDateSubmitted);*/
			
			if( $date != '' ) {
				echo $date->format('M/d/Y');
			}  else {
				echo 'No Date, or Pending';	
			}

	} elseif ($column == 'thumbnail'){
		
		$image = get_field('event_image');
		$imageSubmitted = get_field('event_image_submitted'); 
		
		if( $imageSubmitted != '' ) {
			$myUrl = $imageSubmitted;	
		} elseif( $image != '' ) {
			$myUrl = $image['sizes']['thumbnail'];	
		} else {
			$myUrl = '';
		}
		
		if( $myUrl != '' ) {
			echo '<img src="'. $myUrl .'" />';
		} else {
			echo 'no image with this event';	
		}
	}
}

add_action("manage_event_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-event_columns", "my_page_columns");

/*-------------------------------------------------------------------------------
	Sortable Columns
-------------------------------------------------------------------------------*/

function my_column_register_sortable( $columns )
{
	$columns['event'] = 'event';
	return $columns;
}

add_filter("manage_edit-event_sortable_columns", "my_column_register_sortable" );
// Sanatize the ACF form inputs
function my_kses_post( $value ) {
	
	// is array
	if( is_array($value) ) {
	
		return array_map('my_kses_post', $value);
	
	}
	
	
	// return
	return wp_kses_post( $value );

}

add_filter('acf/update_value', 'my_kses_post', 10, 1);
/*-------------------------------------
	Custom WYSIWYG Styles
---------------------------------------*/
function acc_custom_styles($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'acc_custom_styles');
/*
* Callback function to filter the MCE settings
*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Alternate Title',  
			'block' => 'span',  
			'classes' => 'alternate-title',
			'wrapper' => true,
			
		)
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
// Add styles to WYSIWYG in your theme's editor-style.css file
function my_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );