<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");

function clean_feed($input) {
	$original = array("<", ">", "&", '"');
	$replaced = array("&lt;", "&gt;", "&amp;", "&quot;");
	$newinput = str_replace($original, $replaced, $input);
	return $newinput;
}
function htmltxt($document){
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
               '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
);
$text = preg_replace($search, '', $document);
$text = str_replace(", ",",",$text);
return $text;
} 

$rssVersion = 2.0;
$type = $_GET['type'];
$page = (int)$_GET['p'];

// so RSS hien thi
$fullpage	=	1000;

if($page > 0 && $page!= "")
	$start=($page-1) * $fullpage;
else{
	$page = 1;
	$start=0;
}

$rStar = $fullpage * ($page -1 );


header("Content-Type: text/xml; charset=utf-8");
$rss .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
$rss .= "<rss version=\"2.0\">\r\n";
$rss .= "<channel>\r\n";
$rss .= "<title>MP3</title>\r\n";
$rss .= "<link></link>\r\n";
$rss .= "<description>The Gioi Giai Tri Onlne So 1 Viet Nam</description>\r\n";
$rss .= "<language>vi-vn</language>\r\n";
$rss .= "<copyright>Copyright (C) TGT music</copyright>\r\n";
$rss .= "<ttl>60</ttl>\r\n";
$rss .= "<generator>TopGiiTri.COm</generator> \r\n";


if(!$type || $type == 'song')	 {
	$arr = $tgtdb->databasetgt(" m_id, m_title, m_time, m_singer ","data"," m_type = 1 ORDER BY m_id DESC LIMIT ".$rStar .",".$fullpage."");
	for($i=0;$i<count($arr);$i++) {
		$m_time = date('D, d M Y H:i:s',$arr[$i][2]);
		$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$i][3]."'");
		$rss .= "<item>\r\n";
		$rss .= "<title>" . clean_feed($arr[$i][1]) . " - ". clean_feed($singer_name) ."</title>\r\n";
		$rss .= "<description>Bài hát " . clean_feed($arr[$i][1]) ." do ca sĩ ". clean_feed($singer_name) ." trình bày</description>\r\n";
		$rss .= "<link>".url_link($arr[$i][1],$arr[$i][0],'nghe-bai-hat')."</link>\r\n";
		$rss .= "<pubDate>".$m_time." GMT</pubDate>\r\n";
		$rss .= "</item>\r\n\r\n";
	}
}
//
if($type == 'video')	 {
	$arr = $tgtdb->databasetgt(" m_id, m_title, m_time, m_singer ","data"," m_type = 2 ORDER BY m_id DESC LIMIT ".$rStar .",".$fullpage."");
	for($i=0;$i<count($arr);$i++) {
		$m_time = date('D, d M Y H:i:s',$arr[$i][2]);
		$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$i][3]."'");
		$rss .= "<item>\r\n";
		$rss .= "<title>" . clean_feed($arr[$i][1]) . " - ". clean_feed($singer_name) ."</title>\r\n";
		$rss .= "<description>Video " . clean_feed($arr[$i][1]) ." do ca sĩ ". clean_feed($singer_name) ." trình bày</description>\r\n";
		$rss .= "<link>".url_link($arr[$i][1],$arr[$i][0],'xem-video')."</link>\r\n";
		$rss .= "<pubDate>".$m_time." GMT</pubDate>\r\n";
		$rss .= "</item>\r\n\r\n";
	}
}

if($type == 'album')	 {
	$arr = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_info ","album"," album_id != 0 ORDER BY album_id DESC LIMIT ".$rStar .",".$fullpage."");
	
	for($i=0;$i<count($arr);$i++) {
		$m_time = date('D, d M Y H:i:s',time());
		$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$i][2]."'");
		$rss .= "<item>\r\n";
		$rss .= "<title>" . clean_feed($arr[$i][1]) . " - ". clean_feed($singer_name) ."</title>\r\n";
		$rss .= "<description>Nghe album  " . clean_feed($arr[$i][1]) ." do ca sĩ ". clean_feed($singer_name) ." trình bày\n".htmltxt(un_htmlchars(clean_feed($arr[$i][3])))."</description>\r\n";
		$rss .= "<link>".url_link($arr[$i][1],$arr[$i][0],'nghe-album')."</link>\r\n";
		$rss .= "<pubDate>".$m_time." GMT</pubDate>\r\n";
		$rss .= "</item>\r\n\r\n";
	}
}
$rss .= "</channel>\r\n";
$rss .= "</rss>\r\n";

echo $rss;
?>