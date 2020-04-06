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
if (file_exists(dirname(__FILE__) . '/local.php')) {
	// Local database settings
	define( 'DB_NAME', 'local' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', 'root' );
	define( 'DB_HOST', 'localhost' );
} else {
	// Live database settings
	define( 'DB_NAME', 'gretah80_z10data' );
	define( 'DB_USER', 'gretah80_greta' );
	define( 'DB_PASSWORD', 'O;;Q5?InwG0v' );
	define( 'DB_HOST', 'localhost' );
}



/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'fS+3:`O5l=RZWcmIUGRO:?=LCH1j?#K?-Hf5(>]y+&%k)c9|e{^l@eiY!v>p]5?6');
define('SECURE_AUTH_KEY',  '{|HeW~I3ge+^F(`90k%y>0W|b  +#w/WO)qFVWE`+v+Ojl6(qVr!TcyG}z]0$7>_');
define('LOGGED_IN_KEY',    '3Ce^XGlr%NDHW:wNd:AFDbS#}>p!->k+;oEYwpZLgL#rh ~{|iz]8i+PmlnMXM^y');
define('NONCE_KEY',        'U!y~#L 0v(u0}x!.xYAEB${k[P[@F]yO-US.KlPv;/Y_q6O5Hk++K1{J2Y#_E|dh');
define('AUTH_SALT',        'd1bkX3FR`>o?!;88Au}@o-xuk/37 +-*Si63[Y@&2kFG@TRnOl3AHJl|TK0v7<zm');
define('SECURE_AUTH_SALT', '|[79bk>SEg>oe-c4z|U-i>z$p#4}!QwV|F<A3%.vx!&u^m:JUEPKGL4n,Q~2zRT/');
define('LOGGED_IN_SALT',   '|[>Z`.|sFerh73?j53}?[gQB g ?4:#TSo0NeomGEm89+JB+-S=6|XD_HsG)U!OF');
define('NONCE_SALT',       '-yxL^`+X^~#L89b~97#Z7_%QED~W6o6Sx%`fP<aZ$4N~R9ZII`h|s|+y`5y:n?L&');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
