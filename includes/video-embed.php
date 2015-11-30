<?php

class ReConnect_Video_Embed {

	public function __construct() {
		add_shortcode( 'reconnect_video', array( $this, 'display_reconnect_video' ) );
	}

	/**
	 * Display custom markup used for video embeds.
	 *
	 * [wsu_feature_youtube src="https://www.youtube.com/embed/OmN5coh0heM?modestbranding=1;showinfo=0;controls=0;rel=0" width="560" height="315"]
	 * <iframe src="//player.vimeo.com/video/89635575?title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	 * @param $atts
	 *
	 * @return string
	 */
	public function display_reconnect_video( $atts ) {

		$defaults = array(
			'src'     => '',
			'align'   => '',
			'caption' => '',
		);

		$atts = shortcode_atts( $defaults, $atts );

		if ( empty( $atts['src'] ) ) {
			return '';
		}

		$url_parts = parse_url( $atts['src'] );
		if ( ! isset( $url_parts['host'] ) || ! in_array( $url_parts['host'], array( 'www.youtube.com', 'youtube.com', 'player.vimeo.com' ) ) ) {
			return '';
		}

		$wrapper_classes = array( 'reconnect-video-wrapper' );

		if ( 'left' === $atts['align'] || 'right' === $atts['align'] ) {
			$wrapper_classes[] = 'align' . esc_attr( $atts['align'] );
		}
		
		$wrapper_classes = implode( ' ', $wrapper_classes );

		$url = esc_url_raw( $atts['src'] );
		
		ob_start();
		?>
		<div class="<?php echo $wrapper_classes; ?>">
			<div>
				<iframe width="500" height="281" src="<?php echo esc_attr( $url ) ?>" frameborder="0" allowfullscreen></iframe>
			</div>
      <?php if ( $atts['caption'] ) : ?>
			<p><?php echo wp_kses_post( $atts['caption'] ); ?></p>
			<?php endif;?>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

}

new ReConnect_Video_Embed();