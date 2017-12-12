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
define('DB_NAME', 'wordpress1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD','direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=KNo<qK#_W}G_t%0tz]%|SKn2L]_3nWI(M@sv$Y%@@ [OFlcM -Q~/OlCVGfQRe*');
define('SECURE_AUTH_KEY',  '`goi@CIvg[ngS+f1Wk7dZc-/q+5gpCe=<fb>f-|]9il2Kz!hBJn^&Pip@@NwRl;e');
define('LOGGED_IN_KEY',    '4O+3si30K3HDj62]:{>3C|{cv~V$h$S&X5s/LU|VXo=ap=kdt>%8TUh_/cYW$-0I');
define('NONCE_KEY',        'U>sN_m=_>WRZZLbOh-5&OmE==5G|QpQ^a)|3uS=1FM)?},b=% &x>5:f8=:Xm}|e');
define('AUTH_SALT',        'V):#)#HpYY%Ok,||(tsr0--G(6EagS29xY|2b5IX*=f&vL1Is0]Ltz1h=O+v5PCf');
define('SECURE_AUTH_SALT', '~Qk }9a3,+!1+&Br}R_zW|0eOO+r$`Hh8?!-+7}KpD/F_R5>ceX<yq=]Uf{6U-nx');
define('LOGGED_IN_SALT',   'K.Gto_3R-hJyz2hmPs0V>y2zyZLyE~W<+>h3~Kg6RTXOGcCP|%</m9XJ}M?{-@GQ');
define('NONCE_SALT',       'zG$uv0FZEe[cjavy+iRz,)RS!,QK1^`tRl-.!7-#n|W^nQ]< 1~4h95IwL_7)Y2h');

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
define('WP_DEBUG', true);
//define('WP_DEBUG_LOG', true);
//define('WP_DEBUG_DISPLAY', false);
//@ini_set('display_errors', 0);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
