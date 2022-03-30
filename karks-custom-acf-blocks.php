<?php 

/*
Plugin Name: Karks Custom ACF Blocks
Description: Custom Gutenberg blocks built with Advanced Custom Fields PRO.
Version: 1.0.0
Author: Eric Karkovack
Author URI: https://www.karks.com
*/


/* First, check if ACF PRO is active */
function karks_acf_init() {
if (is_plugin_active('advanced-custom-fields-pro/acf.php')) { 
    // ACF PRO is active - we're all good!
	
} else {
	// ACF PRO isn't active - show a message.
	echo "<div class='error notice is-dismissible'><p>Karks Custom ACF Blocks requires <a href='https://www.advancedcustomfields.com/' target='_blank'>Advanced Custom Fields PRO</a> to work. Please make sure to install and activate it.</p><button type='button' class='notice-dismiss'><span class='screen-reader-text'>Dismiss this notice.</span></button></div>";
} 
}
add_action( 'admin_init', 'karks_acf_init' );
	 

	/* Create a Custom Save Path for ACF JSON Files */
	add_filter('acf/settings/load_json', 'my_acf_json_load_point');

	function my_acf_json_load_point( $paths ) {   

		// remove original path (optional)
		unset($paths[0]);

		// append path
		$paths[] = plugin_dir_path( __FILE__ ) . 'json';


		// return
		return $paths;

	}


	/* Enqueue Block Editor Styles

	function karks_custom_acf_blocks_generic() {
		wp_enqueue_style( 'karks_custom_acf-blocks-generic-styles', plugins_url( 'karks_custom_acf-blocks/assets/style-editor.css', dirname(__FILE__) ) );
	}
	add_action( 'admin_enqueue_scripts', 'karks_custom_acf_blocks_generic' );  */


	/* Enqueue Flexbox Grid */

	function karks_custom_acf_blocks_flexbox_grid() {
		wp_enqueue_style( 'karks_custom_acf-blocks-flexbox-styles', plugins_url( 'karks_custom_acf-blocks/assets/flexbox-grid.css', dirname(__FILE__) ) );
	}
	add_action( 'wp_enqueue_scripts', 'karks_custom_acf_blocks_flexbox_grid' );




	/* Create a Custom Block Category */
	function karks_acf_custom_blocks_cats( $categories ) {
	    $blog_title = get_bloginfo(); // Get the Site's Name
		$category_slugs = wp_list_pluck( $categories, 'slug' );
		return in_array( 'karks_blocks_cat', $category_slugs, true ) ? $categories : array_merge(
			$categories,
			array(
				array(
					'slug'  => 'karks_blocks_cat',
					'title' => __( $blog_title . 'Custom Blocks', 'karks_blocks_cat' ),
					'icon'  => 'open-folder',
				),
			)
		);
	}
	add_filter( 'block_categories_all', 'karks_acf_custom_blocks_cats' );



	/* Initial Custom Blocks */
	add_action('acf/init', 'karks_acf_custom_blocks');
	function karks_acf_custom_blocks() {

		// Check function exists.
		if( function_exists('acf_register_block_type') ) {

			// Karks File List
			acf_register_block_type(array(
				'name'              => 'karks-document-list',
				'title'             => __('Document List'),
				'description'       => __('Display a list of documents for downloading.'),
				'render_template'   => plugin_dir_path( __FILE__ ) . 'blocks/karks-document-list/karks-document-list.php',
				'enqueue_style'     => plugins_url( 'karks-custom-acf-blocks/blocks/karks-document-list/block-styles.css', dirname(__FILE__) ),
				'category'          => 'karks_blocks_cat',
				'icon'              => 'media-document',
				'keywords'          => array( 'document', 'download', 'list' ),
				'mode'				=> 'edit',
				'supports' 			=> array( 'mode' => true ), // False = Disable preview toggle.
			));


		}

	}



	// Create Custom Block Patterns


	/* First, Create a Custom Block Pattern Category */
	register_block_pattern_category(
		'karks_custom_acf',
		array( 'label' => __( 'karks_custom_acf Patterns', 'karks_custom_acf-block-patterns' ) )
	);

	/* Next, Register the Patterns */
	function my_custom_wp_block_patterns() {

		// Register Block Patterns Here

		

	}    
	add_action( 'init', 'my_custom_wp_block_patterns' );