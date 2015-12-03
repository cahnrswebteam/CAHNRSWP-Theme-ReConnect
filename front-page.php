<?php get_header(); ?>

<main class="<?php echo $main_class; ?>">

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
		$feature_stories = new WP_Query( array_merge( $common_args, array( 'category_name' => 'feature' ) ) );
		if ( $feature_stories->have_posts() ) :
			?>
			<section class="row single features gutter pad-ends">
				<header class="section-header">
					<h2>Features</h2>
				</header>
				<div class="column">
				<?php while ( $feature_stories->have_posts() ) : $feature_stories->the_post(); ?>
					<?php
						if ( has_tag( 'video' ) )  {
							get_template_part( 'articles/video' );
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
		$alumni_news = new WP_Query( array_merge( $common_args, array( 'category_name' => 'alumni-news' ) ) );
		if ( $alumni_news->have_posts() ) :
			?>
			<section class="row single alumni-news gutter pad-ends">
				<header class="section-header">
					<h2>Alumni News</h2>
				</header>
				<div class="column">
				<?php while ( $alumni_news->have_posts() ) : $alumni_news->the_post(); ?>
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

	<?php
		$small_bites = new WP_Query( array_merge( $common_args, array( 'category_name' => 'small-bites' ) ) );
		if ( $small_bites->have_posts() ) :
			?>
			<section class="row single small-bites gutter pad-ends">
				<header class="section-header">
					<h2><span class="small">Small</span> Bites <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/small-bites.png" width="130" height="31" alt="Small Bites" /></h2>
				</header>
				<div class="column">
				<?php while ( $small_bites->have_posts() ) : $small_bites->the_post(); ?>
				<?php get_template_part( 'articles/basic' ); ?>
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