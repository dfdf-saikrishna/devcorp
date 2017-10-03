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
define('DB_NAME', 'corptne');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'santosh@15790...');

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
define('AUTH_KEY',         '7*[xyA93H2C!fL*&1#0|(+2QJww(Vu`Z6-@RdSdWr $b7l+Lt_TR>F/6 hG>+=Zf');
define('SECURE_AUTH_KEY',  'iB)=i`Dl{sH~_6=dY?xw7H[$3U.B%ndGPQnf?v5VZfwj8bu.m^qntMe(c/2}E,yW');
define('LOGGED_IN_KEY',    'ujkRq9OrLU#<{Hvv]e7f_.X,muO#0pmK~e*/b4Msv&,YhDM%o@`AB0#>/o@AbT, ');
define('NONCE_KEY',        '-e!<u)FJRu.s502hHHc/Y:$_c$BA9=BBC;lcJ6 j7rztrfOqjz,K!%9Nl#C@j0PZ');
define('AUTH_SALT',        'nQg#f]9/97O>M Z)-trqW{z{)x<tWWFBj2cSNc(*Zo/zZy/ :>qq~/d$E_SJoV-K');
define('SECURE_AUTH_SALT', '@w=xMmKl:rNsU=fZF4B:RQ[{^w3e?MG5)B}g/:bRqe?`qu]IKO?7oTUI^=oBO!Go');
define('LOGGED_IN_SALT',   '#$Xf}4}%b)q3R@Vo]kaM-B9r]ePU:?N?BT:tulr/PThqq?(jDl@kCz~0Mp/R(o{/');
define('NONCE_SALT',       '{<u(}V7xRojkeB_Y7(2*5.+|#<fNR[1nESVw|UPDpT7UJ]YTH>L+;k1u[C%|b%c0');

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

/** For SSL **/
define('FORCE_SSL_ADMIN', true);
