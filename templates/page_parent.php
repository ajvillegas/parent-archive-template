<?php

/**
 * Template Name: Parent Archive
 * 
 * This file displays the parent archive loop.
 *
 * @author	   Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license	   GPL-2.0+
 * @since      1.0.0
 *
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/templates
 */

/**
 * Check for Genesis to avoid any errors if deactivated.
 *
 * @since 1.0.0
 **/
if ( ! class_exists( 'Genesis_Admin_Boxes' ) ) {
	
	get_header();
		
	get_footer();
	
} else {

	add_filter( 'body_class', 'pat_plugin_add_body_class' );
	/**
	 * Adds a unique class to the body element.
	 *
	 * @param	 array	 $classes	 An array representing the classes currently applied to the body class attribute.
	 * @return	 array	 $classes	 The updated array signifying the classes we wish to add to the body class attribute.
	 *
	 * @since	 1.0.0
	 */
	function pat_plugin_add_body_class( $classes ) {
		
		$classes[] = 'parent-archive';
		return $classes;
		
	}
	
	if ( is_singular() ) {
	
		add_action( 'genesis_entry_content', 'pat_plugin_parent_archive_loop', 999 );
		/**
		 * Display child pages loop.
		 *
		 * @since	 1.0.0
		 */
		function pat_plugin_parent_archive_loop() {
			
			// Get post meta
			$entry_content = get_post_meta( get_the_ID(), '_pat_meta_content_archive', true );
			$content_limit = get_post_meta( get_the_ID(), '_pat_meta_content_archive_limit', true );
			$layout = get_post_meta( get_the_ID(), '_pat_meta_content_layout', true );
			$thumbnail = get_post_meta( get_the_ID(), '_pat_meta_content_archive_thumbnail', true );
			$img_size = get_post_meta( get_the_ID(), '_pat_meta_image_size', true );
			$img_alignment = get_post_meta( get_the_ID(), '_pat_meta_image_alignment', true );
			$img_position = get_post_meta( get_the_ID(), '_pat_meta_image_position', true );
			$post_per_page = get_post_meta( get_the_ID(), '_pat_meta_posts_limit', true );
			$more_text = get_post_meta( get_the_ID(), '_pat_meta_more_text', true );
			$pagination = get_post_meta( get_the_ID(), '_pat_meta_posts_nav', true );
			
			// Define column classes
			$i = 0;
			$columns = ! empty( $layout ) ? $layout : 1;
			$column_classes = array( '', '', 'one-half', 'one-third', 'one-fourth', 'one-fifth', 'one-sixth' );
			$class = $column_classes[$columns];
			
			// Build the query
			global $wp_query;
			
			$page_id = get_the_id();
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			
			if ( 0 == $post_per_page ) {
				$post_per_page = -1;
			}
			
			$args = array(
			    'post_parent' => $page_id,
			    'post_type' => 'page',
			    'orderby' => 'menu_order',
			    'order' => 'ASC',
			    'posts_per_page' => $post_per_page,
			    'paged' => $paged,
			);
			
			$wp_query = new WP_Query( $args );
			
			// Display child pages loop
			if ( $wp_query->have_posts() ) {
				
				?>
				<div class="parent-archive-loop"> <?php
					
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
					
						if ( $i % $columns == 0 ) { ?>
							<article <?php post_class( array( 'first', $class ) ); ?> itemscope itemtype="https://schema.org/CreativeWork"> <?php
						} else { ?>
							<article <?php post_class( $class ); ?> itemscope itemtype="https://schema.org/CreativeWork"> <?php
						} ?>
						
						<header class="entry-header" itemprop="headline"> <?php
							
							if ( 1 == $thumbnail && has_post_thumbnail() && 'above' === $img_position ) { ?>
								<a class="entry-image-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail( $img_size, array( 'class' => $img_alignment ) ); ?>
								</a> <?php
							}
							
							do_action( 'pat_plugin_before_entry_title', get_the_ID() ); ?>
							
						    <h2 class="entry-title">
							    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h2>
							
							<?php do_action( 'pat_plugin_after_entry_title', get_the_ID() ); ?>
							
						</header> <?php
						
						if ( 'none' != $entry_content || ( 1 == $thumbnail && has_post_thumbnail() && 'below' === $img_position ) ) { ?>
							
							<div class="entry-content" itemprop="text"> <?php
								
								if ( 1 == $thumbnail && has_post_thumbnail() && 'below' === $img_position ) { ?>
									<a class="entry-image-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_post_thumbnail( $img_size, array( 'class' => $img_alignment ) ); ?>
									</a> <?php
								}
								
								do_action( 'pat_plugin_before_entry_content', get_the_ID() );
								
								if ( 'none' != $entry_content ) {
								
									if ( 'excerpts' == $entry_content ) {
										
										$excerpt = get_the_excerpt(); // Return the excerpt without formatting
										$excerpt = preg_replace( '/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/', '</p><p>', $excerpt ); // Add <p> tags to line breaks
										
										// Add more-link to manual excerpts
										if ( ! empty( $more_text ) && has_excerpt() ) {
											$excerpt_more = ' <a href="' . get_permalink() . '" class="more-link">' . genesis_a11y_more_link( esc_html( $more_text ) ) . '</a>';
										} else {
											$excerpt_more = '';
										}
										
								    	echo '<p>' . $excerpt . $excerpt_more . '</p>';
								    	
								    } else {
									    
									    if ( 0 == $content_limit ) {
										    echo the_content( genesis_a11y_more_link( esc_html( $more_text ) ) );
									    } else {
									    	echo the_content_limit( (int) $content_limit, genesis_a11y_more_link( esc_html( $more_text ) ) );
									    }
									    
								    }
							    
							    }
							    
							    do_action( 'pat_plugin_after_entry_content', get_the_ID() ); ?>
							    
							</div> <?php
							
						} ?>
						
						</article> <?php
							
						$i++;
							
					endwhile;
					
					if ( 'numeric' === $pagination ) {
						genesis_numeric_posts_nav();
					} else {
						genesis_prev_next_posts_nav();
					} ?>
					
				</div>
				<?php
				
			}
			
			// Reset main query
			wp_reset_query();
			
		}
		
		add_filter( 'the_content', 'pat_plugin_paged_content' );
		/**
		 * Limit parent content to first page only.
		 *
		 * @since	 1.0.0
		 */ 
		function pat_plugin_paged_content( $content ) {
			
			// Get post meta
			$pagination_content = get_post_meta( get_the_ID(), '_pat_meta_content_pagination', true );
			
			// Filter the content
			if ( is_paged() && 1 == $pagination_content ) {
				$content = '';
			} else {
				$content = $content;
			}
			
			return $content;
			
		}
		
	}
	
	/**
	 * Add archive title to search results.
	 *
	 * @since	 1.0.1
	 */
	if ( is_search() ) {
		
		add_action( 'genesis_before_loop', 'pat_plugin_do_search_title' );
		
	}
	
	
	/**
	 * Echo the title with the search term.
	 *
	 * @since	 1.0.1
	 */
	function pat_plugin_do_search_title() {
	
		$title = sprintf( '<div class="archive-description"><h1 class="archive-title">%s %s</h1></div>', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', 'genesis' ) ), get_search_query() );
	
		echo apply_filters( 'genesis_search_title_output', $title ) . "\n";
	
	}
		
	genesis();

}
