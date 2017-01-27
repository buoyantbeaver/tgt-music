<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/cache.php");
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=WEB_NAME;?></title>
<meta name="title" content="<?=WEB_NAME;?>" />
<meta name="description" content="<?=WEB_DESC;?>" />
<meta name="keywords" content="<?=WEB_KEY;?>" />
<? include("./theme/ip_java.php");?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?=GOOGLE_A;?>', 'auto');
  ga('send', 'pageview');

</script>
<script type='text/javascript' src='script/jquery-slide.js'></script>
		<script>
			$(document).ready(function() {
				 $('.content-slide').myelinSlider({
					 auto : true,
					 type : 'content',
					 speed : 4000
				 });
				 
				 $('.slide-show').myelinSlider({
					 auto : true,
					 type : 'slideshow',
					 speed : 2000
				 });
			});
			
		</script>
</head>

<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_home','1006');?></div>
    <div id="contents">
        <!--1
    	<div id="m_1">
		
			<? include("./theme/ip_chu_de.php");?>
            <?=BANNER('home_left','140');?>
            <? include("./theme/ip_singer_hot.php");?>
        </div>-->
        <!--2-->
        <div id="m_2">
			<? include("./theme/ip_album_hot_slide.php");?>
        	<? include("./theme/ip_album_new.php");?>
            <?=BANNER('home_center_1','485');?>
        	<? include("./theme/ip_video_new.php");?>
        	<? include("./theme/ip_top_singer.php");?>
            <?=BANNER('home_center_2','485');?>
               <? include("./theme/ip_new_song.php");?>
        </div>
        <!--3-->
        <div id="m_3">
        	<?=BANNER('home_right_1','345');?>
			<? include("./theme/ip_chu_de.php");?>
        	<? include("./theme/dn_facebook_like_box.php");?>
        	<? include("./theme/ip_bxh_mp3.php");?>
            <?=BANNER('home_right_2','345');?>
        	        <? include("./theme/ip_bxh_video.php");?>
			<? include("./theme/ip_bxh_album.php");?>					
	
        </div>
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