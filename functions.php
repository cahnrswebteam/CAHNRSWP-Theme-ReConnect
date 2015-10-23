<?php

class WSU_CAHNRS_ReConnect_Theme {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_head', array( $this, 'ie_compat' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 21 );
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_filter( 'theme_page_templates', array( $this, 'theme_page_templates' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_filter( 'get_the_excerpt', array( $this, 'get_the_excerpt' ), 5 );
		add_filter( 'the_content', array( $this, 'filter_ptags_iframes') );
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
	 * Yep.
	 */
	public function ie_compat() {
		echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
	}

	/**
	 * Enqueue scripts and styles required for front end pageviews.
	 */
	public function enqueue_scripts() {
		wp_dequeue_style( 'spine-theme-extra' );
		if ( is_front_page() || is_year() ) {
			wp_enqueue_style( 'reconnect', get_stylesheet_directory_uri() . '/css/cover.css', array( 'spine-theme' ) );
			$year = get_the_time( 'Y' );
			$year_stylesheet_path = __DIR__ . '/css/' . $year . '.css';
			if ( file_exists( $year_stylesheet_path ) ) {
				wp_enqueue_style( 'reconnect-' . $year, get_stylesheet_directory_uri() . '/css/' . $year . '.css' );
			}
		}
		/*if ( is_front_page() || is_year() || is_single() ) {
			$year = get_the_time( 'Y' );
			wp_enqueue_style( 'reconnect-year', get_stylesheet_directory_uri() . '/css/' . $year . '.css' );
		}*/
		if ( is_year() ) {
			wp_enqueue_script( 'reconnect', get_stylesheet_directory_uri() . '/js/reconnect.js', array( 'jquery' ) );
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
		$classes[] = 'spine-' . esc_attr( spine_get_option( 'spine_color' ) );
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
		//unset( $templates['templates/side-right.php'] );
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

	/**
	 * Remove p tag wrapper from iframes.
	 */
	public function filter_ptags_iframes( $content ) {
  return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
	}

}

new WSU_CAHNRS_ReConnect_Theme();