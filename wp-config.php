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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'first_wp_cms' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'eeg_4eJHx>-yLAzM}`Ev8#=**i/oSegoB?;Zmt[l3YQN,5)J[fhAH4;};m:of_5H' );
define( 'SECURE_AUTH_KEY',  '<+GUR;:f{q5=-lGE+W0!1j[HTrE{~xAYCKG[/$whB;.: Y{ewx7}1.IuR4KVmhbv' );
define( 'LOGGED_IN_KEY',    '6*Y_I:x[qH;JA6nd9#-<8&a58vK0Br.qh,(1RryVPlm`5|o:C-7rC]oOoy4QUf6y' );
define( 'NONCE_KEY',        'vo#CuWqSmS{uAioWSLWLaU`[?/dg;8o(;pp=*G|0-ZZv<@`/PM2utR.fj1SLr.$/' );
define( 'AUTH_SALT',        'yLnj:^/Do@u<FvZ*6csbarDhV #Qo9.W~yg5E3Zy#`]OCrjur:Z/?FlSf%T0]nax' );
define( 'SECURE_AUTH_SALT', '$&krU6hubh>D~0A{kTw(`CvCAgvrk7BB6q^Qxu$KZ~T0e7`%d*vj@pvq<FR.m,M]' );
define( 'LOGGED_IN_SALT',   '!>`@F415`^C,9[%xxmV./)(gm#b0V;;^D<Hn30Owd4f)h5Y@U9cRg$4yusOSR*ap' );
define( 'NONCE_SALT',       '<5;hwZ>fd[a^)0X!;6es/htNWzd~KBnI!5NxC`l(u(:YkRZj9z=JDYFb}txrSte$' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
