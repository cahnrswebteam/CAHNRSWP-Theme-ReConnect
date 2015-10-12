<article id="post-<?php the_ID(); ?>" <?php post_class( $post->post_name ); ?> style="background-image: url('<?php echo esc_url( spine_get_featured_image_src() ); ?>');" data-id="<?php the_ID(); ?>" data-headline="<?php the_title(); ?>" data-anchor="<?php the_permalink(); ?>">
	<a href="<?php the_permalink(); ?>">
		<header class="article-header">
			<?php $title = ( get_post_meta( $post->ID, 'cover_title', true ) ) ? wp_kses_post( get_post_meta( $post->ID, 'cover_title', true ) ) : get_the_title(); ?>
			<h1 class="article-title"><?php echo $title; ?></h1>
		</header>
	</a>
</article>