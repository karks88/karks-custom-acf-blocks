<?php
/**
 * Block template file: /blocks/karks-document-list/karks-document-list.php
 *
 * Sadler Document List Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'karks-document-list-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-karks-document-list';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'documents' ) ) : ?>
	
		<ul class="karks-doclist">
		
		<?php while ( have_rows( 'documents' ) ) : the_row(); ?>
			<?php $file = get_sub_field( 'file' ); ?>
			<?php if ( $file ) : ?>
				<li><a href="<?php echo $file['url']; ?>" target="_blank"><?php the_sub_field( 'title' ); ?></a></li>
			<?php endif; ?>
		
		<?php endwhile; ?>
	
		</ul>
		
	<?php endif; ?>
</div>