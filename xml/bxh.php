<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["name"])) $name = $myFilter->process($_GET['name']);

if($name == 'bxh-nhac-vn') $where = "find_in_set(".IDCATVN.",m_cat) AND m_type = 1";
elseif($name == 'bxh-nhac-am') $where = "find_in_set(".IDCATAM.",m_cat) AND m_type = 1";
elseif($name == 'bxh-nhac-hq') $where = "find_in_set(".IDCATHQ.",m_cat) AND m_type = 1";
elseif($name == 'bxh-video-vn') $where = "find_in_set(".IDCATVN.",m_cat) AND m_type = 2";
elseif($name == 'bxh-video-am') $where = "find_in_set(".IDCATAM.",m_cat) AND m_type = 2";
elseif($name == 'bxh-video-hq') $where = "find_in_set(".IDCATHQ.",m_cat) AND m_type = 2";


$xml = "<playlist>\n".
			"<tracklist>\n";

$arr = $tgtdb->databasetgt("  m_id, m_url, m_title, m_singer, m_is_local  ","data"," $where ORDER BY m_viewed_month DESC LIMIT 40");

for($x=0;$x<count($arr);$x++) {
$singer_name	=	un_htmlchars(get_data("singer","singer_name"," singer_id = '".$arr[$x][3]."'"));
$xml .= "<track>\n".
		"	<title><![CDATA[ ".un_htmlchars($arr[$x][2])." ]]></title>\n".
		"	<videohd><![CDATA[]]></videohd>\n".
		"	<annotation><![CDATA[ ".$singer_name." ]]></annotation>\n".
		"	<location><![CDATA[".grab(get_url($arr[$x][4],$arr[$x][1]))."]]></location>\n".
		"	<duration></duration>\n".
		"	<pid></pid>\n".
		"	<info><![CDATA[ ".SITE_LINK."/bai-hat.html?key=".get_ascii($singer_name)." ]]></info>\n".
		"	<linkannotation><![CDATA[ ".SITE_LINK."/bai-hat.html?key=".get_ascii($singer_name)." ]]></linkannotation>\n".
		"</track>\n";
}
$xml .= "</tracklist>\n".
	"</playlist>";
echo $xml;
exit();
?>