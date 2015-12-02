<?php get_header(); ?>

<main class="spine-search-index">

<?php get_template_part('parts/headers'); ?>

<section class="row single gutter pad-ends">

	<div class="column one">

	<?php
		/*$base = 'https://people.wsu.edu/wp-json/wp/v2/people?filter[meta_key]=_wsuwp_profile_ad_nid&filter[meta_value]=';
		$request_url = $base . get_the_author_meta( 'user_login' );
		$response = wp_remote_get( $request_url );
		if ( is_wp_error( $response ) ) {
			echo '<!-- remote get error -->';
		}
		$data = wp_remote_retrieve_body( $response );
		if ( empty( $data ) ) {
			echo '<!-- remote retrieve error -->';
		}
		$person = json_decode( $data );
		if ( $person ) {
			$author_name = $person->title->rendered;
			$author_photo = $person->profile_photo;
			$author_bio = $person->content->rendered;
		} else {*/
			$author_name = get_the_author();
			$author_bio = $person->content->rendered;
		//}
	?>

	<?php if ( is_paged() ) : ?>

		<h1 class="author-title">Articles by <?php echo esc_attr( $author_name ); ?></h1>

	<?php else: ?>

		<h1 class="author-title"><?php echo esc_attr( $author_name ); ?></h1>

		<?php if ( $author_photo ) : ?>
		<img src="<?php esc_url( $author_photo ); ?>" class="author-photo" />
		<?php endif; ?>

		<?php if ( $author_bio ) { echo wp_kses_post( $author_bio ); } ?>

		<h2 class="author-articles">Articles</h2>

		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'articles/basic' ); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!--/column-->

</section>

<?php
/* @type WP_Query $wp_query */
global $wp_query;

$big = 99164;
$args = array(
	'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format'       => 'page/%#%',
	'total'        => $wp_query->max_num_pages, // Provide the number of pages this query expects to fill.
	'current'      => max( 1, get_query_var('paged') ), // Provide either 1 or the page number we're on.
);
?>
	<footer class="main-footer archive-footer">
		<section class="row single pager prevnext gutter">
			<div class="column one">
				<?php echo paginate_links( $args ); ?>
			</div>
		</section>
	</footer>

	<?php get_template_part( 'parts/footers' ); ?>

</main>
<?php

get_footer();