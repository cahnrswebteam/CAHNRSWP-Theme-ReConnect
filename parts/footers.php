<?php if ( is_front_page() ) : ?>
<footer class="main-footer">
	<?php
		if ( is_active_sidebar( 'reconnect-footer' ) ) {
			dynamic_sidebar( 'reconnect-footer' );
		}
	?>
</footer>
<?php endif; ?>