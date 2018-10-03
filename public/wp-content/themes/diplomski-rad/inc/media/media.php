<?php
/**
 * Media.
 *
 * @package diplomski
 */

/**
 * Returns image url.
 *
 * @param  integer $image_id Attachment ID.
 * @param  string  $size     Image size to retrive.
 * @return string
 */
function diplomski_get_image_src( $image_id, $size = 'full' ) {
	if ( ! empty( $image_id ) ) {
		$image_data = wp_get_attachment_image_src( $image_id, $size );

		if ( ! empty( $image_data ) ) {
			return $image_data[0];
		}
	}

	return '';
}

/**
 * Returns css background-image property.
 *
 * @param  integer $image_id Attachment ID.
 * @param  string  $size     Image size to display.
 * @return string
 */
function diplomski_get_background_image( $image_id = 0, $size = 'full' ) {
	if ( empty( $image_id ) ) {
		$image_id = get_post_thumbnail_id();
	}

	$src = diplomski_get_image_src( $image_id, $size );

	if ( ! empty( $src ) ) {
		return 'background-image: url(' . $src . ');';
	}

	return '';
}

/**
 * Prints css background-image property.
 *
 * @param  integer $image_id Attachment ID.
 * @param  string  $size     Image size to display.
 * @return void
 */
function diplomski_the_background_image( $image_id = 0, $size = 'full' ) {
	echo esc_attr( diplomski_get_background_image( $image_id, $size ) );
}

/**
 * Returns asset's src depending on env
 *
 * @param string $filename Asset's filename.
 * @return string
 */
function diplomski_get_asset_src( $filename = '' ) {
	if ( empty( $filename ) ) {
		return '';
	}

	if ( defined( 'BOJLERSITE_LOCAL_DEV' ) && true === BOJLERSITE_LOCAL_DEV ) {
		return '//bojler-site.test:9000/assets/media/' . $filename;
	}

	return trailingslashit( get_template_directory_uri() ) . 'assets/media/' . $filename;
}

/**
 * Prints `diplomski_get_asset_src` result
 *
 * @param string $filename Asset's filename.
 */
function diplomski_the_asset_src( $filename = '' ) {
	echo esc_url( diplomski_get_asset_src( $filename ) );
}

/**
 * Filters whether to preempt calculating the image resize dimensions.
 * Passing a non-null value to the filter will effectively short-circuit
 * image_resize_dimensions(), returning that value instead.
 *
 * @param null|mixed $output Whether to preempt output of the resize dimensions.
 * @param int        $orig_w Original width in pixels.
 * @param int        $orig_h Original height in pixels.
 * @param int        $dest_w New width in pixels.
 * @param int        $dest_h New height in pixels.
 * @param bool|array $crop   Whether to crop image to specified width and height or resize.
 *                           An array can specify positioning of the crop area. Default false.
 * @return null|mixed
 */
function diplomski_keep_resize_aspect_ratio( $output, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
	if ( false !== $crop ) {
		return null;
	}

	$dest_aspect_ratio = $dest_w / $dest_h;
	$orig_aspect_ratio = $orig_w / $orig_h;

	if ( $orig_aspect_ratio === $dest_aspect_ratio ) {
		return null;
	}

	if ( $orig_w < $dest_w || $orig_h < $dest_h ) {
		if ( $orig_aspect_ratio < $dest_aspect_ratio ) {
			$dest_w = $orig_w;
			$dest_h = (int) round( $orig_w / $dest_aspect_ratio );
		} else {
			$dest_h = $orig_h;
			$dest_w = (int) round( $orig_h * $dest_aspect_ratio );
		}
	}

	return image_resize_dimensions( $orig_w, $orig_h, $dest_w, $dest_h, true );
}
add_filter( 'image_resize_dimensions', 'diplomski_keep_resize_aspect_ratio', 10, 6 );

/**
 * Renders inline svg icon
 *
 * @param string $name File name without extension.
 * @return string
 */
function bojler_acf_icon_picker_svg_icon( $name ) {
	$filename = trailingslashit( get_stylesheet_directory() ) . "inc/acf-icon-picker/icons/$name.svg";

	if ( file_exists( $filename ) ) {
		return $filename;
	}
}
