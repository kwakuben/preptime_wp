<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define( 'DB_NAME', 'exampre1_a2wp735' );

/** MySQL database username */
define( 'DB_USER', 'exampre1_a2wp735' );

/** MySQL database password */
define( 'DB_PASSWORD', 'VSZ743p(9@' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'dvcrhn4krgd5m4rtqnxufbkanwe0lgubih95ftccljzlputugvzvbfgxputpt1ak' );
define( 'SECURE_AUTH_KEY',  'td2fccoms8kzk99qqka9wio9jqchicsmxtqclpsd7zhiv4sfbilsvlzntvamogcv' );
define( 'LOGGED_IN_KEY',    'owgx5wklhwgrocwtzlrqmbtsnda4xl4osq07e7x2aivyfyf6kci0s5m7ptucqqcv' );
define( 'NONCE_KEY',        'y2emfl05yckmkfjqnmsa3csrbmjhdbqmdmjgntrjqlmwt1twa98epexowsugkpaq' );
define( 'AUTH_SALT',        'tbxjnlbtvwpdn8j8pn5kqq2vs3ljccx5pkgmxaq67eqjb9zmgsxtjznjrtpwy8ui' );
define( 'SECURE_AUTH_SALT', 'c5p02r2x8gslujdang50gvnxngugkhmu8p7uczb0343nyhpte3qjtmkpjc9bblxn' );
define( 'LOGGED_IN_SALT',   'ejgazniqttkhncwwkqwncj10zriahx9z7u24q3bixpayvnzykecjl6d6i9s9c8tx' );
define( 'NONCE_SALT',       'kjkhpmfpa2ertr91sewuamuy8dq2hhzhppxijtklvg6y3dsxcejmpkyficq4pmzc' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpmw_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
