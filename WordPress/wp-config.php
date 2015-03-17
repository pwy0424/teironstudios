<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jmrzoleg_wp930');

/** MySQL database username */
define('DB_USER', 'jmrzoleg_wp930');

/** MySQL database password */
define('DB_PASSWORD', '(I0)KX2PS9');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '48l06csimrjslcwj8ovflkwsg19rzrk3gt4z7mwvzpx730mdwqkuciyjtwy3e05m');
define('SECURE_AUTH_KEY',  'vsfltxhocfau3y6kitt0jb8dh6j663idlm7yvsbhpyivuuxlxrh75tvxswdsjo8c');
define('LOGGED_IN_KEY',    'qlqcto9n9y7d7q4e34fpj6ztbh9bxpmm6wa8aitxvfh7d91ou0igc2p0iaefouvg');
define('NONCE_KEY',        'h6girgdu6dlosfmtcs56q4iiliuuyt42cdqzclu7mnew9wtvutxz6lhqwxq5vmch');
define('AUTH_SALT',        'hrz85zwdz58aasbyhw2fbcceiwluxj0dqwglgpwcw9jbh6mk2letytt9dtntfmu0');
define('SECURE_AUTH_SALT', 'mhsr9d30wize7m274netnm8glr4bmfttmecy2l4arkllz6sluows9okyanty6ztv');
define('LOGGED_IN_SALT',   'wy4okctr6zptmbujtufwvrpzctcxys5dl0j2rb1ul4pqtuqtm8rqfme5kbrocomt');
define('NONCE_SALT',       'nxhje9tlohswphwcavjrnaizc4y3iameautdpxiqt2d5pxaanbwyjnf4fxvujyt9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'jld_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
