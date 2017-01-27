<?php
define('TGT-MUSIC',true);
include('./tgt/tgt_music.php');
include('./tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); $id = del_id($id);

$arr = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local, m_sang_tac ","data"," m_id = '".$id."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'"));
$xml .= "1\n";
$xml .= "00:00:00,000 --> 00:00:20,000\n";
$xml .= "<font color=\"#FFFF00\">Tác phẩm: ".un_htmlchars($arr[0][2])."</font>\n";
$xml .= "Trình Bày: ".$singer_name."\n";
$xml .= "\n";
$xml .= "2\n";
$xml .= "00:01:00,000 --> 00:01:20,000\n";
$xml .= "<font color=\"#FFFF00\">Bạn đang thưởng thức tác phẩm ".un_htmlchars($arr[0][2]).".</font>\n";
$xml .= "Do ca sĩ ".$singer_name." thể hiện.\n";
$xml .= "\n";
$xml .= "3\n";
$xml .= "00:03:00,000 --> 00:03:20,000\n";
$xml .= "<font color=\"#FFFF00\">Hãy ghé thăm website thường xuyên để được thưởng thức những tác phẩm hot nhé.</font>\n";
$xml .= "KeoMut.Biz Chúc các bạn 1 ngày zui vẻ !\n";
$xml .= "\n";
$xml .= "4\n";
$xml .= "00:05:00,000 --> 00:05:20,000\n";
$xml .= "<font color=\"#FFFF00\">Bạn đang thưởng thức tác phẩm ".un_htmlchars($arr[0][2]).".</font>\n";
$xml .= "Do ca sĩ ".$singer_name." thể hiện.\n";
$xml .= "\n";
$xml .= "5\n";
$xml .= "00:07:00,000 --> 00:07:20,000\n";
$xml .= "<font color=\"#FFFF00\">Hãy ghé thăm website thường xuyên để được thưởng thức những tác phẩm hot nhé.</font>\n";
$xml .= "KeoMut.Biz Chúc các bạn 1 ngày zui vẻ !\n";
$xml .= "\n";
$xml .= "6\n";
$xml .= "00:09:00,000 --> 00:9:20,000\n";
$xml .= "<font color=\"#FFFF00\">Bạn đang thưởng thức tác phẩm ".un_htmlchars($arr[0][2]).".</font>\n";
$xml .= "Do ca sĩ ".$singer_name." thể hiện.\n";
$xml .= "\n";
$xml .= "7\n";
$xml .= "00:11:00,000 --> 00:11:20,000\n";
$xml .= "<font color=\"#FFFF00\">Hãy ghé thăm website thường xuyên để được thưởng thức những tác phẩm hot nhé.</font>\n";
$xml .= "KeoMut.Biz Chúc các bạn 1 ngày zui vẻ !\n";
$xml .= "\n";
$xml .= "8\n";
$xml .= "00:13:00,000 --> 00:13:20,000\n";
$xml .= "<font color=\"#FFFF00\">Bạn đang thưởng thức tác phẩm ".un_htmlchars($arr[0][2]).".</font>\n";
$xml .= "Do ca sĩ ".$singer_name." thể hiện.\n";
$xml .= "\n";
$xml .= "9\n";
$xml .= "00:15:00,000 --> 00:15:20,000\n";
$xml .= "<font color=\"#FFFF00\">Hãy ghé thăm website thường xuyên để được thưởng thức những tác phẩm hot nhé.</font>\n";
$xml .= "KeoMut.Biz Chúc các bạn 1 ngày zui vẻ !\n";
$xml .= "\n";
$xml .= "10\n";
$xml .= "00:17:00,000 --> 00:17:20,000\n";
$xml .= "<font color=\"#FFFF00\">Bạn đang thưởng thức tác phẩm ".un_htmlchars($arr[0][2]).".</font>\n";
$xml .= "Do ca sĩ ".$singer_name." thể hiện.\n";
$xml .= "\n";
$xml .= "11\n";
$xml .= "00:19:00,000 --> 00:19:20,000\n";
$xml .= "<font color=\"#FFFF00\">Hãy ghé thăm website thường xuyên để được thưởng thức những tác phẩm hot nhé.</font>\n";
$xml .= "KeoMut.Biz Chúc các bạn 1 ngày zui vẻ !\n";
$xml .= "\n";
$xml .= "12\n";
$xml .= "00:23:00,000 --> 00:23:20,000\n";
$xml .= "<font color=\"#FFFF00\">Bạn đang thưởng thức tác phẩm ".un_htmlchars($arr[0][2]).".</font>\n";
$xml .= "Do ca sĩ ".$singer_name." thể hiện.\n";
$xml .= "\n";
$xml .= "13\n";
$xml .= "00:23:00,000 --> 00:23:20,000\n";
$xml .= "<font color=\"#FFFF00\">Hãy ghé thăm website thường xuyên để được thưởng thức những tác phẩm hot nhé.</font>\n";
$xml .= "KeoMut.Biz Chúc các bạn 1 ngày zui vẻ !\n";




echo $xml;
exit();
?>