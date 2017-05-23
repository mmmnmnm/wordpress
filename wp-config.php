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
define('DB_NAME', '2821_mmmnmnm_com');

/** MySQL database username */
define('DB_USER', '2821_mmmnmnm_com');

/** MySQL database password */
define('DB_PASSWORD', 'CtjPRuMXyrg7Ff43');

/** MySQL hostname */
define('DB_HOST', 'sqlserver.inclust.com');

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
define('AUTH_KEY',         '5M,=c2/( 0z_llpO1tHzR>vv>~wxU_@YL}99Gfj14xp9}6|_FNfAX7aL,3M`2)!%');
define('SECURE_AUTH_KEY',  'N#T!u-sbZ;}SlLdLBJUx+/Q-.;E{BIz4X*2O_3(:v1l@# Ut0;LSx{EEcm JYD[T');
define('LOGGED_IN_KEY',    'yqQm?}]ko|U6LYjv2YdDLV(bsdVq5q0tE&sn[6)%4xN+{_G|UO>8:R<KE7iTlSZa');
define('NONCE_KEY',        '.}u%h0YrnIcU<fo0E*Hf!K`j|kw3LWS1#MqK`sU/5;NZ6R%ftHjbXP]:SR8!cWdO');
define('AUTH_SALT',        'FP@;/yrd>:s<6%@*Okw=i^#6jr8$iRo]3SNY4TVsg685&;0=0Sib.b9hXq{N3`aD');
define('SECURE_AUTH_SALT', '=5H+UUX|0>B4/sL++()j[+^MtP+z5+[n9Ft~CtZ9(&!akGV@7/KUH.aP:LJm*W_f');
define('LOGGED_IN_SALT',   '=|1VCL{wLK&dFUk}%S~jR,srSex;[tu]&8!S:VgXzC.FDU;%>i:YkG?qZ*0,%d-/');
define('NONCE_SALT',       'koe[BB.w_pRc<Lj>;C)niB^NQk,? JS9=A&g(~t+OrYH[b8d|f,`$[Bi6tbj}:fk');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_spielplacc';

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
