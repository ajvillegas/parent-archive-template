<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, enqueues the admin-specific
 * stylesheet and JavaScript and adds the meta box.
 *
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Parent_Archive_Template_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name		The name of this plugin.
	 * @param    string    $version			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {
		
		// Get post ID
		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : isset( $_POST['post_ID'] );
		
		// Get page template
		$page_template = get_post_meta( $post_id, '_wp_page_template', true );
		
		// Load script on editor page only
		if ( in_array( $hook, array( 'post.php' ) ) ) {
			
			$screen = get_current_screen();
			
			// Load script only on pages using our page template
			if ( is_object( $screen ) && 'page' == $screen->post_type && 'page_parent.php' == $page_template ) {
				
				wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/parent-archive-template-admin.min.js', array( 'jquery' ), $this->version, false );
				
			}
			
		}
		
	}
	
	/**
	 * Enable post excerpts on pages.
	 *
	 * @since    1.0.0
	 */
	public function add_excerpts_to_pages() {
		
		add_post_type_support( 'page', 'excerpt' );
		
	}

	/**
	 * Register the post meta box.
	 *
	 * @since    1.0.0
	 */
	public function add_parent_archive_meta_box() {
		
		// Get post ID
		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : isset( $_POST['post_ID'] );
		
		// Get page template
		$page_template = get_post_meta( $post_id, '_wp_page_template', true );
		
		// Add meta box to specific page template
		if ( 'page_parent.php' == $page_template ) {
		
			add_meta_box( 'parent-archive-meta-box', __( 'Parent Archive Settings', 'parent-archive-template' ), array( $this, 'parent_archive_meta_box' ), 'page', 'normal', 'high' );
			
		}
		
	}
	
	/**
	 * Define the post meta box.
	 *
	 * @since    1.0.0
	 */
	public function parent_archive_meta_box( $post ) {

		wp_nonce_field( basename( __FILE__ ), 'pat_parent_archive_nonce' );
		$stored_meta = get_post_meta( $post->ID );

		// Meta box markup
		include( plugin_dir_path( __FILE__ ) . 'partials/parent-archive-metabox-markup.php' );

	}
	
	/**
	 * Save the post meta box values.
	 *
	 * @since    1.0.0
	 */
	public function save_meta_box_values( $post_id ) {
		
		// Check save status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'pat_parent_archive_nonce' ] ) && wp_verify_nonce( $_POST[ 'pat_parent_archive_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exit depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}
		
		// Check for input and sanitize/save if needed
		if ( isset( $_POST[ '_pat_meta_content_archive' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_content_archive', esc_attr( $_POST[ '_pat_meta_content_archive' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_content_archive_limit' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_content_archive_limit', absint( $_POST[ '_pat_meta_content_archive_limit' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_content_layout' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_content_layout', absint( $_POST[ '_pat_meta_content_layout' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_content_archive_thumbnail' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_content_archive_thumbnail', 1 );
		} else {
			update_post_meta( $post_id, '_pat_meta_content_archive_thumbnail', 0 );
		}
		
		if ( isset( $_POST[ '_pat_meta_image_size' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_image_size', esc_attr( $_POST[ '_pat_meta_image_size' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_image_alignment' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_image_alignment', esc_attr( $_POST[ '_pat_meta_image_alignment' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_image_position' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_image_position', esc_attr( $_POST[ '_pat_meta_image_position' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_posts_limit' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_posts_limit', absint( $_POST[ '_pat_meta_posts_limit' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_more_text' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_more_text', sanitize_text_field( $_POST[ '_pat_meta_more_text' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_posts_nav' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_posts_nav', esc_attr( $_POST[ '_pat_meta_posts_nav' ] ) );
		}
		
		if ( isset( $_POST[ '_pat_meta_content_pagination' ] ) ) {
			update_post_meta( $post_id, '_pat_meta_content_pagination', 1 );
		} else {
			update_post_meta( $post_id, '_pat_meta_content_pagination', 0 );
		}
		
	}

}
