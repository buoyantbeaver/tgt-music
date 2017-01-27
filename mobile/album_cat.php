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
	$sql_tt = "SELECT album_id  FROM tgt_nhac_album WHERE  album_cat LIKE '%,".$id.",%' ORDER BY album_id DESC LIMIT ".LIMITSONG;

	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_album = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_viewed, album_img, album_type, album_cat, album_poster, album_time, album_song ","album"," album_cat LIKE '%,".$id.",%'  ORDER BY album_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$cat_name = get_data("theloai","cat_name"," cat_id = '".$id."'");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"the-loai-album/".replace($cat_name)."/".en_id($id)."-#page#","");
	
	if (count($arr_album)<1) header("Location: ".SITE_LINK."the-loai/404.html");

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
<link href="script/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<? echo SITE_LINK ?>/theme/js/ichphienpro.js"></script>
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
<script type="text/javascript" src="jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="jquery.idTabs.min.js"></script>
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
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html"  title="Bài hát">Bài hát</a> 
            <a href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html"  class="active" title="Playlist">Playlist</a>  
            
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
<div class="title-main"><img alt="Playlist nhạc HOT nhất" src="images/ico-list.gif" width="18" height="15" align="baseline" /> Album <?=$cat_name;?></div> 
<? if($page <= 20) { 
for($i=0;$i<count($arr_album);$i++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_album[$i][2]."'");
	$user_name = get_user($arr_album[$i][7]);
	$album_url = url_link_mobile($arr_album[$i][1],$arr_album[$i][0],'nghe-album');
	$user_url = url_link($user_name,$arr_album[$i][7],'user');
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
?>
<div class="row ">
    <div class="img-40"><a href="<? echo $album_url; ?>" title="<? echo $arr_album[$i][1]; ?>"><img alt="<? echo $arr_album[$i][1]; ?>" src="<? echo check_img($arr_album[$i][4]);?>" width="40" height="40" border="0" /></a></div>
    <div class="txt-40">
        <h3><a href="<? echo $album_url; ?>" title="<? echo $arr_album[$i][1]; ?>"><? echo un_htmlchars($arr_album[$i][1]);?> - <? echo un_htmlchars($singer_name);?></a></h3>  
        <p><img alt="<? echo number_format($arr_album[$i][3]);?> lượt nghe" src="images/ico-head.gif" width="11" height="11" border="0" /> <? echo number_format($arr_album[$i][3]);?> &nbsp;&nbsp;&nbsp;</p>
    </div>    </div>
	
<?	} ?>

<div class="more"><a title="Xem thêm" href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html">Xem thêm <img alt="Xem thêm" src="images/ico-more.gif" width="10" height="10" border="0" align="absmiddle" /></a></div>
                         <div class="pages"><? echo $phantrang; ?></div>
						<? } if($page >= 20) { ?>
                            <div class="pagecurrent"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--3-->
<div class="title-main"><img alt="THỂ LOẠI" src="images/ico-cat.gif" width="14" height="11" align="baseline" /> Thể loại</div>
<div class="pdcat">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list-cat">
        <tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/playlist-moi.html" title="Playlist Mới">Playlist Mới</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/nhac-tre.html" title="Nhạc Trẻ">Nhạc Trẻ</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/tru-tinh.html" title="Trữ Tình">Trữ Tình</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/cach-mang.html" title="Cách Mạng">Cách Mạng</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/tien-chien.html" title="Tiền Chiến">Tiền Chiến</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/nhac-trinh.html" title="Nhạc Trịnh">Nhạc Trịnh</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/thieu-nhi.html" title="Thiếu Nhi">Thiếu Nhi</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/rap-viet.html" title="Rap Việt">Rap Việt</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/rock-viet.html" title="Rock Việt">Rock Việt</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/au-my.html" title="Âu, Mỹ">Âu, Mỹ</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/han-quoc.html" title="Hàn Quốc">Hàn Quốc</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/nhac-hoa.html" title="Nhạc Hoa">Nhạc Hoa</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/nhac-nhat.html" title="Nhạc Nhật">Nhạc Nhật</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/khong-loi.html" title="Không Lời">Không Lời</a></td></tr><tr><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/nhac-phim.html" title="Nhạc Phim">Nhạc Phim</a></td><td align="center"><a href="<? echo SITE_LINK ?>mobile/playlist/the-loai-khac.html" title="Thể Loại Khác">Thể Loại Khác</a></td></tr>
    </table>
</div>

<div align="center" style="padding-top: 5px;"><a href="http://api.nas.nct.vn/v2/click?d=7b6c6b3a784331734d253242754f58764d5032453979554c59453869697035767350587146302c7461726765743a687474702533412532462532467669702e6e6861636375617475692e636f6d2532462c74696d653a313430393633343837323335387d" target="_blank" rel="nofollow"> <img src=" http://stc.nas.nixcdn.com/upload/2014/08/25/37413f8a47c351.jpg" alt="403" width="300" height="250"></a></div><img src="http://api.nas.nct.vn/v2/imp?lk=xC1sM%2BuOXvMP2E9yULYE8iip5vsPXqF0&t=wap" width="1px" height="1px">		
		
<?
//}
//$cache->close();
?>
 <!--Account -->
<div class="account">
<p><input type="button" value="Đăng nhập" onclick="window.location ='login.html';"/></p></div>
    <? include("./skin/ip_footer.php");?>
</body></html> 