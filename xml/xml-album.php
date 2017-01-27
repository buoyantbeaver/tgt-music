<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_album = $myFilter->process($_GET['id']);
					   $id_album = del_id($id_album);

header("Content-Type: application/xml; charset=utf-8");
$xml = '<rss version="2.0" xmlns:jwplayer="http://rss.jwpcdn.com/" >'.
		'<channel>';
$album = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
$album_img		= $arr[$z][3];
$s = explode(',',$album[0][0]);
foreach($s as $x=>$val) {
	$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_img, m_is_local, m_lyricSRT ","data"," m_id = '".$s[$x]."'");
	$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));
	$lyricCaption = str_replace("'", " ", un_htmlchars($arr[$x][0][6]));
	if(strlen($lyricCaption)<5)
		$lyricCaption = SITE_LINK.'xml/LyricCaption.php?id='.$s[$x];
	$song_image   = str_replace("'", " ", un_htmlchars($arr[$x][0][4]));
	if(strlen($song_image)<5)
		$song_image = SITE_LINK.'randomimages.php';
	$video_img		= check_img($arr[$x][0][4]);
	$xml .= '<item>'.
			'<title>'.un_htmlchars($arr[$x][0][2]).'</title>'.
			'<description>'.$singer_name.'</description>'.
			'<jwplayer:source file="'.grab(get_url($arr[$x][0][5],$arr[$x][0][1])).'" type="audio/mpeg" />'.
			'<jwplayer:image>'.$song_image.'</jwplayer:image>'.
			'<jwplayer:track file="'.$lyricCaption.'" label="English" kind="captions" default="true" />'.
			'</item>';
}
$xml .= '</channel>'.
	'</rss>';

echo $xml;
exit();
?>