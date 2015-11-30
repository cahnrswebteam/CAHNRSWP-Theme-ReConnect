<?php
if ( is_front_page() ) {
	$additional_classes = array(
		'cover-feature',
		'unbound',
		'recto',
		'verso',
	);
} else {
	$additional_classes = array( 'cover-feature' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_classes ); ?> style="background-image: url('<?php echo esc_url( spine_get_featured_image_src() ); ?>');" data-id="<?php the_ID(); ?>" data-headline="<?php the_title(); ?>" data-anchor="<?php the_permalink(); ?>">
	<div class="teaser">
		<header class="article-header">
			<?php $title = ( get_post_meta( $post->ID, 'cover_title', true ) ) ? wp_kses_post( get_post_meta( $post->ID, 'cover_title', true ) ) : get_the_title(); ?>
			<h1 class="article-title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h1>
		</header>
		<div class="article-summary">
			<?php
				if ( $post->post_excerpt ) {
					echo '<p>' . get_the_excerpt() . '</p>';
				} elseif ( strstr( $post->post_content, '<!--more-->' ) ) {
					the_content( '' );
				} else {
					the_excerpt();
				}
			?>
		</div>
		<p class="more-button">
			<a href="<?php the_permalink(); ?>">Read More</a>
		</p>
	</div>
</article>