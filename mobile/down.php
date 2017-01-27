<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
include("../tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']);
if(isset($_GET["key"])) $key = $myFilter->process($_GET['key']);

if ($id && $key == md5($id.'tgt_music')) {
	$arr = $tgtdb->databasetgt(" m_url, m_is_local ","data"," m_id = '".$id."'");
	mysql_query("UPDATE tgt_nhac_data SET m_downloaded = m_downloaded + 1, m_downloaded_month = m_downloaded_month + 1 WHERE m_id = '".$id."'");
	$url = grab(get_url($arr[0][1],$arr[0][0]));
	header("Location: ".$url);
}
?>