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
<base href="<? echo SITE_LINK ?>" />
<title><? echo $cat_name;?> | bài hát | Trang <? echo $page;?></title>
<meta name="title" content="<? echo $cat_name;?> | bài hát | Trang <? echo $page;?>" />
<meta name="keywords" content="Thể loại, <? echo $cat_name;?>, bài hát" />
<meta name="description" content="Thể loại <? echo $cat_name;?>  bài hát" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_category','1006');?></div>
    <div id="contents">
    	<div id="m_1">
			<? include("./theme/box/cat_video.php");?>
        </div>
        <!--2-->
        <div id="m_2">
        	<div class="box w_2">
            	<h1 >Video <?=$cat_name;?></h1>
                <div class="padding">
					<div>
<? if($page <= 20) { 
for($i=0;$i<count($arr_song);$i++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_song[$i][2]."'");
	$type = check_type($arr_song[$i][5],$arr_song[$i][0]);
	$video_url = url_link($arr_song[$i][1],$arr_song[$i][0],'xem-video');
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$download = 'down.php?id='.$arr_song[$i][0].'&key='.md5($arr_song[$i][0].'tgt_music');
?>
        <div class="top_video">
        	<div class="x_2">
                <div><a title="Xem video  <? echo un_htmlchars($arr_song[$i][1]); ?>" href="<? echo $video_url; ?>">
                <img class="img_album" src="<? echo check_img($arr_song[$i][5]); ?>" title="Xem video <? echo un_htmlchars($arr_song[$i][1]); ?>" /></a></div>
            </div>
            <div class="x_s1">
            <p class="song"><a title="Nghe bài hát <? echo un_htmlchars($arr_song[$i][1]); ?>" href="<? echo $video_url; ?>"><strong><?=un_htmlchars($arr_song[$i][1]); ?></strong></a></p>
            <p class="singer">Trình bày: <a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo un_htmlchars($singer_name); ?>" href="<? echo $singer_url; ?>"><? echo un_htmlchars($singer_name); ?></a></p>
            <p>Lượt xem : <? echo $arr_song[$i][3]; ?></p>
            </div>
            <div class="x_s2 list_icon">
                <div class="left"><a title="Tải video <? echo un_htmlchars($arr_song[$i][1]); ?>" href="<? echo $download;?>" target="_blank" title="Tải bài hát <? echo $arr_song[$i][1];?> về máy"><img src="images/media/down.gif" border="0" class="hover_img" /></a></div>
                <!-- Playlist ADD -->
                <div class="left" id="Load_Video_<? echo $arr_song[$i][0]; ?>"><a title="Thêm Vào Video Yêu Thích" style="cursor:pointer;" onclick="AddFAV(<? echo $arr_song[$i][0];?>,3);"><img src="images/media/add.gif" class="hover_img"  /></a></div>
                <!-- End playlist ADD -->
                <div class="clr"></div>
            </div>
        
        <div class="clr"></div></div>
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