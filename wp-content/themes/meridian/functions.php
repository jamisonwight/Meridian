<?php
/** 
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */			
	
	// CF7 hack
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_select_enum_rules', 20, 2 );
// Theme support options
require_once(get_template_directory().'/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/functions/translation/translation.php'); 

// Adds site styles to the WordPress editor
// require_once(get_template_directory().'/functions/editor-styles.php'); 

// Remove Emoji Support
// require_once(get_template_directory().'/functions/disable-emoji.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/functions/admin.php'); 

define('TEMPLATE_PARTS', __DIR__.'/parts/');

function query_post_type($query) {
    $post_types = get_post_types();

    if ( is_category() || is_tag()) {

        $post_type = get_query_var('insights');

        if ( $post_type ) {
            $post_type = $post_type;
        } else {
            $post_type = $post_types;
        }

        $query->set('post_type', $post_type);

        return $query;
    }
}

add_filter('pre_get_posts', 'query_post_type');


/**
 * Matador  job Tile to use customtext1
 */
add_filter( 'matador_import_job_title_field', function ( $field ) {

    return 'job_title';
 } ); 

 /**
 * Example: Import Additional Job Fields from Bullhorn
 *
 * Example below imports Bullhorn field named 'customText4', calls it 'salary_range', declares it a 'string', and saves it as
 * Job Meta for use in the front-end of the website, presumably to replace the 'salary' with a more descriptive range stat.
 *
 * @copyright 2019, Matador Software, LLC
 * @author Jeremy Scott, Matador Software LLC
 * @link https://matadorjobs.com/
 *
 * @param $fields
 *
 * @return array
 */
function mdocs_example_matador_bullhorn_import_fields( $fields ) {
	$field_to_add = [
		'companyName' => [ // Name of field per Bullhorn Field Mappings (not its label)
			'name'   => 'name', // Set name for meta when 'saveas' is 'meta'.
			'type'   => 'string', // Specify type for sanitization, default 'type'
			'saveas' => 'meta', // Options are 'core', 'meta', 'custom'. Default 'custom'
		],
	];
	return array_merge( $fields, $field_to_add );
}
add_filter( 'matador_bullhorn_import_fields', 'mdocs_example_matador_bullhorn_import_fields' );

// ACF Allowed Tags
add_filter( 'wp_kses_allowed_html', 'acf_add_allowed_iframe_tag', 10, 2 );
function acf_add_allowed_iframe_tag( $tags, $context ) {
   if ( $context === 'acf' ) {
      $tags['iframe'] = array(
         'src'             => true,
         'height'          => true,
         'width'           => true,
         'frameborder'     => true,
         'allowfullscreen' => true,
         'class'           => true,
      );

      $tags['script'] = array(
         'src' => true,
         'async' => true,
         'defer' => true,
         'charset' => true
      );

      $tags['link'] = array(
         'href' => true,
         'rel' => true,
         'title' => true,
         'type' => true
      );
   }

   return $tags;
}

// Remove ACF unsafe HTML notice 
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );