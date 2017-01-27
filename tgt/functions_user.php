<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !");

function acp_cat($id = 0, $add = false) {
	global $link_music,$tgtdb;
	$arr = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = 0 ORDER BY cat_order ASC");
	echo "<select class=\"upload_tgt\" name=\"cat_name\" id=\"cat_name\">";
	for($i=0;$i<count($arr);$i++) {
		echo "<option value=".$arr[$i][0].(($id == $arr[$i][0])?" selected":'').">".$arr[$i][1]."</option>";
		$arrz = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = '".$arr[$i][0]."' ORDER BY cat_order ASC");
		for($z=0;$z<count($arrz);$z++) {
       	 echo "<option value=".$arrz[$z][0].(($id == $arrz[$z][0])?" selected":'').">----".$arrz[$z][1]."</option>";
		}
	} 
	echo "</select>";
}

function them_moi_singer($new_singer,$singer_type) {
	global $link_music,$tgtdb;
	$new_singer =  htmlchars(stripslashes($new_singer));
	$arr = $tgtdb->databasetgt(" singer_id ","singer"," singer_name = '".$new_singer."'");
	if (count($arr)>1) {
		$singer = $arr[0][0];
	}
	else {
		mysql_query("INSERT INTO tgt_nhac_singer (singer_name,singer_name_ascii,singer_type) VALUES ('".$new_singer."','".strtolower(get_ascii($new_singer))."','".$singer_type."')");
		$singer = mysql_insert_id();
	}
	return $singer;
}

function acp_type(&$url) {
	$t_url = strtolower($url);
	$ext = explode('.',$t_url);
	$ext = $ext[count($ext)-1];
	$ext = explode('?',$ext);
	$ext = $ext[0];
	$movie_arr = array(
		'asf',
		'wma',
		'wmv',
		'avi',
		'asf',
		'mpg',
		'mpe',
		'mpeg',
		'asx',
		'm1v',
		'mp2',
		'mpa',
		'ifo',
		'vob',
	);
	$mp3_arr = array(
		'mp3',
	);
	$flv_arr = array(
		'flv',
		'f4v',
		'mp4',
	);
	if (in_array($ext,$movie_arr)) $type = 0;
	elseif (in_array($ext,$mp3_arr)) $type = 1;
	elseif (in_array($ext,$flv_arr)) $type = 2;
	elseif (!$type) $type = 1;

	return $type;
}
?>

