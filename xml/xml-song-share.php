<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); $id = del_id($id);


$xml = "<data>\n";
$arr = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local ","data"," m_id = '".$id."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'"));
$xml .= "<item type=\"mp3\">\n".
		"	<title><![CDATA[ ".str_replace("'", " ", un_htmlchars($arr[0][2]))." ]]></title>\n".
		"	<singer><![CDATA[ ".$singer_name." ]]></singer>\n".
		"	<source>".grab(get_url($arr[0][4],$arr[0][1]))."</source>\n".
		"	</item>\n";
		"	<ad></ad>\n";
$xml .= "</data>";
echo $xml;
exit();
?>