<?php
if ( is_month() ) {
	$year = get_the_date( 'Y' );
	get_template_part( 'toc', $year );
} else {
	get_template_part( 'index' );
}
?>