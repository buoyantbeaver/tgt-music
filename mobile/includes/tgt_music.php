<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler');
else ob_start();
@session_start();
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if (!ini_get('register_globals')) {
	$superglobals = array($_SERVER, $_ENV, $_FILES, $_COOKIE, $_POST, $_GET);
	if (isset($_SESSION)) {
		array_unshift($superglobals, $_SESSION);
	}
	foreach ($superglobals as $superglobal) {
		extract($superglobal, EXTR_SKIP);
	}
	ini_set('register_globals', true);
}
// cau hinh ket noi den csdl
define('SERVER_HOST',			'localhost');
define('DATABASE_NAME',			'tgtmobile');
define('DATABASE_USER',			'root');
define('DATABASE_PASS',			'');
if (!$_SERVER['HTTP_USER_AGENT'] || !$_SERVER['REMOTE_ADDR']) exit();
include("mysql.php");
$tgtdb = new dbmysql;
// cau hinh website
define('PATH', 			$_SERVER["DOCUMENT_ROOT"] .'/playlist/cache/'); // Thư mục cache
define('FOLDER_ALBUM', 	$_SERVER["DOCUMENT_ROOT"] .'/playlist/upload/album/' . date("Ym"));
define('LINK_ALBUM', 	'upload/album/' . date("Ym"));
define('FOLDER_SINGER',	$_SERVER["DOCUMENT_ROOT"] .'/playlist/upload/singer/' . date("Ym"));
define('LINK_SINGER', 	'upload/singer/' . date("Ym"));
define('FOLDER_VIDEO',	$_SERVER["DOCUMENT_ROOT"] .'/playlist/upload/video/' . date("Ym"));
define('LINK_VIDEO', 	'upload/video/' . date("Ym"));
define("ADV_FOLDER_ABSOLUTE",		$_SERVER["DOCUMENT_ROOT"] . '/playlist/upload/adv');	// UPLOAD BANNER
define("ADV_FOLDER",				'upload/adv');
define('NOW',			time());
define('IP',			$_SERVER['REMOTE_ADDR']);
define('VER',			'TGT-music v4.5 Mobile');
define('NAMEWEB',		'IPOS');

define('SITE_LINK',		getConfig('domain'));
define('WEB_NAME',		getConfig('web_name'));
define('WEB_KEY',		getConfig('web_key'));

define('HOME_PER_PAGE', 22);
define('LIMITSONG', 	440);
define('IDCATVN', 		getConfig('cat_vn'));
define('IDCATAM', 		getConfig('cat_am'));
define('IDCATHQ', 		getConfig('cat_hq'));
define('PASS2ADMIN',	getConfig('passii'));
define('SERVER',		getConfig('upload'));
define('NUMPLAY',		getConfig('play'));

require("box.php");
?>