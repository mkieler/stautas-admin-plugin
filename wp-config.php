<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'stautas' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );


/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'uR.HuI$L`tHJ<V>#gE[?6NJY?B>`Zy*SU$*(75.4=&@rh+L}j2WiyBlb*r]M }?q' );
define( 'SECURE_AUTH_KEY',  'EDCGe<u#/`;,(,j`Q-STP&6x-Ptg(Nyv=.6n/I]` {#N7qbSDYejW^V/~Cf{Pm<%' );
define( 'LOGGED_IN_KEY',    '7SD%XJ7|n`C4*pBq%b#Tmi8swi+!;m)U6$qHC,KAYXNE%.TAN1qD{saqUWNyPk:1' );
define( 'NONCE_KEY',        'sam#|RsUVf;za44 mZ8]Op>|=rJ`pd.!^-nlB^2ny*DPgUb(7S-Wp9;,nG[n?yYN' );
define( 'AUTH_SALT',        'Za#luXhf#+w-IOa&%Z0G(]Rq}!lJo}`0=h0[[1t53t5&G.vY5?QzOsPB|btqB@tc' );
define( 'SECURE_AUTH_SALT', '!hmWBRg`X<aCd4pc,|l3sc4{>cL:7p9%j5O@YEa@T%!q2Y?<>lwUsN<(&-9^cQqQ' );
define( 'LOGGED_IN_SALT',   'PYFcOew/Z_#w<g0bP4(x*g[ap9?Ts_+]B)016:!.X_$H+33s;5,]nh8VzmwoYz5/' );
define( 'NONCE_SALT',       'Y<l:top3~c;3,CD+]~a*qCbS[k({.=5]`-;vHV)c*>{2=G)<_(wq_7k2s|MO!W)W' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
