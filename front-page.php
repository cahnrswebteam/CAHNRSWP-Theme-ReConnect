<?php get_header(); ?>

<main class="<?php echo $main_class; ?>">

	<?php get_template_part( 'parts/headers' ); ?>

	<?php
		$year = date( 'Y' );
		$common_args = array(
			'year' => $year,
			'posts_per_page' => -1,
		);
	?>

	<?php
		//$common_args['category_name'] = 'cover-story';
  	//$cover_stories = new WP_Query( $common_args );
		$cover_stories = new WP_Query( array_merge( $common_args, array( 'category_name' => 'cover-story' ) ) );
		//$cover_stories->found_posts;
		if ( $cover_stories->have_posts() ) :
			?>
			<section id="cover-stories" class="row single pad-bottom cover-stories unbound recto<?php if ( is_front_page() ) { echo ' verso'; } ?>">
				<div class="column">
				<?php while ( $cover_stories->have_posts() ) : $cover_stories->the_post(); ?>
        <?php
					if ( $cover_stories->current_post == 0 /*&& !is_paged()*/ ) {
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
		//unset( $common_args['category_name'] );
	?>

	<?php
		$common_args['category_name'] = 'feature';
		$feature_stories = new WP_Query( $common_args );
		if ( $feature_stories->have_posts() ) :
			?>
			<section class="row single features gutter pad-bottom">
      	<header class="section-header">
					<h2>Features</h2>
				</header>
				<div class="column">
				<?php while ( $feature_stories->have_posts() ) : $feature_stories->the_post(); ?>
				<?php get_template_part( 'articles/basic' ); ?>
				<?php endwhile; ?>
				</div><!--/column-->
			</section>
			<?php
		endif;
		wp_reset_postdata();
		unset( $common_args['category_name'] );
	?>

	<?php
		$common_args['category_name'] = 'alumni-news';
		$alumni_news = new WP_Query( $common_args );
		if ( $alumni_news->have_posts() ) :
			?>
			<section class="row single alumni-news gutter pad-ends">
      	<header class="section-header">
					<h2>Alumni News</h2>
				</header>
				<div class="column">
				<?php while ( $alumni_news->have_posts() ) : $alumni_news->the_post(); ?>
				<?php
					if ( in_category( 'profile' ) ) {
						get_template_part( 'articles/basic' );
					} elseif ( in_category( array( 'future-cougs', 'classmate-notes' ) ) ) {
						get_template_part( 'articles/full-content' );
					}
				?>
				<?php endwhile; ?>
				</div><!--/column-->
			</section>
			<?php
		endif;
		wp_reset_postdata();
		unset( $common_args['category_name'] );
	?>

	<?php
		$common_args['category_name'] = 'small-bites';
		$small_bites = new WP_Query( $common_args );
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
		unset( $common_args['category_name'] );
	?>

	<?php get_template_part( 'parts/footers' ); ?>

</main>
<?php

get_footer();