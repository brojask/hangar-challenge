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
define('DB_NAME', 'wp_sandbox');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '@7g.aLw`yk3~U+T-Q*=<,KrBb=E:._U(l@b}6/Og2^A>eTzEWOY{8uBjv;E$KkFi');
define('SECURE_AUTH_KEY',  'VesCs8@1UHw4ck2ZG*O96ISOi%BIj.sZQ+,]g6M:lpceh+/l=n=x|hU }DB_)7Ur');
define('LOGGED_IN_KEY',    '+yEqL@IO%U3f[v`RWCJ6FKlH%_DbmB)GdE:2.},Q~r9p#DR^T06|&>x(DmO5Fl5M');
define('NONCE_KEY',        ' >T@]]{.:=O.r Vj*F1_Z$L8!S%`?FoMwY$%XzRKt<Ra@y)z4d|~lP,:|6/>z8Fj');
define('AUTH_SALT',        'Pat#LR(kh?y#gUUg>a9TH5O`W@ewCA{@Zn4Lahh-:j+h}@=uRNL)wj>lMhq2Q0de');
define('SECURE_AUTH_SALT', '~=f6r2:e2,(h8A?MNC D5` 0$<JX=[g!+rLI*=tuD]vKo<sG.TDH<M0jY@Rycj:U');
define('LOGGED_IN_SALT',   'G$$g~/swl H9@S[|OBDB]2-%:Yf22`@-3G]rXpC8o@0J0~]F=H,e?mG^ BOkJ!~)');
define('NONCE_SALT',       ' q^`:GdZJ2kFyYO.:)hU:O;DYZxbzm2=q#J2HstPY43ZB4Qa,[(S51l]=vDbe2@K');

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
define( 'WP_DEBUG', TRUE );
define('WP_DEBUG_LOG', WP_DEBUG );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
