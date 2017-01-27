<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_album = $myFilter->process($_GET['id']);
					   $id_album = del_id($id_album);

//header("Content-Type: application/xml; charset=utf-8");
$xml = 'var ap5 = new APlayer({'.
		'element: document.getElementById("player5"),'.
		'narrow: false, '.
		'autoplay: true, '.
		'showlrc: 3, '.
		'mutex: true, '.
		'theme: "#ad7a86", '.
		'mode: "circulation", '.
		'preload: "none", '.
		'listmaxheight: "513px", '.
		'music: [';
$album = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
$album_img		= $arr[$z][3];
$s = explode(',',$album[0][0]);
foreach($s as $x=>$val) {
	$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_img, m_is_local, m_lyricSRT, m_lyricLRC ","data"," m_id = '".$s[$x]."'");
	$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));
	$lyricLRC = str_replace("'", " ", un_htmlchars($arr[$x][0][7]));
	$song_image   = str_replace("'", " ", un_htmlchars($arr[$x][0][4]));
	if(strlen($song_image)<5)
		$song_image = SITE_LINK.'randomimages.php';
	$video_img		= check_img($arr[$x][0][4]);
	$xml .= '{'.
			'title: "'.un_htmlchars($arr[$x][0][2]).'",'.
			'author: "'.$singer_name.'",'.
			'url: "'.grab(get_url($arr[$x][0][5],$arr[$x][0][1])).'",'.
			'pic: "'.$song_image.'",'.
			'lrc: "'.$lyricLRC.'"'.
			'},';
}
//cat dau , cuoi cung
$xml = substr($xml,0,-1);
$xml .= ']});';
//$xml = substr($xml,0,-1);
echo $xml;
exit();
?>