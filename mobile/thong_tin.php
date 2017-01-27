<?php
#####################################
#		IPOS V1.0 (TGT 4.5)	Mobile	#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#	edit code: tuannvbg@gmail.com	#
#####################################
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
include("../tgt/cache.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
<link rel="icon" type="image/png" href="images/favicon.ico" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link href="css/screen.0.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	var NCTInfo = {"ROOT_URL": "<? echo SITE_LINK ?>mobile/"};
</script>
<script type="text/javascript" src="js/core.0.2.js"></script>
<script type="text/javascript" src="js/flash_detect.0.1.js"></script>  
<script type="text/javascript" src="js/exec.0.4.js"></script>
<title>Danh Mục - Nghe nhạc hay online mới nhất, tải nhạc MP3 chất lượng cao 320kbs</title>
<meta content="Nghe nhạc mp3 MỚI NHẤT, tải nhạc mp 320kbs miễn phí kho bài hát album video clip nhạc trẻ nhạc phim nhạc trữ tình HAY NHẤT cập nhật nhanh nhất." name="description" />
<meta content="nhac, mp3, nhac tre, nhac thieu nhi, nhac tru tinh, nhac vui, nhac san rexmi, nhac xuan, nhac hay, nhac che, nhac chuong, nhac dj." name="keywords" /> 
<meta content="noodp, noydir" name="robots" />
<meta property="og:image" content="images/logo_600x600.png"/>
<link rel="image_src" href="images/logo_600x600.png" />
<link rel="canonical" href="<? echo SITE_LINK ?>mobile/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>mobile/" />
<title>Danh Mục</title>
<script>var mainURL = "<? echo SITE_LINK ?>mobile/";</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39362869-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
    <body>
        <!--Header -->
        <div class="header">
            <h1 class="logo">
            <a href="<? echo SITE_LINK ?>mobile/" title="IPOS 1.0 Mobile"><img src="images/logo.gif" alt="IPOS 1.0 Mobile" width="68" height="37" border="0" /></a>
            </h1>
            <span><a href="<? echo SITE_LINK ?>mobile/tim-kiem" title="Tìm kiếm"><img alt="Tìm kiếm" src="images/search.png" width="43" height="37" border="0" /></a></span>
            <span><a href="<? echo SITE_LINK ?>mobile/danh_muc" title="Danh mục"><img alt="Danh mục" src="images/list.png" width="43" height="37" border="0" /></a></span>                      
            <span><a href="<? echo SITE_LINK ?>mobile/login" title="Đăng nhập"><img alt="Đăng nhập" src="images/user.png" width="43" height="37" border="0" /></a></span>
        </div>
        <!--Top Menu -->
        <div class="topmenu"> 
            <a href="<? echo SITE_LINK ?>mobile" class="home ac" class="active" title="IPOS 1.0 Mobile"></a>
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html" title="Bài hát">Bài hát</a> 
            <a href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html"  title="Playlist">Playlist</a>  
            <a href="the-loai-video/Nhac-Tre/EZEFZOB.html"  title="MV">MV</a>            
        </div>
        <!--Search -->        
        <div class="search" id="search">
            <div class="bgsearch">
                <div class="pd-input">
                    <input type="text" value="" class="input-search" onkeypress="return searchKeyPress(event);" id="txtSearchkey" name="txtSearchkey"/>
                    <input type="button" class="btn-search" onclick="search();
                return false;" id="btnSearch"/>
                </div>
            </div>
        </div>
		<!--END Search -->
<p class="title-login">Thông tin</p>
<div class="pdlogin">
    <div style="padding: 2px 0 6px 5px;">
        <p>
            - Chính thức nghiên cứu nhạc vào năm 2010, lúc đầu chỉ làm website tĩnh (thực chất đi copy
            nguồn trên mạng) và về sau trăn trở làm website nghe nhạc có lời động (karaoke) để nghe các,
			bài hát tiếng Anh. Tôi nghiên cứu code nhạc xtremedia, TGT, IPOS trên diễn đàn về code như
			freecode.com.vn (freecode.vn) và sinhvienit.net, một số website về code nhạc php khác. Mặc dù
			bản thân chưa học một khóa học PHP bài bản nào nhưng vẫn muốn có một website về âm nhạc,
			nơi chia sẻ những bài hát yêu thích với bạn bè.               
        </p>
        <br>
        <p>
            - Sau nhiều lần thử các website nhạc với code nhạc xtremedia 1.2, các code nhạc khác như xtremedia no ajax
            và code nhạc tôi thấy hay và giống với các website nổi tiếng như mp3.zing.vn, nhaccuatui.com, nhacso.net là code
			TGT version 3.0, IPOS 1.0 (TGT 4.5). Với các code nhạc tôi luôn thay player flash bằng jwplayer để hỗ trợ nghe nhạc
			có lời động (karaoke). Ý tưởng này của tôi tới nay đã có website nhaccuatui.com làm player flash hỗ trợ lời bài hát
			động (.lrc) để hiển thị lời hát. Tháng 8-2014 tôi tình cờ tìm thấy code nhạc TGT 4.5 - IPOS 1.0 của một bạn viết
			hỗ trợ trên mobile và tôi quyết định sửa đổi code đó cho giống m.nhaccuatui.com và sau này thêm code giống m.mp3.zing.vn
			Trước hết là học hỏi giao diện các website nổi tiếng sau này mới sáng tạo sau ^_^. Code nhạc trên Mobile 
			nhằm tạo ra một môi trường tiện lợi giúp các bạn yêu thích âm nhạc có
            thể nghe nhạc mọi lúc mọi nơi bằng chính chú dế yêu của các bạn.
        </p>
        <br>
        <p>
            - Sau phiên bản 1.0 ra mắt. Tôi sẽ cố gắng làm giống các chức năng của m.nhaccuatui.com đã tiến hành nâng cấp version
            2.0 với giao diện đẹp , thân thiện và thêm nhiều tính năng mới cho WAP 2.0.
        </p>
        <br>
        <p>
            - Thế còn chờ gì nữa. Hãy cùng trải nghiệm m.nhaccuatui.yzi.me ngay ....</p>
    </div>
</div>


<div align="center" style="padding-top: 5px;"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- NCT Wapsite Bottom 02 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-8464603142208455"
     data-ad-slot="2742105431"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></div><img src="http://api.nas.nct.vn/v2/imp?lk=PKq4ZqhJsvdsl7aAnlna5d%2BLeeIGGlT1&t=wap" width="1px" height="1px">
<!--Ket thuc the loai bai hat-->
<?
//}
//$cache->close();
?>
 <!--Account -->
<div class="account">
<p><input type="button" value="Đăng nhập" onclick="window.location ='login.html';"/></p></div>
<!--Footer -->
<div class="footer">
    <p><a href="<? echo SITE_LINK ?>/mobile">Mobile</a>  |  <a href="<? echo SITE_LINK ?>" rel="nofollow">Desktop</a>  |  <a href="huong-dan.html" rel="nofollow">Hướng dẫn</a></p>
    Copyright © 2014 TGT Mobile
</div>
</body></html> 