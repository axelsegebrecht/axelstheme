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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', '192.168.99.100:32769');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '%aLJkUFf+<o?qOst,JM@:K~m._;:sm|9e(ZaY9s-:2d|-Wrbx:M*Ej#64lHj-#mj');
define('SECURE_AUTH_KEY',  ',n{9vL`nsZJ#>SOucCcx~V_1<GYF62wg+P PgD`Ev!0lnw+qM%e97d$ijlkGL)af');
define('LOGGED_IN_KEY',    '-Uwd%3OOhoV{x)P#Wr :WR8>S!MbYv``&}W?Mi!1Up?YtxHca.QG7@k}>-(x?0LC');
define('NONCE_KEY',        ';X+q=xXtbs|4iCI(av7{J(d=]tMk#}6M~-<Ba[b9X0OQW%4!aO;y*21 ?1{Gwzr&');
define('AUTH_SALT',        'z`-6PM9[v4$&n4fb(GM3FZuF=1[Y(*[Z/xT(fB@n-N&Fk]8^g#:v$*:6GSX=aSQ2');
define('SECURE_AUTH_SALT', '[g-e2WiP.:X9_-]fuf!y{|68-3VrO:xq9lc5CJdoVX^@^1)r1GO2+_CS+4j4Socw');
define('LOGGED_IN_SALT',   '1sq3g/,-?XmSA`eaYQ~]h!3?EK+f96gf#m}|i0HU*l $C,TJti;_4E|>:R[|/0aB');
define('NONCE_SALT',       'P<uX:;MR+`-6n^Pe$G`h5Z|?e,t_A9eX|FF~JhLo~5IFo{w{WmqhY2xWvs*L&uzF');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
define( 'WP_DEFAULT_THEME', 'axelstheme' );

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
