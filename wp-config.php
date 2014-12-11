<?php
ini_set('session.save_path', 'tmp');
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

define('DB_NAME', 'fourchillies');



/** MySQL database username */

define('DB_USER', 'fourchillies');



/** MySQL database password */

define('DB_PASSWORD', 'z6Q#PAZwyCV');



/** MySQL hostname */

define('DB_HOST', 'fourchillies.db.10967834.hostedresource.com');



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

define('AUTH_KEY',         's#0h-MUrYv5Ry0j4k%j2');

define('SECURE_AUTH_KEY',  '&rbJ6A4N9VNpK6aSL2B*');

define('LOGGED_IN_KEY',    't rNvBAQg%dF1A%1Qy E');

define('NONCE_KEY',        'H6f2UW7q@HzhxrPW+GcL');

define('AUTH_SALT',        '0vwgH8m d91c$-sk*p&M');

define('SECURE_AUTH_SALT', 't8!Qz-7QX82 gGDbR=CM');

define('LOGGED_IN_SALT',   'B)9SFjsz=w!QMHg$GSYJ');

define('NONCE_SALT',       '0Kt57$)qBcI)_kax+8 c');



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each a unique

 * prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'wp_';



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
 
 

define('WP_DEBUG', false);define('MULTISITE', true);

define('SUBDOMAIN_INSTALL', false);

define('DOMAIN_CURRENT_SITE', 'fourchillies.com');

define('PATH_CURRENT_SITE', '/');

define('SITE_ID_CURRENT_SITE', 1);

define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

