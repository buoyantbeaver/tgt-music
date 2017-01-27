<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); $id = del_id($id);

header("Content-Type: application/xml; charset=utf-8");

$xml = '<rss version="2.0" xmlns:jwplayer="http://rss.jwpcdn.com/" >'.
	'<channel>';
$arr = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local, m_lyric, m_img, m_lyricSRT ","data"," m_id = '".$id."'");

$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'"));
$lyricCaption = str_replace("'", " ", un_htmlchars($arr[0][7]));
$song_image   = str_replace("'", " ", un_htmlchars($arr[0][6]));
if(strlen($lyricCaption)<5)
	$lyricCaption = SITE_LINK.'xml/LyricCaption.php?id='.$id;
if(strlen($song_image)<5)
	$song_image = SITE_LINK.'randomimages.php';
$xml .= '<item>'.
		'<title>'.str_replace("'", " ", un_htmlchars($arr[0][2])).'</title>'.
		'<description>'.$singer_name.'</description>'.
		'<jwplayer:source file="'.grab(get_url($arr[0][4],$arr[0][1])).'" type="video/mp4"/>'.
		'<jwplayer:image>'.$song_image.'</jwplayer:image>'.
		//'<jwplayer:captions.file>'.check_lyric($arr[0][5],$id).'</jwplayer:captions.file>'.
		'<jwplayer:track file="'.$lyricCaption.'" label="English" kind="captions" default="true" />'.
		'</item>';
$xml .= '</channel>'.
	'</rss>';
echo $xml;
exit();
?>