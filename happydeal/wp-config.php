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
define('DB_NAME', 'happydeals_db');

/** MySQL database username */
define('DB_USER', 'ezelteq');

/** MySQL database password */
define('DB_PASSWORD', 'si3ru90Cs5bWED9U');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/*define('WP_ALLOW_REPAIR', true);  */

define('WP_HOME','http://dev.happydeals.ph');
define('WP_SITEURL','http://dev.happydeals.ph');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')R1@]{3;j ;DNjpa;+#_OyHr4`9Pl#P!omh*E.YzxV!a}i-s%&_3kd]CaA=M, )w');
define('SECURE_AUTH_KEY',  '.{!2cw$?aBoQ:]w]WN4><@#aLR5KqncA)}YU>5o>e#+w.x }P)8i%p!hu&Lt0|z_');
define('LOGGED_IN_KEY',    '23!xY1^4m!AQwaecvh<)UOEHlEhjD!n/)zP?a<+xmLmp=%7wm$~M<N8a:nrPD5=|');
define('NONCE_KEY',        'FIii`X9}fXbhS0~T&bRGFCFcsBfZN+zVfHZ{}!xY=%*^*-Dw=>Q_+~j0W#7[93IQ');
define('AUTH_SALT',        '(:n<:/!6CdI<I,q>lx~WIVp#7s9VtAiXM%t=I,j8ouf+bL@Bq]M9Vv77./1Cz={L');
define('SECURE_AUTH_SALT', 'eVYh4;fE`^QZw6/(:5axgAGwGE&$Y[0Thq*JQEyk,Km.H{E6:Jsaw>tr|+^X~/K~');
define('LOGGED_IN_SALT',   'CA%N~c)#u+`?xJ1DstDU@M7d n6jwI|cFcDyV1FS=CE1|w9)cW}e%$qe:Tt)yV J');
define('NONCE_SALT',       'Q[Ch&hcsL/{ap%5Tx)jh^-Owy|hZ/CT@?ve.Odyr!PKP)<Z|o#5/`L|TnTv `U|O');

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
