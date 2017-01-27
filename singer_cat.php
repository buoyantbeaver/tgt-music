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
	$sql_tt = "SELECT m_id  FROM tgt_nhac_data WHERE m_cat LIKE '%,".$id.",%' AND m_type = 1 ORDER BY m_id DESC LIMIT ".LIMITSONG;

	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_song = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_viewed ,m_time, m_hot, m_hq  ","data"," m_cat LIKE '%,".$id.",%' AND m_type = 1 ORDER BY m_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$cat_name = get_data("theloai","cat_name"," cat_id = '".$id."'");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"the-loai-ca-sy/".replace($cat_name)."/".en_id($id)."-#page#","");
	
	if (count($arr_song)<1) header("Location: ".SITE_LINK."the-loai/404.html");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title><? echo $cat_name;?> | Ca sỹ | Trang <? echo $page;?></title>
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

        <!--2-->
<div class="box w_4">
            	<h1 class="album_icon_new">Ca sỹ HOT</h1>
					<div class="new_album_bg" id="load_album">
						<? if($page <= 20) { 
$arr = $tgtdb->databasetgt("singer_id, singer_name, singer_img, singer_info, singer_hot,singer_id","singer"," singer_hot = 1 ORDER BY RAND() DESC LIMIT 16");
for($i=0;$i<count($arr);$i++) {
$title = get_data("singer","singer_name"," singer_id = '".$arr[$i][0]."' ORDER BY singer_id DESC LIMIT 100");
$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr_song[$i][2]."'");
$singer_id = get_data("singer","singer_id"," singer_id = '".$arr[$i][5]."'");
$stt			= $i+1;
if($i==3 || $i==7 || $i==11 || $i==15){
$class = "fjx";
} elseif ($i>3){
$class = "";
}
?>
						<div class="album_ <? echo $class ; ?>">
    <p class="images">
	<a title="<? echo $arr[$i][1] ?>" href="tim-kiem/bai-hat.html?key=<? echo text_s($arr[$i][1]);?>&ks=singer"><img src="<? echo check_img($arr[$i][2]) ?>" alt="<? echo $arr[$i][1] ?>" /></a></p>
    <h2><a title="<? echo $arr[$i][1] ?>" href="tim-kiem/bai-hat.html?key=<? echo text_s($arr[$i][1]);?>&ks=singer"><? echo $arr[$i][1] ?></a></h2>

</div>
<? } ?>
<div class="clr"></div>

                        <div class="pages"><? echo $phantrang; ?></div>
						<? } if($page >= 20) { ?>
                            <div class="error_yeu_thich"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
                        <? } ?>
                    </div>
                </div>
            </div>

  
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>
<?
//}
//$cache->close();
?>