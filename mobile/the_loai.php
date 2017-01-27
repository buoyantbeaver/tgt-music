<?php
#####################################
#		IPOS V1.0 (TGT 4.5)	Mobile	#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#	edit code: tuannvbg@gmail.com	#
#####################################
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
include("../tgt/ajax.php");
include("../tgt/class.inputfilter.php");
include("../tgt/cache.php");
$myFilter = new InputFilter();
//$cache = new cache();
//if ( $cache->caching ) {
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); $id = del_id($id);
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);


if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}

	// phan trang
	$sql_tt = "SELECT m_id  FROM tgt_nhac_data WHERE m_cat LIKE '%,".$id.",%' AND m_type = 1 ORDER BY m_id DESC LIMIT ".LIMITSONG;

	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_song = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_viewed ,m_time, m_hot, m_hq  ","data"," m_cat LIKE '%,".$id.",%' AND m_type = 1 ORDER BY m_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$cat_name = get_data("theloai","cat_name"," cat_id = '".$id."'");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"the-loai-bai-hat/".replace($cat_name)."/".en_id($id)."-#page#","");
	
	if (count($arr_song)<1) header("Location: ".SITE_LINK."the-loai/404.html");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>mobile/" />
<title>Thể loại  <?=$cat_name;?></title>
<meta name="title" content="Nhạc Việt Nam | bài hát | Trang 1" />
<meta name="keywords" content="Thể loại, Nhạc Việt Nam, bài hát" />
<meta name="description" content="Thể loại Nhạc Việt Nam  bài hát" />
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />  	
<link href="script/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../theme/js/ichphienpro.js"></script>
<script>var mainURL = "<? echo SITE_LINK ?>mobile/";</script>
<script type="text/javascript" src="script/ajax_load.js"></script>

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
             <script type="text/javascript">
            var NCTInfo = {"ROOT_URL": "<? echo SITE_LINK ?>mobile/"};
        </script>
<script type="text/javascript" src="js/core.0.2.js"></script>
<script type="text/javascript" src="js/flash_detect.0.1.js"></script>  
<script type="text/javascript" src="js/html5-player.0.1.js"></script>
<script type="text/javascript" src="js/exec.0.1.js"></script>
<script type="text/javascript" src="script/antt.js"></script>
<script type="text/javascript" src="script/jquery.min.js"></script>
<link href="css/screen.0.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
</head>
    <body>
        <!--Header -->
        <div class="header">
            <h1 class="logo">
                <a href="<? echo SITE_LINK ?>mobile/" title="NhacCuaTui.Com"><img src="images/logo.gif" alt="NhacCuaTui.Com" width="68" height="37" border="0" /></a>
            </h1>
            <span><a href="<? echo SITE_LINK ?>mobile/tim-kiem" title="Tìm kiếm"><img alt="Tìm kiếm" src="images/search.png" width="43" height="37" border="0" /></a></span>
            <span><a href="<? echo SITE_LINK ?>mobile/danh_muc" title="Danh mục"><img alt="Danh mục" src="images/list.png" width="43" height="37" border="0" /></a></span>                      
            <span><a href="<? echo SITE_LINK ?>mobile/login" title="Đăng nhập"><img alt="Đăng nhập" src="images/user.png" width="43" height="37" border="0" /></a></span>
        </div>
        <!--Top Menu -->
        <div class="topmenu"> 
            <a href="<? echo SITE_LINK ?>mobile" class="home " title="IPOS 1.0 Mobile"></a>
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html" class="active" title="Bài hát">Bài hát</a> 
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
<div class="title-main"><img src="images/ico-m.gif" width="13" height="13" align="baseline" /> Bài Hát <?=$cat_name;?></div>

                <div class="padding">
					<div>
						<? if($page <= 20) { 
for($i=0;$i<count($arr_song);$i++) {
	$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr_song[$i][2]."'");
	$type 			= check_type($arr_song[$i][5],$arr_song[$i][0]);
	$song_url 		= check_url_song_mobile($arr_song[$i][1],$arr_song[$i][0],$arr_song[$i][5]);
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$download		= 'down.php?id='.$arr_song[$i][0].'&key='.md5($arr_song[$i][0].'tgt_music');
	$checkhq		= check_song($arr_song[$i][5],$arr_song[$i][6]);
?>
				
    <div class="row ">
    <h3><a href="<? echo $song_url; ?>"><? echo un_htmlchars($arr_song[$i][1]); ?></a></h3> 
    <p><img src="./nct/ico-singer.gif" width="12" height="11" border="0"> <? echo $singer_name; ?><span><img src="./nct/ico-head.gif" width="11" height="11" border="0"> <? echo $arr_song[$i][3]; ?></span></p>
</div>
                <!-- end --->
			
       <div class="clr"></div>   
        </div>
<? } ?>


                        <div class="pages"><? echo $phantrang; ?></div>
						<? } if($page >= 20) { ?>
                            <div class="pagecurrent"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--3-->
<!--The loai bai hat-->
<div class="title-main"><img alt="THỂ LOẠI" src="images/ico-cat.gif" width="14" height="11" align="baseline" /> Thể loại</div>
<div class="pdcat">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list-cat">
        <tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/bai-hat-moi.html" title="Bài hát Mới">Bài hát Mới</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/nhac-tre.html" title="Nhạc Trẻ">Nhạc Trẻ</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-bai-hat/Nhac-Tru-Tinh/EZEFZOE.html" title="Trữ Tình">Trữ Tình</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/cach-mang.html" title="Cách Mạng">Cách Mạng</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/tien-chien.html" title="Tiền Chiến">Tiền Chiến</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/nhac-trinh.html" title="Nhạc Trịnh">Nhạc Trịnh</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/thieu-nhi.html" title="Thiếu Nhi">Thiếu Nhi</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/rap-viet.html" title="Rap Việt">Rap Việt</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/rock-viet.html" title="Rock Việt">Rock Việt</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/pop.html" title="Pop">Pop</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/rock.html" title="Rock">Rock</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/dance.html" title="Dance">Dance</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/rbhip-hoprap.html" title="R&B/Hip Hop/Rap">R&B/Hip Hop/Rap</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/bluejazz.html" title="Blue/Jazz">Blue/Jazz</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/country.html" title="Country">Country</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/latin.html" title="Latin">Latin</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/indie.html" title="Indie">Indie</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/au-my-khac.html" title="Âu Mỹ khác">Âu Mỹ khác</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/han-quoc.html" title="Hàn Quốc">Hàn Quốc</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/nhac-hoa.html" title="Nhạc Hoa">Nhạc Hoa</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/nhac-nhat.html" title="Nhạc Nhật">Nhạc Nhật</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/khong-loi.html" title="Không Lời">Không Lời</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/tui-hat.html" title="Tui Hát">Tui Hát</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/bai-hat/the-loai-khac.html" title="Thể Loại Khác">Thể Loại Khác</a></td></tr>
    </table>
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