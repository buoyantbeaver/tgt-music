<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');
//xml support jwplayer 6
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_album = $myFilter->process($_GET['id']);
					   $id_album = del_id($id_album);

header("content-type:text/xml;charset=utf-8");
$xml = '<rss version="2.0" xmlns:jwplayer="http://rss.jwpcdn.com/" ><channel>';
$album = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
$album_img		= $arr[$z][3];
$s = explode(',',$album[0][0]);
foreach($s as $x=>$val) {
$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_img, m_is_local ","data"," m_id = '".$s[$x]."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));

	$video_img		= check_img($arr[$x][0][4]);
$xml .= '<item>'.
		'<title>'.un_htmlchars($arr[$x][0][2]).'</title>'.
		'<description>'.$singer_name.'</description>'.
		'<jwplayer:source file="'.grab(get_url($arr[$x][0][4],$arr[$x][0][1])).'" type="video/mp4"/>'.
		'<jwplayer:image>'.$video_img.'</jwplayer:image>'.
		'<jwplayer:track file="'.SITE_LINK.'lyric/'.en_id($arr[$x][0][0]).'.xml" label="English" kind="captions" default="true" />'.
		'</item> ';
}
$xml .= '</channel>'.
		'</rss>';

echo $xml;
exit();
?>