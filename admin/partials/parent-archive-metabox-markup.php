<?php

/**
 * Provide an admin area view for the meta boxes
 *
 * This file is used to markup the parent archive meta box.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Parent_Archive_Template
 * @subpackage Parent_Archive_Template/admin/partials
 */

?>

<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="_pat_meta_content_archive"><?php esc_html_e( 'Display', 'parent-archive-template' ); ?></label>
			</th>
			<td>
				<select name="_pat_meta_content_archive" id="_pat_meta_content_archive">
				<?php
				$archive_display = array(
					'full'     => __( 'Entry content', 'parent-archive-template' ),
					'excerpts' => __( 'Entry excerpts', 'parent-archive-template' ),
				);
				foreach ( (array) $archive_display as $value => $name ) { ?>
					<option value="<?php echo esc_attr( $value ); ?>" <?php if ( isset ( $stored_meta['_pat_meta_content_archive'] ) ) echo selected( $stored_meta['_pat_meta_content_archive'][0], esc_attr( $value ), false ); ?>><?php echo esc_html( $name ); ?></option><?php "\n";
				}
				?>
				</select>
			</td>
		</tr>
		
		<tr id="content_archive_limit" valign="top">
			<th scope="row">
				<label for="_pat_meta_content_archive_limit"><?php esc_html_e( 'Limit content to', 'parent-archive-template' ); ?></label>
			</th>
			<td>
				<input type="number" name="_pat_meta_content_archive_limit" id="_pat_meta_content_archive_limit" class="small-text" value="<?php if ( isset ( $stored_meta['_pat_meta_content_archive_limit'] ) ) echo absint( $stored_meta['_pat_meta_content_archive_limit'][0] ); else echo 0; ?>" />
				<?php esc_html_e( 'characters', 'parent-archive-template' ); ?>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_pat_meta_content_layout"><?php esc_html_e( 'Layout', 'parent-archive-template' ); ?></label>
			</th>
			<td>
				<?php esc_html_e( 'Display child pages in', 'parent-archive-template' ); ?>
				<select name="_pat_meta_content_layout" id="_pat_meta_content_layout">
				<?php
				$archive_layout = array(
					'1' => __( 'one', 'parent-archive-template' ),
					'2' => __( 'two', 'parent-archive-template' ),
					'3' => __( 'three', 'parent-archive-template' ),
					'4' => __( 'four', 'parent-archive-template' ),
					'6' => __( 'six', 'parent-archive-template' ),
				);
				foreach ( (array) $archive_layout as $value => $name ) { ?>
					<option value="<?php echo esc_attr( $value ) ?>" <?php if ( isset ( $stored_meta['_pat_meta_content_layout'] ) ) echo selected( $stored_meta['_pat_meta_content_layout'][0], esc_attr( $value ), false ) ?>><?php echo esc_html( $name ) ?></option><?php "\n";
				}
				?>
				</select>
				<?php esc_html_e( 'column(s)', 'parent-archive-template' ); ?>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<?php esc_html_e( 'Featured Image', 'parent-archive-template' ); ?>
			</th>
			<td>
				<p>
					<label for="_pat_meta_content_archive_thumbnail">
						<input type="checkbox" name="_pat_meta_content_archive_thumbnail" id="_pat_meta_content_archive_thumbnail" value="1" <?php if ( isset ( $stored_meta['_pat_meta_content_archive_thumbnail'] ) ) checked( $stored_meta['_pat_meta_content_archive_thumbnail'][0], 1 ); ?> />
						<?php esc_html_e( 'Include the Featured Image?', 'parent-archive-template' ); ?>
					</label>
				</p>
	
				<div id="featured_image_extras">
					<p>
						<label for="_pat_meta_image_size"><?php esc_html_e( 'Image Size:', 'parent-archive-template' ); ?></label>
						<select name="_pat_meta_image_size" id="_pat_meta_image_size">
						<?php
						$sizes = function_exists( 'genesis_get_image_sizes' ) ? genesis_get_image_sizes() : null;
						foreach ( (array) $sizes as $name => $size ) { ?>
							<option value="<?php echo esc_attr( $name ) ?>" <?php if ( isset ( $stored_meta['_pat_meta_image_size'] ) ) echo selected( $stored_meta['_pat_meta_image_size'][0], $name, false ) ?>><?php echo esc_html( $name ) . ' (' . absint( $size['width'] ) . ' &#x000D7; ' . absint( $size['height'] ) . ')</option>' . "\n";
						}
						?>
						</select>
					</p>
	
					<p>
						<label for="_pat_meta_image_alignment"><?php esc_html_e( 'Image Alignment:', 'parent-archive-template' ); ?></label>
						<select name="_pat_meta_image_alignment" id="_pat_meta_image_alignment">
							<option value=""><?php esc_html_e( '- None -', 'parent-archive-template' ) ?></option>
							<option value="alignleft" <?php if ( isset ( $stored_meta['_pat_meta_image_alignment'] ) ) selected( $stored_meta['_pat_meta_image_alignment'][0], 'alignleft' ); ?>><?php esc_html_e( 'Left', 'parent-archive-template' ) ?></option>
							<option value="alignright" <?php if ( isset ( $stored_meta['_pat_meta_image_alignment'] ) ) selected( $stored_meta['_pat_meta_image_alignment'][0], 'alignright' ); ?>><?php esc_html_e( 'Right', 'parent-archive-template' ) ?></option>
							<option value="aligncenter" <?php if ( isset ( $stored_meta['_pat_meta_image_alignment'] ) ) selected( $stored_meta['_pat_meta_image_alignment'][0], 'aligncenter' ); ?>><?php _e( 'Center', 'parent-archive-template' ) ?></option>
						</select>
					</p>
					
					<p>
						<label for="_pat_meta_image_position"><?php esc_html_e( 'Image Position:', 'parent-archive-template' ); ?></label>
						<select name="_pat_meta_image_position" id="_pat_meta_image_position">
							<option value="above" <?php if ( isset ( $stored_meta['_pat_meta_image_position'] ) ) selected( $stored_meta['_pat_meta_image_position'][0], 'above' ); ?>><?php esc_html_e( 'Above Title', 'parent-archive-template' ) ?></option>
							<option value="below" <?php if ( isset ( $stored_meta['_pat_meta_image_position'] ) ) selected( $stored_meta['_pat_meta_image_position'][0], 'below' ); ?>><?php esc_html_e( 'Below Title', 'parent-archive-template' ) ?></option>
						</select>
					</p>
				</div>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_pat_meta_more_text"><?php esc_html_e( 'More Text', 'parent-archive-template' ); ?></label>
			</th>
			<td>
				<input type="text" name="_pat_meta_more_text" id="_pat_meta_more_text" class="medium-text" value="<?php if ( isset ( $stored_meta['_pat_meta_more_text'] ) ) echo esc_attr( $stored_meta['_pat_meta_more_text'][0] ); ?>" />
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_pat_meta_posts_limit"><?php esc_html_e( 'Posts Per Page', 'parent-archive-template' ); ?></label>
			</th>
			<td>
				<input type="number" name="_pat_meta_posts_limit" id="_pat_meta_posts_limit" class="small-text" value="<?php if ( isset ( $stored_meta['_pat_meta_posts_limit'] ) ) echo absint( $stored_meta['_pat_meta_posts_limit'][0] ); else echo 0; ?>" />
				<p>
					<span class="description"><?php esc_html_e( 'Limit number of child pages to display per page. Enter 0 for unlimited.', 'parent-archive-template' ); ?></span>
				</p>
			</td>
		</tr>
		
		<tr id="entry_pagination" valign="top">
			<th scope="row">
				<label for="_pat_meta_posts_nav"><?php esc_html_e( 'Entry Pagination', 'parent-archive-template' ); ?></label>
			</th>
			<td>
				<p>
					<select name="_pat_meta_posts_nav" id="_pat_meta_posts_nav">
						<option value="numeric" <?php if ( isset ( $stored_meta['_pat_meta_posts_nav'] ) ) selected( 'numeric', $stored_meta['_pat_meta_posts_nav'][0] ); ?>><?php esc_html_e( 'Numeric', 'parent-archive-template' ); ?></option>
						<option value="prev-next" <?php if ( isset ( $stored_meta['_pat_meta_posts_nav'] ) ) selected( 'prev-next', $stored_meta['_pat_meta_posts_nav'][0] ); ?>><?php esc_html_e( 'Previous / Next', 'parent-archive-template' ); ?></option>
					</select>
				</p>
				
				<p>
					<label for="_pat_meta_content_pagination">
						<input type="checkbox" name="_pat_meta_content_pagination" id="_pat_meta_content_pagination" value="1" <?php if ( isset ( $stored_meta['_pat_meta_content_pagination'] ) ) checked( $stored_meta['_pat_meta_content_pagination'][0], 1 ); ?> />
						<?php esc_html_e( 'Limit parent content to first page only?', 'parent-archive-template' ); ?>
					</label>
				</p>
			</td>
		</tr>
	</tbody>
</table>
