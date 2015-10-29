<header class="main-header">

	<hgroup>

		<?php
			$year = get_the_time( 'Y' );
			$month = get_the_time( 'm' );
		?>

		<?php if ( is_front_page() || is_month() ) : ?>

				<?php if ( is_front_page() ) : ?>

				<nav class="reconnect-header-nav">
				<?php
					$spine_site_args = array(
						'theme_location'  => 'site',
						'menu'            => 'site',
						'container'       => false,
						'container_class' => false,
						'container_id'    => false,
						'menu_class'      => null,
						'menu_id'         => null,
						'items_wrap'      => '<ul>%3$s</ul>',
						'depth'           => 5,
					);
					wp_nav_menu( $spine_site_args );
				?>
				</nav>

				<?php endif; ?>

		<sup class="sup-header">
			<span class="sup-header-default">
				<?php
					$default_header = get_stylesheet_directory_uri() . '/images/reconnect.png';
					$current_header_path = dirname( __DIR__ ) . '/images/reconnect-' . $year . '-' . $month . '.png';
					$current_header = get_stylesheet_directory_uri() . '/images/reconnect-' . $year . '-' . $month . '.png';
					$header_img = ( file_exists( $current_header_path ) ) ? $current_header : $default_header;
				?>
				<img src="<?php echo esc_url( $header_img ); ?>" width="728" height="86" alt="ReConnect <?php echo $year; ?>" />
			</span>
		</sup>

		<sub class="sub-header">
			<span class="sub-header-default">WSU College of Agricultural, Human, and Natural Resource Sciences Alumni &amp; Friends</span>
		</sub>

		<?php else: ?>

		<div class="cahnrs-header-group">
			<div id="cahnrs-heading">
				<a href="http://cahnrs.wsu.edu/">CAHNRS</a>
				<div class="quicklinks">
					<dl>
						<dt><a href="http://cahnrs.wsu.edu/">College of Agricultural, Human, and Natural Resource Sciences</a></dt>
						<span class="cahnrs-ql-padding">CAHNRS</span><dd>
						 	<ul>
								<li><a href="http://cahnrs.wsu.edu/academics/">Students</a></li>
								<li><a href="http://cahnrs.wsu.edu/research/">Research</a></li>
								<li><a href="http://cahnrs.wsu.edu/extension/">Extension</a></li>
								<li><a href="http://cahnrs.wsu.edu/alumni/">Alumni and Friends</a></li>
								<li><a href="http://cahnrs.wsu.edu/fs/">Faculty and Staff</a></li>
							</ul>
						</dd>
					</dl>
				</div>
			</div><sup class="sup-header">
				<?php if ( is_single() || is_month() ) : ?><span class="year"><?php echo $year; ?></span> <?php endif; ?><span class="re">Re</span>Connect
			</sup>
		</div>

		<?php
			if ( is_single() ) {
				$category = wp_get_post_categories( $post->ID, array( 'fields' => 'names' ) );
				?><span class="category"><?php echo $category[0]; ?><?php if ( 'Small Bites' === $category[0] ) { ?> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/small-bites.png" width="130" height="31" alt="Small Bites" /><?php } ?></span><?php
			}
		?>

		<?php endif; ?>

	</hgroup>

</header>