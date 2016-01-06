<?php
$most_recent_published_post = get_posts( 'posts_per_page=1' );
foreach( $most_recent_published_post as $post ) {
	$year = get_the_date( 'Y' );
}
get_template_part( 'toc', $year );
?>