<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$key = htmlchars(strtolower(get_ascii(urldecode($q))));

$arr_singer = $tgtdb->databasetgt(" singer_name_ascii ","singer"," singer_name_ascii LIKE '".$key."%' ORDER BY singer_id DESC LIMIT 5");

for($i=0;$i<count($arr_singer);$i++) {
	$singername = un_htmlchars($arr_singer[$i][0]);
	echo "$singername\n";
}
if(!$arr_singer)	$limit	= 10;
else				$limit	= 5;
$arr_song = $tgtdb->databasetgt(" m_title_ascii ","data"," m_title_ascii LIKE '".$key."%' ORDER BY m_id DESC LIMIT ".$limit);

for($i=0;$i<count($arr_song);$i++) {
	$songname = un_htmlchars(urldecode($arr_song[$i][0]));
	echo "$songname\n";
}
?>