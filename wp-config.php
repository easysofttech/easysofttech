<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'easysoft');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'YfmppNE-h()BAR^vu|sC-M+8M9Xx4D#lg(&ox2F8%H,oVgD3qxIk,4cx-m(Zd@WP');
define('SECURE_AUTH_KEY',  '(H+9ghepm3F{8`Eto>kX+S_6MCCU_d!_nCIh-m%O-^g-1i`Gh-&d*hh&1LE>)kYg');
define('LOGGED_IN_KEY',    'gI?y+N=*{ld[8R=/egY[GUTIbu-9g:X)glaywhB:*elIP s%kk3L+=A4 l{]|xl5');
define('NONCE_KEY',        'tJ;P+ 86*g5qwNfy@u)7q3|A%S|.<dDcg4,LXo+SB+jXR<Jdhsta7ylv3i5v] h%');
define('AUTH_SALT',        ':E(fYYqyv{L=^|(q|q--T+,TOEx!ptrnv@-y=u#B0Lc$6/^JGIzKf?]/%k_+jsG?');
define('SECURE_AUTH_SALT', '+6H7h@}d@,5[<!l-#L.w(-$yb uwKP2ccRDAMr)sAQ43lvhg=PhUIp;gTN0#!$E*');
define('LOGGED_IN_SALT',   'h:0T)fC&-@CtPQb;7{Kp-r-5I7Tu= b_Ls|Bbv;QndbOW8gjV1NHN=FoQRVz7|D(');
define('NONCE_SALT',       'W0&7*5-fJaEeE<7ppbs.`~0--:KTR3zLk,i)1d/b;oCHC7hpwniD)5<c|v9 X/h-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
