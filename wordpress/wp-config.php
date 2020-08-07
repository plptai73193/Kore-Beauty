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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'korea' );

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
define( 'AUTH_KEY',         'a%$]CI.N%p)#X[:FN)YOhMizv+I#2)/,;M]n[)>&18bms)mO*3qfc;ls(36%n$>{' );
define( 'SECURE_AUTH_KEY',  '3N$G~<9X{B%%Fu6(g>-SI^+>k<V1}oCB8^?c(osON^J}uf{,K*?Kj/a$ [*Zi?|:' );
define( 'LOGGED_IN_KEY',    '3/rBPOAiL0z/:-{S{qmhz0OaTP?}.7]NUs[n!jXs?NIj5JoxQ(Vf2ifA5m X,)ap' );
define( 'NONCE_KEY',        '&$3~fJf(m4(05O0n`?_5%^r^bG P+AG9C SJmm*xT=d|CW$dJRamsMs]j;c$fZ(/' );
define( 'AUTH_SALT',        'jP*/Bm5&/Wc`*VRd8>itIqGhn|/Ztr ,;Z2QG #Q7?7+L-A?pFQNKjl)VP/V`J7Q' );
define( 'SECURE_AUTH_SALT', 'H[x#gIXFV[18`jz}tF)cs(`qP{bk%:8Jf6^LK^VDL>~{TG/_xsjhOVhNv$4_[IVE' );
define( 'LOGGED_IN_SALT',   'exQWnr-HqK2EnA`a:<ZA!T1d}f7=TCy6_ -xujMVLS6mbn#/)Di`(p|keYI9rK8S' );
define( 'NONCE_SALT',       'Vl#jCd3=cBSwI4SU-LdDLO,ENAzvxq%Qk~2^!vr<6(S`f[e>me,J4cMbO9;oCm?`' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
