<?php
# Database Configuration
define( 'WPCACHEHOME', '/nas/wp/www/cluster-41366/orbheadphones/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define( 'DB_NAME', 'wp_audio46v3' );
define( 'DB_USER', 'audio46v3' );
define( 'DB_PASSWORD', 'Pgew3oYvwbg0ndCyhXjp' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', 'utf8_unicode_ci' );
$table_prefix = 'wp_';



# Security Salts, Keys, Etc
define('AUTH_KEY', 'y^F/K$o/,Z}V?XG+QGrt6$.?^>}aga0L`b#/*jbKLikyiX^)sW|glwNr|Kt0`BW|');
define('SECURE_AUTH_KEY', '{_S-Sj/#?(_|xLch82@-+d}&~~+)Gy|P&w9Vk%@kVTMBfs`#M2o3-Y0eJ&OE]I]_');
define('LOGGED_IN_KEY', 'kO,#4>n#B*Qan&04pE+dY9?+O*QGw-}~v45+ cxWUK9-&xWw9RZH{/?pEan4BaA=');
define('NONCE_KEY', 'Q A=X+yII z*8*:]3r|g[<TSvy:A-cDAI|LXYth{U/{)9n5]&j;cL^p|tRj<0_-7');
define( 'AUTH_SALT', ';-5=$GlbU8pzZVaN^/B7 lp|^LVuv j]5pU"T=}/p5Fc-,.D7v/F(_9_],2$}NFV' );
define( 'SECURE_AUTH_SALT', ';:SiA=D8,}i+|UZVv.lL ]N(*HDf*0WLpL!Mu^ayz4SMT!Qw.%UK~k*F$/l%bp"t' );
define( 'LOGGED_IN_SALT', 'x$;h)eUQFCE<^DJlRscPiO>%,7~%ca*?v9Dk:UPxQEhN"-?B.WOasySn~: -=9cF' );
define( 'NONCE_SALT', '[zE.-KYIU;bn;bfk9b/".!hMrX7y*E{~ _2mH900M~B3}CVn!{lRJ*+PhS9-|/N,' );



# Localized Language Stuff


define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'audio46v3' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '15c777aa95affb95b290365ccddafca22a2de6a0' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '100417' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_EDIT', TRUE );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'majorhifi.com', 1 => 'audio46v3.wpengine.com', 2 => 'www.majorhifi.com', );

$wpe_varnish_servers=array ( 0 => 'pod-100417', );

$wpe_special_ips=array ( 0 => '104.196.170.78', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( 0 =>  array ( 'zone' => '2pkv5041fpt42yueav2hquv1', 'match' => 'gamercans.com', 'secure' => true, 'dns_check' => '0', ), );

$wpe_netdna_domains_secure=array ( 0 =>  array ( 'zone' => '2pkv5041fpt42yueav2hquv1', 'match' => 'gamercans.com', 'secure' => true, 'dns_check' => '0', ), );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );



define( 'WP_CACHE', TRUE );
define( 'WPLANG', '' );



# WP Engine Settings





define( 'WPE_CACHE_TYPE', 'generational' );






define( 'WPE_GOVERNOR', FALSE );





















/*SSLSTART*/
if ( isset( $_SERVER['HTTP_X_WPE_SSL'] ) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on';
/*SSLEND*/



# Custom Settings











define( 'WP_DEBUG', false );
define( 'WP_MEMORY_LIMIT', '512M' );
$_wpe_preamble_path = null;



# That's It. Pencils down
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}
require_once( ABSPATH . 'wp-settings.php' );