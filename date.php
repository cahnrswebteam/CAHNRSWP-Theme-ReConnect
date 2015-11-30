<?php
if ( is_month() ) {
	get_template_part( 'front-page' );
} else {
	get_template_part( 'index' );
}
?>