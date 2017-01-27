<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
$array	= $_POST['arrayorder'];
if ($_POST['update'] == "update" && $_POST['id_album']){
	foreach ($array as $key=>$val) {
		$list .= $array[$key].',';
		$playlist = substr($list,0,-1);
		mysql_query("UPDATE tgt_nhac_album SET album_song = '".$playlist."' WHERE album_id = '".$_POST['id_album']."'");
	}
	echo "Loadding....";
}
elseif ($_POST['xSongAlbum']){
	$album_id	=	(int)$_POST['album_id'];
	$remove_id	=	(int)$_POST['remove_id'];
	$arr_old = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$album_id."'");
	
	if($remove_id === $arr_old[0][0]) $str = '';
	else{
		$z = split(',',$arr_old[0][0]);
		if (in_array($remove_id,$z)) {
		unset($z[array_search($remove_id,$z)]);
			$str = implode(',',$z);
		}
	}
	// up du lieu moi
	mysql_query("UPDATE tgt_nhac_album SET album_song = '".$str."' WHERE album_id = '".$album_id."'");
	$arr_new = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$album_id."'");
	$s = explode(',',$arr_new[0][0]);
	foreach($s as $x=>$val) {
		$arr[$x] = $tgtdb->databasetgt(" m_id, m_title, m_singer ","data"," m_id = '".$s[$x]."'");
		$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$x][0][2]."'");
		$stt	=	$x+1;
		echo '<li id="arrayorder_'.$arr[$x][0][0].'"><div class="left">'.$stt.'. '.$arr[$x][0][1].' - '.$singer_name.'</div><div class="right"><a onClick="xSongAlbum('.$album_id.','.$arr[$x][0][0].');" style="cursor: pointer;"><img src="images/media/delete.gif" border="0"></a></div><div class="clr"></div></li>';
	}
}
?>

