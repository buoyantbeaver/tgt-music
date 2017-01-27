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
<base href="<? echo SITE_LINK ?>" />
<title><? echo $cat_name;?> | album | playlist | Trang <? echo $page;?></title>
<meta name="title" content="<? echo $cat_name;?> | bài hát | Trang <? echo $page;?>" />
<meta name="keywords" content="Thể loại, <? echo $cat_name;?>, playlist, album" />
<meta name="description" content="Thể loại <? echo $cat_name;?>  playlist, album" />
<link rel="image_src" href="http://nhac.topgiaitri.com/images/tgt_mp3.jpg" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents">
    	<div id="m_1">
			<? include("./theme/box/cat_album.php");?>
        </div>
        <!--2-->
        <div id="m_2">
        	<div class="box w_2">
            	<h1 >Album <?=$cat_name;?></h1>
                <div class="padding">
					<div>
<? if($page <= 20) { 
for($i=0;$i<count($arr_album);$i++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_album[$i][2]."'");
	$user_name = get_user($arr_album[$i][7]);
	$album_url = url_link($arr_album[$i][1],$arr_album[$i][0],'nghe-album');
	$user_url = url_link($user_name,$arr_album[$i][7],'user');
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
?>

                    <div class="album_list border_bottom">
                    <table width="100%" border="0" cellpadding="2" cellspacing="2">
                        <tr>
                            <td width="135" valign="top"><div class="img_"><a title="Nghe Album <? echo $arr_album[$i][1]; ?>" href="<? echo $album_url; ?>"><img class="img" src="<? echo check_img($arr_album[$i][4]);?>" /></a></div></td>
                            <td valign="top" align="left" class="fjx_padding">
                                <table width="100%"  border="0" cellpadding="2" cellspacing="2">
                                    <tr><td colspan="2" class="album_title"><h4><span class="singer_"><a title="Nghe Album <? echo $arr_album[$i][1]; ?>" href="<? echo $album_url; ?>"><? echo un_htmlchars($arr_album[$i][1]);?></a></span>- <span class="singer_"><a href="<? echo $singer_url;?>" title="Bài hát của ca sĩ <? echo un_htmlchars($singer_name);?>"><? echo un_htmlchars($singer_name);?></a></span></h4></td></tr>
                                    <tr><td width="100">Lượt nghe: </td><td><? echo number_format($arr_album[$i][3]);?></td></tr>
                                    <tr><td>Số bài hát: </td><td><? echo SoBaiHat($arr_album[$i][9]);?></td></tr>
                                    <tr><td>Ngày upload: </td><td><? echo check_data($arr_album[$i][8]);?></td></tr>
                                    <tr><td>Thể loại: </td><td><? echo GetTheLoai($arr_album[0][6],'album');?></td></tr>
                                    <tr><td colspan="2" id="Load_Album_<? echo $arr_album[$i][0];?>"><a class="Alike" onclick="AddFAV(<? echo $arr_album[$i][0];?>,2);">Yêu Thích</a></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </div>
<?	} ?>
                        <div class="pages"><? echo $phantrang; ?></div>
						<? } if($page >= 20) { ?>
                            <div class="error_yeu_thich"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--3-->
        <div id="m_3">
        	<?=BANNER('the_loai','345');?>
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