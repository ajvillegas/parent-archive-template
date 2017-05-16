/**
 * The admin-facing JavaScript functionality.
 *
 * Shows or hides sections of the parent archive meta box
 * depending on selected options.
 *
 * @since	1.0.0
 *
 */
 
(function( $ ) {

	$( document ).ready( function() {
		
		// Toggle character limit
	    $( '#_pat_meta_content_archive' ).on( 'change', function() {
	        $( '#content_archive_limit' ).toggle( $( '#_pat_meta_content_archive' ).val() == 'full' );
	    } ).trigger( 'change' );
	    
	    // Toggle featured image extras
	    $( '#_pat_meta_content_archive_thumbnail' ).on( 'change', function() {
	        $( '#featured_image_extras' ).toggle( $( '#_pat_meta_content_archive_thumbnail' ).prop( 'checked' ) );
	    } ).trigger( 'change' );
	    
	    // Toggle entry pagination
	    $( '#_pat_meta_posts_limit' ).on( 'change', function() {
	        $( '#entry_pagination' ).toggle( $( '#_pat_meta_posts_limit' ).val() !== '0' );
	    } ).trigger( 'change' );
		
	} );

} ) ( jQuery );
