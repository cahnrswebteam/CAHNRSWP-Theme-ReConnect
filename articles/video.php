<article id="post-<?php the_ID(); ?>" <?php post_class( 'video' ); ?>>
	<header class="article-header">
		<h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</header>
	<?php
		if ( $post->post_excerpt ) {
			echo '<p>' . get_the_excerpt() . '</p>';
		}
		the_content();
	?>
</article>