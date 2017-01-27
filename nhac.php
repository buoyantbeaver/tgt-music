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
	$sql_tt = "SELECT m_id  FROM tgt_nhac_data WHERE m_type = 1 ORDER BY m_id DESC LIMIT ".LIMITSONG;

	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_song = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_viewed ,m_time, m_hot, m_hq  ","data"," m_type = 1 ORDER BY m_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$cat_name = get_data("theloai","cat_name"," cat_id = '".$id."'");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"nhac/".en_id($id)."-#page#","");
	
	if (count($arr_song)<1) header("Location: ".SITE_LINK."the-loai/404.html");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Top nhạc đề cử, Top Video đề cử - Nghe BXH online, Tải nhạc HAY!</title>
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
            	<h3>Nhạc</h3>
                <div class="padding">
					<div>
						        
						<? if($page <= 20) { 
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type, m_viewed, m_downloaded ","data"," m_type = 1 ORDER BY m_viewed_month DESC LIMIT 10");
for($i=0;$i<count($arr);$i++) {
$id_media = $arr[$i][0];
$id_singer = $arr[$i][2];
$type = $arr[$i][3];
$song_name = htmlchars($arr[$i][1]);
$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$i][2]."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$song_url = check_url_song($arr[$i][1],$arr[$i][0],$arr[$i][3]);
$downloaded = number_format($arr[$i][5]);
$download 		= 'down.php?id='.$arr[$i][0].'&key='.md5($arr[$i][0].'tgt_music');
$viewed = number_format($arr[$i][4]);
$stt			= $i+1;
if($i<2){
$class = "fjx";
} elseif ($i>2){
$class = "";
}
?>
<div class="list_song">
            <div class="left">
            <p class="song"><a title="<? echo $song_name; ?>" href="<? echo $song_url; ?>"><? echo $song_name; ?></a> </p>
            <p class="singer_">Trình bày<a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo $singer_name; ?>" href="<? echo $singer_url; ?>"><? echo $singer_name; ?></a></p>
			<p class="cat_">Download : <? echo $downloaded; ?> | Nghe: <? echo $viewed; ?></p>
</div>
			<div class="right list_icon">
                <div class="left"><a href="<?echo $download; ?>" target="_blank" title="Tải bài hát <? echo $song_name; ?> về máy"><img border="0" src="images/media/down.gif" border="0" class="hover_img" /></a></div>
                <!-- Playlist ADD -->
                <div class="left" id="playlist_<? echo $id_media; ?>" ><a style="cursor:pointer;" onclick="_load_box(<? echo $id_media; ?>);"><img src="images/media/add.gif" class="hover_img"  /></a></div>
                <div class="_PL_BOX" id="_load_box_<? echo $id_media; ?>" style="display:none;"><span class="_PL_LOAD" id="_load_box_pl_<? echo $id_media; ?>" ></span></div>
                <!-- End playlist ADD -->
                <div class="clr"></div>
            </div>
        
        	<div class="clr"></div>
        </div>
                   
			<? } ?>
                        <div class="pages"><? echo $phantrang; ?></div>
						<? } if($page >= 20) { ?>
                            <div class="error_yeu_thich"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
                        <? } ?>
						                    </div>
                </div>
            </div>
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