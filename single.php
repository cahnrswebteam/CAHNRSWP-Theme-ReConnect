<?php get_header(); ?>

<main>

<?php get_template_part( 'parts/headers' ); ?>

<?php if ( spine_has_featured_image() ) {
	$featured_image_src = spine_get_featured_image_src();
	?><figure class="featured-image" style="background-image: url('<?php echo esc_url( $featured_image_src ); ?>');"><?php spine_the_featured_image(); ?></figure><?php
} ?>

<?php get_template_part( 'parts/single-layout', get_post_type() ); ?>

<footer class="main-footer">
	<section class="row halves pager prevnext gutter pad-ends">
		<div class="column one">
			<?php next_post_link( '&laquo; %link' ); ?>
		</div>
		<div class="column two">
			<?php previous_post_link( '%link &raquo;' ); ?>
		</div>
	</section><!--pager-->
</footer>

	<?php get_template_part( 'parts/footers' ); ?>

</main><!--/#page-->

<?php get_footer(); ?>