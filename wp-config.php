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
define('DB_NAME', 'u312518386_goalklub');

/** MySQL database username */
define('DB_USER', 'u312518386_goalklub');

/** MySQL database password */
define('DB_PASSWORD', 'Ah2o@[dDzTG=');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '}2)yo^Shc_{A,FE_-nCpVnkHTq[7L9a,Y3OXHsBIO=~L%}mtc]WL_s<jZ3/Ru~8Q');
define('SECURE_AUTH_KEY',  'w)D7`*a@>YX7Y6|c=kS7x)x}N]ggsrmG(H~+rf6h^WRH-?`5.0VjXKo7fa{bFK92');
define('LOGGED_IN_KEY',    '3#[DfOk<u|GurVME|@^Omwn+3}c8&$GTs-T9pzq{- HItek}OQT)l+nKV/Q9(+hy');
define('NONCE_KEY',        'FaA.q2hY||uA+`E#-ShQOh-mMdgpZSPcbPV8ioaKN@y_Fl//RSBd^J2a<C5DQkrz');
define('AUTH_SALT',        'Dbh/.-#}N>(#gw{knUG;f.%qbpo|<t?v]]lkRV|!DlJrLPGwDF?I/>e/)z9_%*wQ');
define('SECURE_AUTH_SALT', 'xHy!+MnSB#gk8F-r;kqwZRd|EbdU0~5r7_+tJd:T3|3qsl-MXY`7dbA`p$-xCfu8');
define('LOGGED_IN_SALT',   '|O{3IHj(TEu!}fNk@ksXrVtg)4Te,.m(j<lQzgB=({i{AkM|mvwgnK]gpZ75-Wzq');
define('NONCE_SALT',       '-|2QIUfP+&fx^T:4fN+M}<(<{ *lUl.9vM=c/`d:8Pt{5WuAE +-m[ljZMZ:+WZ$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'goalklub_';

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
