<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/cache.php");
$cache = new cache();
if ( $cache->caching ) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Bảng xếp Hạng Âm Nhạc Tháng <? echo date('m');?> | TGT-music</title>
<meta name="title" content="Bảng xếp Hạng Âm Nhạc | TGT 4.5 " />
<meta name="description" content="Danh sách bài hát hay, nghe nhiều nhất, video hot nhất, được đánh giá cao trong tuần từ các BXH âm nhạc uy tín nổi tiếng châu Á, Âu Mỹ và thế giới: TGT-music Top, MTV, Billboard, Soompi, Channel V" />
<meta name="keywords" content="TGT 4.5,Bang xep hang, bxh, kenh am nhac, viet nam, the gioi, quoc te, tgt-music top, mtv, billboard, soompi, channel v" />
<link rel="image_src" href="http://nhac.topgiaitri.com/images/tgt_mp3.jpg" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_bxh','1006');?></div>
    <div id="contents"  class="contents_bg box" style="padding: 10px 22px 10px 23px;">
		<table width="100%" cellpadding="0" cellspacing="0" class="bxh_tgt_v4_5">
        	<tr>
                <td width="313" valign="top">
                <div class="bxh_title m_vn_"><span>BXH</span> Nhạc Việt Nam <a href="BXH/bai-hat/Viet-Nam.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
					<? echo bang_xep_hang('bxh_vn');?>
                </td>
                <td width="313" valign="top" style="padding: 0px 10px;">
                <div class="bxh_title m_am_"><span>BXH</span> Nhạc Âu Mỹ <a href="BXH/bai-hat/Au-My.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bang_xep_hang('bxh_am');?>
                 </td>
                <td width="313" valign="top">
                <div class="bxh_title m_ca_"><span>BXH</span> Nhạc Hàn Quốc <a href="BXH/bai-hat/Han-Quoc.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bang_xep_hang('bxh_hq');?>
                </td>
            </tr>
        	<tr>
                <td width="313" valign="top">
                <div class="bxh_title v_vn_"><span>BXH</span> Video Việt Nam <a href="BXH/Video/Viet-Nam.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bxh_video('bxh_vn');?>
                </td>
                <td width="313" valign="top" style="padding: 0px 10px;">
                <div class="bxh_title v_am_"><span>BXH</span> Video Âu Mỹ <a href="BXH/Video/Au-My.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bxh_video('bxh_am');?>
                 </td>
                <td width="313" valign="top">
                <div class="bxh_title v_ca_"><span>BXH</span> Video Hàn Quốc <a href="BXH/Video/Han-Quoc.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bxh_video('bxh_hq');?>
                </td>
            </tr>
			<tr>			
                <td width="313" valign="top">
                <div class="bxh_title a_vn_"><span>BXH</span> Album Việt Nam<a href="BXH/Album/Viet-Nam.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bxh_album('bxh_vn');?>
                </td>			
                <td width="313" valign="top" style="padding: 0px 10px;">
                <div class="bxh_title a_am_"><span>BXH</span> Album Âu Mỹ<a href="BXH/Album/Au-My.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bxh_album('bxh_am');?>
                 </td>		 
                <td width="313" valign="top">
                <div class="bxh_title a_ca_"><span>BXH</span> Album Hàn Quốc<a href="BXH/Album/Han-Quoc.html"><img class="right" src="images/chi-tiet.gif" border="0" /></a></div>
                	<? echo bxh_album('bxh_hq');?>
                </td>
            </tr>			
        </table> 
     </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>
<? 
}
$cache->close();
?>