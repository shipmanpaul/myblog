<?php
/**
 * Main title area above the content
 *
 * @package readable
 */

$subtitle = false;

if( is_home() || is_single() ) {
	$title    = get_theme_mod( 'blog_tagline' );
	if ( strlen( $subtitle ) < 1 ) {
		$subtitle = false;
	}
} else if ( is_page() ) {
	$title = get_the_title();
} else if ( is_category() ) {
	$title    = esc_html__( 'Category Archive For', 'readable' );
	$subtitle = '&quot;' . single_cat_title( '', false ) . '&quot;';
} else if ( is_tag() ) {
	$title    = esc_html__( 'Tag Archive For', 'readable' );
	$subtitle = '&quot;' . single_tag_title( '', false ) . '&quot;';
} else if ( is_search() ) {
	$title    = esc_html__( 'Search Results For', 'readable' );
	$subtitle = '&quot;' . get_search_query() . '&quot;';
} else if ( is_date() ) {
	$title    = esc_html__( 'Entries Published On', 'readable' );
	$subtitle = get_the_date( 'F, Y' );
} else if ( is_author() ) {
	$title    = esc_html__( 'Entries Written By', 'readable' );
	$subtitle = get_the_author();
} else {
	$title = strip_tags( get_the_title() );
}

?>

<div class="archives-title">
	<h3><?php echo esc_html( $title ); echo ! empty( $subtitle ) ? ' <span class="archives-title__subtitle h2">' . esc_html( $subtitle ) . '</span>' : ''; ?></h3>
</div>