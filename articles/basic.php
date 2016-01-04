<?php
$additional_classes = array();
if ( in_category( 'cover-story' ) ) {
	$additional_classes[] = 'cover-suite';
	if ( is_date() ) {
		$additional_classes[] = 'guttered';
	}
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_classes ); ?>>
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
	<?php if ( is_author() && ! in_category( array( 'classmate-notes', 'future-cougs' ) ) && has_post_thumbnail() ) : ?>
		<?php $categories = ''; ?>
		<?php $categories = get_the_category(); ?>
		<a href="<?php echo get_category_link( $categories[0]->term_id ); ?>" class="flag"><?php echo $categories[0]->name; ?></a>
	<?php else: ?>
		<?php if ( has_tag( 'online-exclusive' ) ) : ?><a href="<?php the_permalink(); ?>" class="flag">Online Exclusive</a><?php endif; ?>
  	<?php if ( in_category( 'profile' ) ) : ?><a href="<?php the_permalink(); ?>" class="flag">Alumni Profile</a><?php endif; ?>
	<?php endif; ?>
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
		<?php if ( is_author() || ! in_category( array( 'classmate-notes', 'future-cougs', 'small-bites' ) ) ) : ?>
		<p class="more-button">
			<a href="<?php the_permalink(); ?>">Read More</a>
		</p>
    <?php endif; ?>
	</div>
</article>