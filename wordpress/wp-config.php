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
define('DB_NAME', 'pixeleo');

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
define('AUTH_KEY',         'OyL|q0v|i_f;]Q9R|zZac1[~;ZZZz&xM^s5bAg6EZ?-4pO_O<K0Hrj}v@}3*~lk0');
define('SECURE_AUTH_KEY',  '/20=FWKvkTa1!y;A.cNqa!]rW-My{[D<^.]@7*u*i,I8`jV9SCa^YQPv<#2ex:|6');
define('LOGGED_IN_KEY',    ':v7]oM@~7<YYX9-H}4MOjiZL*oSs#]3J#{rvLCGF8,!Oy?t;cR:mk[TSDJfjn]{5');
define('NONCE_KEY',        'je|{.|$d~uu6~*U!0g~ pV?(CX~-9c|G^yZ02)~&V7-{<PWIN)R+@mnw:19`WR+@');
define('AUTH_SALT',        'zz#ECKVbn?ZSCl:u&<Rv_[ZZF-]08k-d(UK~<])16yoCh0~~`vf#^ki_-5v,@ba6');
define('SECURE_AUTH_SALT', 'C,q&Uy4{X,bVg@SRC@]~A{2?fT7l}F!T~QH[[*qz7Q%%*&_H`C6xL+TH81gZ$<8f');
define('LOGGED_IN_SALT',   'Ehy8T|ax1${hboWt9^f,c*#$2t< L_l=&9=;,`PY(o=u4Nc7=vq{GHFvrG5rQ+c=');
define('NONCE_SALT',       'Kbq7nd$E <&*iJ8>biCxurGza5g]!!5l8~I?b;= qc34^f]<EL<ZtNpDLz&84F*C');

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
