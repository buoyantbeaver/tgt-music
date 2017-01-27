<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_album = $myFilter->process($_GET['id']);
					   $id_album = del_id($id_album);

$xml = "<data>\n";
$album = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
$s = explode(',',$album[0][0]);
foreach($s as $x=>$val) {
$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local ","data"," m_id = '".$s[$x]."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));
$xml .= "<item type=\"mp3\">\n".
		"	<title><![CDATA[ ".un_htmlchars($arr[$x][0][2])." ]]></title>\n".
		"	<singer><![CDATA[ ".$singer_name." ]]></singer>\n".
		"	<source>".grab(get_url($arr[$x][0][4],$arr[$x][0][1]))."</source>\n".
		"</item>\n";
}
$xml .= "<ad></ad>\n".
		"</data>";

echo $xml;
exit();
?>