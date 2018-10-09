<?php
/**
 * Helper functions
 *
 * @package Readable
 */


/**
 * Blank functions, to allow tests
 */
if ( ! function_exists( 'add_filter' ) ) {
	function add_filter() {
		return;
	}
}
if ( ! function_exists( 'add_action' ) ) {
	function add_action() {
		return;
	}
}
if ( ! function_exists( 'esc_url' ) ) {
	function esc_url( $str ) {
		return $str;
	}
}



/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
if ( ! function_exists( 'readable_wp_title' ) ) {
	function readable_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'readable'), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'readable_wp_title', 10, 2 );
}



/**
 * Check if we are on the login page
 */
if ( ! function_exists( 'is_login_page' ) ) {
	function is_login_page() {
		return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
	}
}



/**
 * Pagination for WP
 *
 * @see http://codex.wordpress.org/Function_Reference/paginate_links
 */
function readable_pagination() {
	global $wp_query;
	$big = 1e6;

	$pagination = paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'total'     => $wp_query->max_num_pages,
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'type'      => 'array',
		'prev_text' => '<span class="glyphicon  glyphicon-chevron-left"></span>',
		'next_text' => '<span class="glyphicon  glyphicon-chevron-right"></span>'
	) );

	if ( ! empty( $pagination ) ) {
		foreach ( $pagination as $key => $link ) {
			if ( 0 === $key ) {
				if ( strstr( $link, 'prev' ) ) {
					printf( '%s<div class="pagination__page-numbers">', $link );
				} else {
					printf( '<div class="pagination__page-numbers">%s', $link );
				}
			} else if ( ( count( $pagination ) - 1 ) === $key ) {
				if ( strstr( $link, 'next' ) ) {
					printf( '</div>%s', $link );
				} else {
					printf( '%s</div>', $link );
				}
			} else {
				echo wp_kses_post( $link );
			}
		}
	}
}


/**
 * Calculate darker hexdec color variant
 *
 * @see http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
if ( ! function_exists( 'darken_css_color' ) ) {
	function darken_css_color( $color = '', $percent = 20 ) {
		// return if not specified
		if ( empty( $color ) )
			return;

		$percent = 100 - $percent;

		// Extract the colors. I'd prefer to use regular expressions, though there are probably other more efficient ways too.
		if( ! preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $color, $parts ) )
			return "#000000";

		// Now we have red in $parts[1], green in $parts[2] and blue in $parts[3]. Now, let's convert them from hexadecimal to integers:
		$out = ''; // Prepare to fill with the results
		for( $i = 1; $i <= 3; $i++ ) {
			$parts[$i] = hexdec( $parts[$i] );
			// Then we'll decrease them by 20 %:
			$parts[$i] = round( $parts[$i] * ( (int)$percent/100 ) ); // 80/100 = 80%, i.e. 20% darker

			// Now, we'll turn them back into hexadecimal and add them to our output string
			$out .= str_pad( dechex( $parts[$i] ), 2, '0', STR_PAD_LEFT );
		}
		return "#" . $out;
	}
}


/**
 * Create a style for the HTML attribute from the array of the CSS properties
 */
if ( ! function_exists( 'create_style_attr' ) ) {
	function create_style_attr( $attrs ) {
		$bg_style = '';

		if( is_array( $attrs ) ) {
			$attrs = array_filter( $attrs, "strlen" );
		}

		if( ! empty( $attrs ) ) {
			$bg_style = ' style="';
			foreach ( $attrs as $key => $value ) {
				if( 'background-image' === $key ) {
					$bg_style .= $key . ': url(\'' . $value . '\'); ';

				} else {
					$bg_style .= $key . ': ' . $value . '; ';
				}
			}
			$bg_style .= '"';
		}

		return $bg_style;
	}
}


/**
 * Filter the array to return only for the social icons links / values
 * @return array The array of the social icons and links, or empty array when there is no options in the DB
 */
if ( ! function_exists( 'get_social_icons_links' ) ) {
	function get_social_icons_links( $all_options ) {
		if( ! is_array( $all_options ) ) {
			return array();
		}

		$out = array();

		foreach ($all_options as $key => $value) {
			if ( starts_with_zocial( $key ) && ! empty( $value ) ) {
				$out[$key] = $value;
			}
		}

		return $out;
	}

	// helper functions for this helper
	function starts_with_zocial( $str ) {
		return strpos( $str , 'zocial-' ) === 0;
	}
}


/**
 * Check if WooCommerce is active
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
		return class_exists( 'Woocommerce' );
	}
}


/**
 * Polyfill for the array_replace_recursive native PHP >= 5.3.0 function
 *
 * @link http://php.net/manual/en/function.array-replace-recursive.php
 */

if ( ! function_exists( 'array_replace_recursive' ) ) {
	function array_replace_recursive( $array, $array1 ) {

		if ( ! function_exists( 'recurse' ) ) {
			function recurse( $array, $array1 ) {
				foreach ( $array1 as $key => $value ) {
					// create new key in $array, if it is empty or not an array
					if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
						$array[$key] = array();
					}

					// overwrite the value in the base array
					if (is_array($value)) {
						$value = recurse($array[$key], $value);
					}
					$array[$key] = $value;
				}
				return $array;
			}
		}

		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if (!is_array($array)) {
			return $array;
		}
		for ($i = 1; $i < count($args); $i++) {
			if (is_array($args[$i])) {
				$array = recurse($array, $args[$i]);
			}
		}
		return $array;
	}
}



/**
 * Filter the theme mods only for the social icons options
 * @return array The array of the social icons and links, or empty array when there is no options in the DB
 */
if ( ! function_exists( 'get_social_icons_navbar_links' ) ) {
	function get_social_icons_navbar_links( $mods = array() ) {
		if( empty( $mods ) || ! is_array( $mods ) ) {
			return array();
		}

		$mods = array_filter( $mods, 'strlen' );
		$out = array();

		foreach ( $mods as $network => $url ) {
			$url = trim( $url );
			if ( ! empty( $url ) && is_string( $url ) ) {
				if ( 'email' === $network && is_email( $url ) ) {
					$out[$network] = esc_url( 'mailto:' . sanitize_email( $url ) );
				} else {
					$out[$network] = esc_url( $url );
				}
			}
		}

		return $out;
	}
}


/**
 * Because the WP doesn't have the echo-free version of the_category() I created my own
 * @param  string $sep separator
 * @return string
 */
if ( ! function_exists( 'get_the_nice_category' ) ) {
	function get_the_nice_category( $sep ) {
		global $post;
		ob_start();
		the_category( $sep );
		return ob_get_clean();
	}
}


/**
 * comments_number() does not use _n function, here we are to fix that
 * @return void
 */
if ( ! function_exists( 'the_nice_comments_number' ) ) {
	function the_nice_comments_number() {
		global $post;
		printf(
			_n( '%s Comment', '%s Comments', get_comments_number(), 'readable' ), number_format_i18n( get_comments_number() )
		);
	}
}

if ( ! function_exists( 'readable_get_first_oembed_from_content' ) ) {
	function readable_get_first_oembed_from_content( $content ) {
		if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $content, $matches ) ) {
			return wp_oembed_get( $matches[1] );
		}

		return false;
	}
}

/**
 * A wp_kses extension function - add script tag to the wp_kses allow tags.
 *
 * @param  string $data The string to be sanitized.
 * @return string       Sanitized string.
 */

if ( ! function_exists( 'readable_wp_kses_script' ) ) {
	function readable_wp_kses_script( $data ) {
		global $allowedposttags;
		$allowedposttags_script = $allowedposttags;
		$allowedposttags_script['script'] = array( 'type' => array (), 'src' => array () );

		return wp_kses( $data, $allowedposttags_script );
	}
}


/**
 * Get the woocommerce shop sidebar position.
 *
 * @return string       no|left|right.
 */
if ( ! function_exists( 'readable_get_shop_sidebar_position' ) ) {
	function readable_get_shop_sidebar_position() {
		$sidebar_position = get_field( 'sidebar_position', (int) get_option( 'woocommerce_shop_page_id' ) );
		return empty( $sidebar_position ) ? 'right' : $sidebar_position;
	}
}
