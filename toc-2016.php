<?php get_header(); ?>

<main>

	<?php get_template_part( 'parts/headers' ); ?>

	<?php
		$common_args = array(
			'year' => get_the_date( 'Y' ),
			'monthnum' => get_the_date( 'n' ),
			'posts_per_page' => -1,
		);
	?>

	<?php
		$cover_stories = new WP_Query( array_merge( $common_args, array( 'category_name' => 'cover-story' ) ) );
		if ( $cover_stories->have_posts() ) :
			?>
			<section id="cover-stories" class="row single pad-bottom cover-stories">
				<div class="column">
				<?php while ( $cover_stories->have_posts() ) : $cover_stories->the_post(); ?>
				<?php
					if ( $cover_stories->current_post == 0 ) {
						get_template_part( 'articles/cover-story' );
					} else {
						get_template_part( 'articles/basic' );
					}
				?>
				<?php endwhile; ?>
				</div><!--/column-->
			</section>
			<?php
		endif;
		wp_reset_postdata();
	?>

	<?php
		$people = new WP_Query( array_merge( $common_args, array( 'category_name' => 'people' ) ) );
		if ( $people->have_posts() ) :
			?>
			<section class="row single people features gutter pad-ends">
				<header class="section-header">
					<h2>People</h2>
				</header>
				<div class="column">
				<?php while ( $people->have_posts() ) : $people->the_post(); ?>
					<?php get_template_part( 'articles/basic' ); ?>
				<?php endwhile; ?>
				</div><!--/column-->
			</section>
			<?php
		endif;
		wp_reset_postdata();
	?>

	<?php
		$places = new WP_Query( array_merge( $common_args, array( 'category_name' => 'places' ) ) );
		if ( $places->have_posts() ) :
			?>
			<section class="row single places features gutter pad-ends">
				<header class="section-header">
					<h2>Places</h2>
				</header>
				<div class="column">
				<?php while ( $places->have_posts() ) : $places->the_post(); ?>
				<?php get_template_part( 'articles/basic' ); ?>
				<?php endwhile; ?>
				</div><!--/column-->
			</section>
			<?php
		endif;
		wp_reset_postdata();
	?>

	<?php
		$partners = new WP_Query( array_merge( $common_args, array( 'category_name' => 'partners' ) ) );
		if ( $partners->have_posts() ) :
			?>
			<section class="row single partners features gutter pad-ends">
				<header class="section-header">
					<h2>Partners</h2>
				</header>
				<div class="column">
				<?php while ( $partners->have_posts() ) : $partners->the_post(); ?>
				<?php get_template_part( 'articles/basic' ); ?>
				<?php endwhile; ?>
				</div><!--/column-->
			</section>
			<?php
		endif;
		wp_reset_postdata();
	?>

	<?php
		$promise = new WP_Query( array_merge( $common_args, array( 'category_name' => 'promise' ) ) );
		if ( $promise->have_posts() ) :
			?>
			<section class="row single promise features gutter pad-ends">
				<header class="section-header">
					<h2>Promise</h2>
				</header>
				<div class="column">
				<?php while ( $promise->have_posts() ) : $promise->the_post(); ?>
				<?php
					if ( in_category( 'future-cougs' ) ) {
						get_template_part( 'articles/full-content' );
					} else {
						get_template_part( 'articles/basic' );
					}
				?>
				<?php endwhile; ?>
				</div><!--/column-->
			</section>
			<?php
		endif;
		wp_reset_postdata();
	?>

	<?php get_template_part( 'parts/footers' ); ?>

</main>
<?php

get_footer();