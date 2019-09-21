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
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
  include( dirname( __FILE__ ) . '/local-config.php' );
} else {
  define( 'DB_NAME', 'stephanie_falk_');
  define( 'DB_USER', 'stephanie_falk_');
  define( 'DB_PASSWORD', 'rJdpagMG' );
  define( 'DB_HOST', 'stephanie-falk.com.mysql');
}

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
define('AUTH_KEY',         'KBNMzaI&%7M8K_yfEKjqp->smN{m6Jov3;m/$#q k@a4B({$5d]nNC=YYYxj;bu9');
define('SECURE_AUTH_KEY',  'nQ7]HRxd.&Z:^9zw[eSUgQk)RXm i[NyH^h&W`l PDW1h,g!]2gC[:|mbaHnwHak');
define('LOGGED_IN_KEY',    ',Gxr #%ISF=;:HOiX:vgi[$+8ZAhGRaV#QGlL<Z{k78#Jc#{[ZO4<$3DXyp@K5.L');
define('NONCE_KEY',        '3Z)B(Ln$C$WSD0Kjt<=j =_kc]g[PSyJnBB!*ER.nM+&k=@/hWB#8bzcL?7&v1xI');
define('AUTH_SALT',        'iKzuT.ZH} grP)`^2:t}|_7)|oM03O5l+=%YB$)OyLGZ$WB-rTKC9w=:.5S;tpk2');
define('SECURE_AUTH_SALT', '~<y`+|Mz aRw23Ygckl55Shi?,A)}Gd_0N{7P1Rd=vJqzNjUORL}`NgWf$4E5~|E');
define('LOGGED_IN_SALT',   '.V geqvD&Qf@YH^&f8,MS?V[cFE5l:chKZe>8*A[Zk=7gE3<8f8X gcaX-%oYWda');
define('NONCE_SALT',       'T?oYT%SpA..|UP<n_8apEQ_g8p>Wn5taJ$Z<@y!CM^m8qXrLHYPs?F:{B=BShxVq');

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
if ( !defined( 'WP_DEBUG' ) )
	define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');