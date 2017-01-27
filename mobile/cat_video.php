<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
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
	$sql_tt = "SELECT m_id  FROM tgt_nhac_data WHERE  m_cat LIKE '%,".$id.",%'  AND m_type = 2  ORDER BY m_id DESC LIMIT ".LIMITSONG;

	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_song = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_viewed ,m_time, m_img  ","data","  m_cat LIKE '%,".$id.",%'  AND m_type = 2  ORDER BY m_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$cat_name = get_data("theloai","cat_name"," cat_id = '".$id."'");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"the-loai-video/".replace($cat_name)."/".en_id($id)."-#page#","");
	
	if (count($arr_song)<1) header("Location: ".SITE_LINK."the-loai/404.html");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>mobile/" />
<title><? echo $cat_name;?> | Video | Trang <? echo $page;?></title>
<meta name="title" content="<? echo $cat_name;?> | bài hát | Trang <? echo $page;?>" />
<meta name="keywords" content="Thể loại, <? echo $cat_name;?>, bài hát" />
<meta name="description" content="Thể loại <? echo $cat_name;?>  bài hát" />
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />  
<!--
<link href="../theme/css/styles.css" rel="stylesheet" type="text/css" />
<link href="../theme/css/skin.css" rel="stylesheet" type="text/css" />
-->
<link href="script/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<link href="css/screen.0.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
</head>
    <body>
        <!--Header -->
        <div class="header">
            <h1 class="logo">
                <a href="<? echo SITE_LINK ?>mobile" title="IPOS 1.0 Mobile"><img src="images/logo.gif" alt="NhacCuaTui.Com" width="68" height="37" border="0" /></a>
            </h1>
            <span><a href="<? echo SITE_LINK ?>mobile/tim-kiem" title="Tìm kiếm"><img alt="Tìm kiếm" src="images/search.png" width="43" height="37" border="0" /></a></span>
            <span><a href="<? echo SITE_LINK ?>mobile/danh_muc" title="Danh mục"><img alt="Danh mục" src="images/list.png" width="43" height="37" border="0" /></a></span>                      
            <span><a href="<? echo SITE_LINK ?>mobile/login" title="Đăng nhập"><img alt="Đăng nhập" src="images/user.png" width="43" height="37" border="0" /></a></span>
        </div>
        <!--Top Menu -->
        <div class="topmenu"> 
            <a href="<? echo SITE_LINK ?>mobile" class="home " title="IPOS 1.0 Mobile"></a>
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html"  title="Bài hát">Bài hát</a> 
            <a href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html"  title="Playlist">Playlist</a>              
            <a href="the-loai-video/Nhac-Tre/EZEFZOB.html"  class="active" title="MV">MV</a>
            
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
<div class="title-main"><img src="images/ico-m.gif" width="13" height="13" align="baseline" /> Video <?=$cat_name;?></div>

                <div class="padding">
					<div>
<? if($page <= 20) { 
for($i=0;$i<count($arr_song);$i++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_song[$i][2]."'");
	$type = check_type($arr_song[$i][5],$arr_song[$i][0]);
	$video_url = url_link_mobile($arr_song[$i][1],$arr_song[$i][0],'xem-video');
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$download = 'down.php?id='.$arr_song[$i][0].'&key='.md5($arr_song[$i][0].'tgt_music');
?>
<div class="row ">
    <div class="img-80"><span class="icon"></span><a href="<? echo $video_url; ?>" title="Xem video  <? echo un_htmlchars($arr_song[$i][1]); ?>"><img alt="Xem video <? echo un_htmlchars($arr_song[$i][1]); ?>" src="<? echo check_img($arr_song[$i][5]); ?>" width="80" height="45" border="0" /></a></div>
    <div class="txt-80">
        <h3><a href="<? echo $video_url; ?>" title="Nghe bài hát <? echo un_htmlchars($arr_song[$i][1]); ?>"><?=un_htmlchars($arr_song[$i][1]); ?></a></h3> 
        <p><img alt="<? echo un_htmlchars($singer_name); ?>" src="images/ico-singer.gif" width="12" height="11" border="0" /> <? echo un_htmlchars($singer_name); ?> <span><img src="images/ico-head.gif" width="11" height="11" border="0" alt="<? echo $arr_song[$i][3]; ?> lượt nghe"/> <? echo $arr_song[$i][3]; ?></span></p>
    </div>
	</div>
<?	} ?>
                          <div class="pages"><? echo $phantrang; ?></div>
						<? } if($page >= 20) { ?>
                            <div class="pagecurrent"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--3-->
		<!--THE LOAI VIDEO -->
<div class="title-main"><img alt="THỂ LOẠI" src="images/ico-cat.gif" width="14" height="11" align="baseline" /> Thể loại</div>
<div class="pdcat">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list-cat">
        <tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/mv-moi.html" title="Mv Mới">Mv Mới</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/viet-nam.html" title="Việt Nam">Việt Nam</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/nhac-tre.html" title="Nhạc Trẻ">Nhạc Trẻ</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/tru-tinh.html" title="Trữ Tình">Trữ Tình</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/que-huong.html" title="Quê Hương">Quê Hương</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/cach-mang.html" title="Cách Mạng">Cách Mạng</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/thieu-nhi.html" title="Thiếu Nhi">Thiếu Nhi</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/rap-viet.html" title="Rap Việt">Rap Việt</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/rock-viet.html" title="Rock Việt">Rock Việt</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/Nhac-Au-My/EZEFZUU.html" title="Âu, Mỹ">Âu, Mỹ</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/pop.html" title="Pop">Pop</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/rock.html" title="Rock">Rock</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/dance.html" title="Dance">Dance</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/rbhiphoprap.html" title="R&B/HipHop/Rap">R&B/HipHop/Rap</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/bluejazz.html" title="Blue/Jazz">Blue/Jazz</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/country.html" title="Country">Country</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/latin.html" title="Latin">Latin</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/indie.html" title="Indie">Indie</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/au-my-khac.html" title="Âu Mỹ khác">Âu Mỹ khác</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/han-quoc.html" title="Hàn Quốc">Hàn Quốc</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/nhac-nhat.html" title="Nhạc Nhật">Nhạc Nhật</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/nhac-hoa.html" title="Nhạc Hoa">Nhạc Hoa</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/the-loai-khac.html" title="Thể Loại Khác">Thể Loại Khác</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/giai-tri.html" title="Giải Trí">Giải Trí</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/clip-vui.html" title="Clip Vui">Clip Vui</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/hai-kich.html" title="Hài Kịch">Hài Kịch</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim.html" title="Phim">Phim</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/giai-tri-khac.html" title="Giải Trí Khác">Giải Trí Khác</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-viet-nam.html" title="Phim Việt Nam">Phim Việt Nam</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-trung-quoc.html" title="Phim Trung Quốc">Phim Trung Quốc</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-thai-lan.html" title="Phim Thái Lan">Phim Thái Lan</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-hoat-hinh.html" title="Phim Hoạt Hình">Phim Hoạt Hình</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-han-quoc.html" title="Phim Hàn Quốc">Phim Hàn Quốc</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-au-my.html" title="Phim Âu Mỹ">Phim Âu Mỹ</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-thieu-nhi.html" title="Phim Thiếu Nhi">Phim Thiếu Nhi</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/the-loai-video/phim-nhat-ban.html" title="Phim Nhật Bản">Phim Nhật Bản</a></td></tr>
    </table>
</div>
		<!--end THE LOAI VIDEO-->
<?
//}
//$cache->close();
?>
 <!--Account -->
<div class="account">
<p><input type="button" value="Đăng nhập" onclick="window.location ='login.html';"/></p></div>
<? include("./skin/ip_footer.php");?>
</body></html> 