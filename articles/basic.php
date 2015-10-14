<article id="post-<?php the_ID(); ?>" <?php if ( in_category( 'cover-story' ) ) { post_class( 'cover-suite' ); } else { post_class(); } ?>>
	<?php
  	if ( spine_has_featured_image() ) {
		$featured_image_src = spine_get_featured_image_src( 'spine-medium_size' );
		?><figure>
			<a href="<?php the_permalink(); ?>" class="featured-image" title="<?php the_title_attribute(); ?>" style="background-image: url('<?php echo esc_url( $featured_image_src ); ?>');">
				<?php spine_the_featured_image( 'spine-medium_size' ); ?>
			</a>
		</figure><?php
		}
	?>
	<?php if ( has_tag( 'online-exclusive' ) ) : ?><a href="<?php the_permalink(); ?>"  class="flag">Online Exclusive</a><?php endif; ?>
  <?php if ( in_category( 'profile' ) ) : ?><a href="<?php the_permalink(); ?>" class="flag">Alumni Profile</a><?php endif; ?>
  <div class="article-summary">
		<header class="article-header">
			<h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</header>
		<?php
			if ( $post->post_excerpt ) {
				echo '<p>' . get_the_excerpt() . '</p>';
			} elseif ( strstr( $post->post_content, '<!--more-->' ) ) {
				the_content( '' );
			} else {
				the_excerpt();
			}
		?>
		<?php if ( in_category( array( 'cover-story', 'feature', 'profile' ) ) ) : ?>
		<p class="more-button">
			<a href="<?php the_permalink(); ?>">Read More</a>
		</p>
    <?php endif; ?>
	</div>
</article>