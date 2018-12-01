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
define('DB_NAME', 'wedoweb_catamp');

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Wr1-z|8E_UVqy|VY*KG*mN&0M:2;M6K;?X>!qqu;V|bs;)1XjK.2Viwb_XE27-^/');
define('SECURE_AUTH_KEY',  'PT1)kZM=MaP;!.ut|0(rusM=|LSm2P(T_omvk^XK+pg4K4hG,P j`Q6B,@M0=ip>');
define('LOGGED_IN_KEY',    'g|D|TYaQkf|;Zh7&:lDL|&(->?=@F0~|uDk_A+=BB uPAs?@v^!u:9dFSYgyy/nc');
define('NONCE_KEY',        '|j-eP6QNXgymlok8r/+e?uN~C}P<cdk}DE;jW|fQDZnx3z|Y}Ba&e72-c&{?}S5L');
define('AUTH_SALT',        'M9F3PIqeFwPk=WWQG`nqfRwV:fj!W19EZ+A d /VF//&.565}.FD/i.vw>W+i+rS');
define('SECURE_AUTH_SALT', '-]&*-|(|g/:?n?O?75S5BnsN/xP^C].-tqV;/!?`:^+*uker=2B{10w#U2GJsfc ');
define('LOGGED_IN_SALT',   'tr!&v[|~-?ozOFlOaXm&*uBLU-}CPY)9WU&h#DCt[;rJg:1Q%*`# E+$sx[I&6;C');
define('NONCE_SALT',       '-]=OQ$^IRO%DXZ/T7|RT%~Nu%*!JsQ>{~gZOq~%b7Yxe4.IC~Ev`.J|.Ah3lWtzG');

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
