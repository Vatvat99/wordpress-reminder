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
define('DB_NAME', 'wordpress_dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'qMeJgAk9tm$[Gz+t*&iD^P.w.3M&Wa}N=W1jaEy_`#L%3g>p;HC$f&G/o!2*YP-w');
define('SECURE_AUTH_KEY',  '$$[r>)^gGU2(j=A:q#`fwh;tU[^n-nKLdQ%5z Yge)?6fhMK+}iCLdWedsH0u[?m');
define('LOGGED_IN_KEY',    '8DnO{@5Bp4LnZT&&k_V8b[,hLM7FD`2bk3j !OcIZn]a?W#1=jI$How0Sm3?cN(j');
define('NONCE_KEY',        '!Ob10sN0}0QR;v{ux0T4^UmX9o5eXhNjVuVL7P}wWufSpXmyx96a23u(f|-[v}Kq');
define('AUTH_SALT',        '5yCk}ui?X@Eg{(g+y,DhDvpo?)6s%-`oO%ewk6`Zi[VV8Mi%7>gs :&leS@w.;8(');
define('SECURE_AUTH_SALT', 'qh/x<*#$v?h0#uS#688-/j`nA~VbR[gQMI#v.;ghPbYQ<.CtL/dr3lxJ!s~h4tfS');
define('LOGGED_IN_SALT',   '+;pfK$8K5R(~yck)>kFj[3p^(u{)jvC4SE8Au}P/iSB/P`:m4<c`hYXOwR,fM?Qv');
define('NONCE_SALT',       'il5o]k.H6vJKL);e-fmD.{hkA1Cce>z*5KqrIf4Y^ q4--2#]dczS }RhNprAeJW');

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

 // Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
// define( 'WP_DEBUG_DISPLAY', false );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
// define( 'SCRIPT_DEBUG', false );

//  Saves the database query to an array, which is stored in the global $wpdb->queries
// define( 'SAVEQUERIES', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
