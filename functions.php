<?php

include_once( __DIR__ . '/includes/video-embed.php' );

class WSU_CAHNRS_ReConnect_Theme {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 21 );
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_filter( 'nav_menu_css_class', array( $this, 'nav_menu_css_class'), 11, 3 );
		add_filter( 'theme_page_templates', array( $this, 'theme_page_templates' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_filter( 'get_the_excerpt', array( $this, 'get_the_excerpt' ), 5 );
	}

	/**
 	 * Remove some stuff Wordpress adds to the header.
 	 */
	public function init() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'parent_post_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'start_post_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'wp_head', 'rel_canonical');
		remove_action( 'wp_head', 'wp_generator' );
		add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojis_tinymce' ) );
	}

	/**
	 * Filter function to remove the tinymce emoji plugin.
	 *
	 * @param array $plugins
	 * @return array Difference betwen the two arrays
	 */
	public function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}

	/**
	 * Enqueue scripts and styles required for front end pageviews.
	 */
	public function enqueue_scripts() {
		wp_dequeue_style( 'spine-theme-extra' );
		if ( is_front_page() || is_month() ) {
			wp_enqueue_style( 'reconnect', get_stylesheet_directory_uri() . '/css/cover.css', array( 'spine-theme-child' ) );
			if ( is_front_page() ) {
				$recent_post = new WP_Query( 'posts_per_page=1' );
				while ( $recent_post->have_posts() ) : $recent_post->the_post();
					$date = get_the_time( 'Y-m' );
				endwhile;
			} else {
				$date = get_the_time( 'Y-m' );
			}
			$date_stylesheet_path = __DIR__ . '/css/' . $date . '.css';
			if ( file_exists( $date_stylesheet_path ) ) {
				wp_enqueue_style( 'reconnect-' . $date, get_stylesheet_directory_uri() . '/css/' . $date . '.css', array( 'reconnect' ) );
			}
		}
		if ( is_author() ) {
			wp_enqueue_style( 'author', get_stylesheet_directory_uri() . '/css/author.css', array( 'spine-theme-child' ) );
		}
	}

	/**
	 * Body classes.
	 */
	public function body_class( $classes ) {
		if ( get_post_meta( get_the_ID(), 'body_class', true ) ) {
			$classes[] = esc_attr( get_post_meta( get_the_ID(), 'body_class', true ) );
		}
		if ( is_customize_preview() ) {
			$classes[] = 'customizer-preview';
		}
		return $classes;
	}

	/**
	 * Remove classes from posts page menu item when not applicable.
	 *
	 * @param array $classes Current list of nav menu classes.
	 * @param WP_Post $item Post object representing the menu item.
	 * @param stdClass $args Arguments used to create the menu.
	 *
	 * @return array Modified list of nav menu classes.
	 */
	public function nav_menu_css_class( $classes, $item, $args ) {
		if ( 'site' === $args->theme_location && is_author() && $item->url === get_permalink( get_option( 'page_for_posts' ) ) ) {
			$classes = array();
		}
		return $classes;
	}

	/**
	 * Remove most of the Spine page templates.
	 */
	public function theme_page_templates( $templates ) {
		unset( $templates['templates/blank.php'] );
		unset( $templates['templates/halves.php'] );
		unset( $templates['templates/margin-left.php'] );
		unset( $templates['templates/margin-right.php'] );
		unset( $templates['templates/section-label.php'] );
		unset( $templates['templates/side-left.php'] );
		unset( $templates['templates/side-right.php'] );
		//unset( $templates['templates/single.php'] );
		return $templates;
	}

	/**
	 * Register sidebars used by the theme.
	 */
	public function widgets_init() {
		$widget_options = array(
			'name'          => __( 'ReConnect footer', 'reconnect-footer' ),
			'id'            => 'reconnect-footer',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<header>',
			'after_title'   => '</header>'
		);
		register_sidebar( $widget_options );
	}

	/**
	 * Provide a custom trimmed excerpt.
	 *
	 * @param string $text The raw excerpt.
	 *
	 * @return string The modified excerpt.
	 */
	function get_the_excerpt( $text ) {
		$raw_excerpt = $text;
		if ( '' == $text ) {
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$text = str_replace(']]>', ']]&gt;', $text);
			$text = substr( $text, 0, strpos( $text, '</p>' ) + 4 );
		}
		return $text;
	}

}

new WSU_CAHNRS_ReConnect_Theme();