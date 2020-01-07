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
define( 'DB_NAME', 'wordpressnew' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'N:v~^ogr-MEGc+[e8(tXA5 k^rXP0CRQpmO9b&!Qdoe:Waw2A%iSHXB*a)o)L.cT' );
define( 'SECURE_AUTH_KEY',  '-ah)70h?n*$bdO{(_(pL@,Vsi}&5DWPb!$RA!o$9XUTZ_:B6!{L6 X`Q>vZ51PzY' );
define( 'LOGGED_IN_KEY',    '2 fA?ftcKJ%mvDNwt#hc2+?g[}9iu}R!J&dwN)KRAr7n)=MKZ>g%nmT[Oa!`fr)L' );
define( 'NONCE_KEY',        'I0B}!{<+jFR^7t`90Fm}qA_Zm<J(`Lp7(Pw[*Es~N]Dm?5.2r!$Az5lnppThS$J6' );
define( 'AUTH_SALT',        'geZ0},LO/t+bm1q2cN^*_*c`6|:8KD~jV-v:s$OL~Hz~&(,_gx[S[;Ua7m6JD:cb' );
define( 'SECURE_AUTH_SALT', 'SKa:Z~]{bgN8A{`rj5JSa&Zcz354A9QQ?wM?]OyXiCEfRMf3Wlr^|j:VR~_ pB/A' );
define( 'LOGGED_IN_SALT',   'r]xu6oD*|Hj![E@9V;Y| ebV#1q-9}hT4bD asC-xomA1353|Og?C>5ord/Hs,n ' );
define( 'NONCE_SALT',       '_X*]$klUuE!QO3$+.yCgT;i8N?uu;2JdSu!VMtMYQfov!^|kxn| ~?:TbXR_9YC?' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
