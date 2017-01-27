<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/class.inputfilter.php");
include("./tgt/cache.php");
$myFilter = new InputFilter();
//$cache = new cache();
//if ( $cache->caching ) {
if(isset($_GET["act"])) $act = $myFilter->process($_GET['act']);
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}
if($act	== 'Viet-Nam') $title_web = 'Album Việt Nam';
elseif($act	== 'Au-My') $title_web = 'Album Âu Mỹ';
elseif($act	== 'Chau-A') $title_web = 'Album Châu Á';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title><? echo $title_web;?> Playlist | Trang <? echo $page;?></title>
<meta name="title" content="<? echo $title_web;?> | bài hát | Trang <? echo $page;?>" />
<meta name="keywords" content="Thể loại, <? echo $title_web;?>, playlist, album" />
<meta name="description" content="Thể loại <? echo $title_web;?>  playlist, album" />
<link rel="image_src" href="http://nhac.topgiaitri.com/vn/img_album/tgt_mp3.jpg" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents">
    	<div id="m_1">
			<? include("./theme/box/cat_playlist.php");?>
        </div>
        <!--2-->
        <div id="m_2">
					<?php
                    $link = '/playlist.php?';
                    if($_SERVER["QUERY_STRING"]) $link .= $_SERVER["QUERY_STRING"];
                    switch($act){
                        default					:include("./playlist/playlist_user.php");break;
                        case "Viet-Nam"			:include("./playlist/playlist_user.php");break;

                    }
                    ?>
        </div>
        <!--3
        <div id="m_3">
        	<?=BANNER('the_loai','345');?>
        <div id="m_3">		
        	<?=BANNER('home_right_1','345');?>
        	<? include("./theme/ip_bxh_mp3.php");?>
            <?=BANNER('home_right_2','345');?>
        	<? include("./theme/ip_bxh_video.php");?>		
			
        </div>
        <div class="clr"></div>			
        </div>-->
        <div class="clr"></div>
    </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>
<?
//}
//$cache->close();
?>