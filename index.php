<?php get_header(); ?>

<main class="spine-main-index">

	<?php get_template_part('parts/headers'); ?>

	<?php
		$query = new WP_Query( array(
			'posts_per_page' => -1,
			'post_type' => 'post',
			'post_status' => 'publish',
			// exclude Connections stuff if archiving it on this site...
		) );

		if ( $query->have_posts() ) :

			$issues = array();
			$latest = true;

			while ( $query->have_posts() ) : $query->the_post();

				$issue = date( 'F Y', strtotime( $post->post_date ) );
				$year = date( 'Y', strtotime( $post->post_date ) );

				if ( ! in_array( $issue, $issues ) ) :

					?>
					<section class="row single pad-ends gutter">
						<header class="section-header">
							<h2><?php echo $year; ?></h2>
						</header>
						<?php
							$issue_month = get_the_time( 'm' );
							$issue_link = ( $latest ) ? trailingslashit( get_home_url() ) : get_month_link( $year, $issue_month );
							$background_image = spine_has_featured_image() ? ' style="background-image: url(' . esc_url( spine_get_featured_image_src( 'spine-medium_size' ) ) . ');"' : '';
						?>
						<div class="column"<?php echo $background_image; ?>>
							<?php $archive_title = wp_kses_post( get_post_meta( $post->ID, 'archive_title', true ) ); ?>
							<?php if ( $archive_title ) : ?>
								<div class="archive-title"><?php echo $archive_title; ?></div>
							<?php else: ?>
								<h3><?php the_title(); ?></h3>
							<?php endif; ?>
							<a href="<?php echo $issue_link; ?>" title="Read the <?php echo $year; ?> issue of ReConnect"></a>
						</div>
					</section>
					<?php

					$issues[] = $issue;
					$latest = false;

        endif;

			endwhile;

		endif;
	?>

	<?php get_template_part( 'parts/footers' ); ?>

</main>

<?php

get_footer();