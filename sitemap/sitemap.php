<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");

$rssVersion = 2.0;
$type = $_GET['type'];
$page = (int)$_GET['p'];

$fullpage	=	20000;

if($page > 0 && $page!= "")
	$start=($page-1) * $fullpage;
else{
	$page = 1;
	$start=0;
}

$rStar = $fullpage * ($page -1 );

if(!$type || $type == 'song')	 {
$arr = $tgtdb->databasetgt(" m_id, m_title, m_time, m_singer ","data"," m_type = 1 ORDER BY m_id DESC LIMIT ".$rStar .",".$fullpage."");

// tell the browser we want xml output by setting the following header.
header("Content-Type: text/xml; charset=utf-8");
	$m_date = date('Y-m-d');
	$m_time = date('H:i:s');
$rss .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$rss .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
	for($i=0;$i<count($arr);$i++) {
	$rss .= "<url>\r\n";
	$rss .= "<loc>".SITE_LINK."bai-hat/".replace($arr[$i][1])."/".en_id($arr[$i][0]).".html</loc>\r\n";
	$rss .= "<changefreq>daily</changefreq>\r\n";
	$rss .= "<lastmod>".$m_date."T".$m_time."+07:00</lastmod>\r\n";
	$rss .= "</url>\r\n\r\n";
	}
$rss .= "</urlset>\r\n";

echo $rss;
@copy('./sitemap/filesitemap.xml',"./sitemap/song-".$page.'.xml');
$path = './sitemap/song-'.$page.'.xml';
$file=fopen($path, "w");
$write=fwrite($file,$rss);
fclose($file);
}
//
if($type == 'video')	 {
$arr = $tgtdb->databasetgt(" m_id, m_title ","data"," m_type = 2 ORDER BY m_id DESC LIMIT ".$rStar .",".$fullpage."");

// tell the browser we want xml output by setting the following header.
header("Content-Type: text/xml; charset=utf-8");
	$m_date = date('Y-m-d');
	$m_time = date('H:i:s');
$rss .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$rss .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
for($i=0;$i<count($arr);$i++) {
	$rss .= "<url>\r\n";
	$rss .= "<loc>".SITE_LINK."video/".replace($arr[$i][1])."/".en_id($arr[$i][0]).".html</loc>\r\n";
	$rss .= "<changefreq>daily</changefreq>\r\n";
	$rss .= "<lastmod>".$m_date."T".$m_time."+07:00</lastmod>\r\n";
	$rss .= "</url>\r\n\r\n";
}
$rss .= "</urlset>\r\n";

echo $rss;
@copy('./sitemap/filesitemap.xml',"./sitemap/video-".$page.'.xml');
$path = './sitemap/video-'.$page.'.xml';
$file=fopen($path, "w");
$write=fwrite($file,$rss);
fclose($file);
}

if($type == 'album')	 {
$arr = $tgtdb->databasetgt(" album_id, album_name ","album"," album_id != 0 ORDER BY album_id DESC LIMIT ".$rStar .",".$fullpage."");

$rss = "";
// tell the browser we want xml output by setting the following header.
header("Content-Type: text/xml; charset=utf-8");
	$m_date = date('Y-m-d');
	$m_time = date('H:i:s');
$rss .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
$rss .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
for($i=0;$i<count($arr);$i++) {
	$rss .= "<url>\r\n";
	$rss .= "<loc>".SITE_LINK."playlist/".replace($arr[$i][1])."/".en_id($arr[$i][0]).".html</loc>\r\n";
	$rss .= "<changefreq>daily</changefreq>\r\n";
	$rss .= "<lastmod>".$m_date."T".$m_time."+07:00</lastmod>\r\n";
	$rss .= "</url>\r\n\r\n";
}
$rss .= "</urlset>\r\n";

echo $rss;
@copy('./sitemap/filesitemap.xml',"./sitemap/album-".$page.'.xml');
$path = './sitemap/album-'.$page.'.xml';
$file=fopen($path, "w");
$write=fwrite($file,$rss);
fclose($file);
}
?>