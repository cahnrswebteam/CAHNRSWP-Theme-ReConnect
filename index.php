<?php

get_header();

if ( is_home() ) {
	$main_class = 'spine-main-index';
} elseif ( is_author() ) {
	$main_class = 'spine-author-index';
} elseif ( is_category() ) {
	$main_class = 'spine-category-index';
} elseif ( is_tag() ) {
	$main_class = 'spine-tag-index';
} elseif ( is_tax() ) {
	$main_class = 'spine-tax-index';
} elseif ( is_archive() ) {
	$main_class = 'spine-archive-index';
} elseif ( is_search() ) {
	$main_class = 'spine-search-index';
} else {
	$main_class = '';
}

?>

<main class="<?php echo $main_class; ?>">

	<?php get_template_part('parts/headers'); ?>

	<?php // Probably move this guy out of here.
		function posts_by_year() {
			// array to use for results
			$years = array();
	
			// get posts from WP
			$query = new WP_Query( array(
				'posts_per_page' => -1,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				// exclude Connections stuff if archiving it on this site...
			) );
			
			$posts = $query->get_posts();
		
			// loop through posts, populate $years arrays
			foreach( $posts as $post ) {
				$years[ date( 'Y', strtotime( $post->post_date ) ) ][] = $post;
			}
		
			// reverse sort by year
			krsort( $years );
		
			return $years;
		}
	?>

	<?php /*foreach ( posts_by_year() as $year => $posts ) : ?>
  	<?php if ( $year != get_the_time( 'Y' ) ) : ?>
		<section class="row single pad-ends">
			<header class="section-header">
				<h2><a href="<?php echo get_year_link( $year ); ?>"><?php echo $year; ?></a></h2>
			</header>
			<div class="column guttered">	
				<ul>
				<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</section>
		<?php endif; ?>
	<?php endforeach;*/ ?>

	<?php foreach ( posts_by_year() as $year => $posts ) : ?>
  	<?php //if ( $year != get_the_time( 'Y' ) ) : ?>
		<?php $year_link = ( $year == get_the_time( 'Y' ) ) ? trailingslashit( get_home_url() ) : get_year_link( $year ); ?>
		<section class="row single pad-ends gutter">
			<header class="section-header">
				<h2><?php echo $year; ?></h2>
			</header>
			<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
				<?php $background_image = spine_has_featured_image() ? ' style="background-image: url(' . esc_url( spine_get_featured_image_src( 'spine-medium_size' ) ) . ');"' : ''; ?>
				<div class="column"<?php echo $background_image; ?>>
					<?php $archive_title = wp_kses_post( get_post_meta( $post->ID, 'archive_title', true ) ); ?>
					<?php if ( $archive_title ) : ?>
					<div class="archive-title"><?php echo $archive_title; ?></div>
					<?php else: ?>
					<h3><?php the_title(); ?></h3>
					<?php endif; ?>
					<a href="<?php echo $year_link; ?>" title="Read the <?php echo $year; ?> issue of ReConnect"></a>
				</div>
			<?php break; endforeach; ?>
		</section>
		<?php //endif; ?>
	<?php endforeach; ?>

	<?php get_template_part( 'parts/footers' ); ?>

</main>
<?php

get_footer();