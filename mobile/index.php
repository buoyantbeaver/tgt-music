<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php"); // includes/tgt_music.php
include("../tgt/ajax.php");  // includes/ajax.php
include("../tgt/cache.php");
// tu tao thu muc upload anh album + anh ca si + anh video
			$oldumask = umask(0);
				// album
				@mkdir('upload/', 0777);
				@mkdir('upload/album', 0777);
				@mkdir('upload/album/'.date("Ym"), 0777);
				// singer
				@mkdir('upload/', 0777);
				@mkdir('upload/singer', 0777);
				@mkdir('upload/singer/'.date("Ym"), 0777);
				// video
				@mkdir('upload/', 0777);
				@mkdir('upload/video', 0777);
				@mkdir('upload/video/'.date("Ym"), 0777);
			umask($oldumask); 
// end
if(date("w") == 1) {
	mysql_query("UPDATE tgt_nhac_cf SET cf_up = '1'");
	}
elseif(date("G:i d/m") == '0:00 01/01') {
	mysql_query("UPDATE tgt_nhac_data SET m_viewed_month = 0 ");
}
//$cache = new cache();
//if ( $cache->caching ) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" href="./images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />  
        <link href="css/screen.0.2.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            var NCTInfo = {"ROOT_URL": "<? echo SITE_LINK;?>"};
        </script>
        <script type="text/javascript" src="js/core.0.1.js"></script>
        <script type="text/javascript" src="js/flash_detect.0.1.js"></script>  
        <script type="text/javascript" src="js/exec.0.4.js"></script>		
        <title>Playlist bài hát nhạc việt nam HOT mới, video clip MV hay nhất hiện nay</title>
        <meta content="Truy cập IPOS để nghe các bài hát HOT nhất hiện nay, tận hưởng âm nhạc với hàng triệu bài hát của các ca sỹ, nhạc sỹ trong và ngoài nước." name="description" />
        <meta content="nghe nhạc, âm nhạc, bài hát hot, TGT, nhạc, mp3, tim nhac, tai nhac" name="keywords" /> 
        <meta content="index, follow" name="robots" />

    </head>
    <body>
    <? include("./skin/ip_header.php");?>
    <? include("./skin/ip_album_new.php");?>
    <? include("./skin/ip_video_new.php");?>
    <? include("./skin/ip_new_song.php");?>
<div class="account">
</div>
<!--Footer -->
    <? include("./skin/ip_footer.php");?>
</body>
</html>
