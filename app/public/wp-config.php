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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'meffeYqv3GF4SACZYnMtlueADWBOJYmeXBILhdAb/odx+h1p3iniIE/4Wll1JB7LwsSz/BeGh8vrM2EVi8J1Hg==');
define('SECURE_AUTH_KEY',  '8XdwYZKq3/hOFQhX93Zp7FQJLHKlnnlJxQ4lxpvZdXaNrdjMsusAC7d7AVeWBPjYQygBRYvV0laHFi58r/lydQ==');
define('LOGGED_IN_KEY',    'c3jqYUk67lHlK357Krj7TfQjzviK5RZbNDopnC6iDHrhl7SMu1Bd5fMA1s5M+G+HZJ8l+y5Yq58eKbiwHnaZJg==');
define('NONCE_KEY',        'iu5+IV3C4Zz6Qzv0zL7CoqRYKvt9JFMtNWJeUvLq9FJOrCoupEfiOQsB7s1AD1cMSCqH36DREMzJgKMj562H3A==');
define('AUTH_SALT',        'N3L6WkgS7sAnnp2t8P4lVkvpqVhR6wKAjVk/8kK28UPisuVGKg5gBm9DrZjFP+Z1mZw0/kH9IvEZe9Qn2ONvJQ==');
define('SECURE_AUTH_SALT', 'rNnbVeX0+dVVMHt9pyXbAkk5hLNrW4Tbuf/kggw/XnEMxLGOcKULWgvm3R5PhjT28cU06bCBhREPs7oX4dEkng==');
define('LOGGED_IN_SALT',   'z8VJWma4fCiCNSJLJH2smMLOPDLAqJYFmhVgL767kBbI2zbInleWhhrJhaaG/gxXsDuho1bmbf2iDjqeye4ENQ==');
define('NONCE_SALT',       'ebeAorAMQxIDdSk70+KVBNjb03Ow3llrwTzgLPBLQTMK2c6HAeojGDA2csNiHsX4TOFIuxgE1LhuZEpBPEOMUA==');

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
