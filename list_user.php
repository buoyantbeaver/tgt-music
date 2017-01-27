<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/functions_user.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Danh sách thành viên - Nghe BXH online, Tải nhạc HAY!</title>
<meta name="title" content="Upload nhạc miễn phí" />
<meta name="keywords" content="Upload nhạc miễn phí" />
<meta name="description" content="Upload,nhạc,miễn,phí,upload nhạc, miễn phí" />
<? include("./theme/ip_java.php");?>
<script type="text/javascript" src="up_v1/swfupload.js"></script>
<script type="text/javascript" src="up_v1/fileprogress.js"></script>
<script type="text/javascript" src="up_v1/handlers.js"></script>
<link rel="stylesheet" href="up_v1/default.css" type="text/css" />

</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents">
    	<div id="m_1">
			<? include("./theme/box/cat_playlist.php");?>
        </div>
    	<div id="m_2">
			<div class="box w_2">
            <h1>Danh sách thành viên</h1>
            <div style="padding:10px;">

			<table width="100%" cellpadding="5" cellspacing="5">
<?
$arr = $tgtdb->databasetgt(" * ","user"," userid ORDER BY userid  DESC LIMIT 12");
for($z=0;$z<count($arr);$z++) {

?>
<a href="Member/Z/user/<? echo $arr[$z][0]; ?>.html" target="_bank" title="<? echo $arr[$z][1]; ?>" class="vtip"><img src="<? echo check_img($arr[$z][7]); ?>" width="60" height="60" /></a>  
        <div class="clr"></div>   
        </div> 
			<? } ?>
</div>
</div>
					
			</table>
			
	</form>
    </div>
    </div>
            
        </div>
        <!--3-->
        <div id="m_3">		
        	<?=BANNER('home_right_1','345');?>
        	<? include("./theme/ip_bxh_mp3.php");?>
            <?=BANNER('home_right_2','345');?>
        	<? include("./theme/ip_bxh_video.php");?>			
        	<? include("./theme/ip_bxh_album.php");?>			
            <? include box_online(); ?>			
			
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