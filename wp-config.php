<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'blog-numnu');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'T@$oZL WA:~VUAK/@FdEJIny`P0J=J>wG`pb<rOQbl<GG(QV=i(4c:5t vD%Q#P$');
define('SECURE_AUTH_KEY',  'eQ08=j@Vu%=|I@PGiAP,q)5T1E.Xb/{7_,YZH*>&}~U5+?!8~R}<Tp:7=yv7:/.f');
define('LOGGED_IN_KEY',    '_+MP4wGGJXbC:1bxYYK{8PI>4$wm}4-py&k[<W.PF>aK !2,=lGG}4L%b*om1DZ4');
define('NONCE_KEY',        'jR(^!oxB$Xc`r@ip>JKH;z+Za}IaS4M%;n@vK`*q*yI.HR]c<02!nd#X;q`9.)ig');
define('AUTH_SALT',        ',Or*~^^l;XA_`]$&j8E*qDbP6Vt!*x9{4@RwB%K9b_=>[#(s&n)BAJKU2kdzJ!d(');
define('SECURE_AUTH_SALT', 'ou(beJ{c7PYRBZ|I4)fg~?2R8>lGsPaX*cfMR~>K&gtt[V!l#z^;e3#rPD_=R@S=');
define('LOGGED_IN_SALT',   '67_bd8tl7tM6c]yDu]Qc2zvh29aMRKE+cCwr+x}L&WfG2Kq~;-F_gk_$(.@-)Z=s');
define('NONCE_SALT',       '^_g?ER$L)iN{b)T1cifFSSf$#5^.Mw?*LV T5iGx|ExqqXv*]s,^_ZbN/<e1Y!LO');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
