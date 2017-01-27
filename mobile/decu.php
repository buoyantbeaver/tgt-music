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
            <h1>TOP Nhạc Đề Cử</h1>
            <div style="padding:10px;">

			<table width="100%" cellpadding="5" cellspacing="5">
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type, m_viewed, m_downloaded ","data"," m_hot = 1 ORDER BY m_id DESC LIMIT 5");
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
						
            <p class="song_"><a title="<? echo $song_name; ?>" class="vtip" href="<? echo $song_url; ?>"><? echo $song_name; ?></a></p>
            <p class="singer_"><a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo $singer_name; ?>" href="<? echo $singer_url; ?>"><? echo $singer_name; ?></a></p>
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
</div>
</div>
					
			</table>
			
	</form>
    </div>
    </div>
            
        </div>  


		<div id="m_2">
			<div class="box w_2">
            <h1>TOP Video Đề Cử</h1>
            <div style="padding:10px;">

			<table width="100%" cellpadding="5" cellspacing="5">
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type, m_viewed, m_downloaded ","data"," m_type = 2 ORDER BY m_id DESC LIMIT 5");
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
<div class="top_video">
        	<div class="x_2">
                <div><a title="Xem video <? echo $song_name; ?>" href="<? echo $song_url; ?>">
                <img class="img_album" src="http://img.youtube.com/vi/lJkH-V0BSuc/default.jpg" title="Xem video Thu Khúc" /></a></div>
            </div>
            <div class="x_s1">
            <p class="song"><a title="Nghe bài hát <? echo $song_name; ?>" href="<? echo $song_url; ?>"><strong><? echo $song_name; ?></strong></a></p>
            <p class="singer">Trình bày: <a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo $singer_name; ?>" href="<? echo $singer_url; ?>"><? echo $singer_name; ?></a></p>
            <p>Lượt xem : <? echo $viewed; ?></p>
            </div>
            <div class="x_s2 list_icon">
                <div class="left"><a title="Tải video <? echo $song_name; ?>" href="<?echo $download; ?>" target="_blank" title="Tải bài hát <? echo $song_name; ?> về máy"><img src="images/media/down.gif" border="0" class="hover_img" /></a></div>
                <!-- Playlist ADD -->
                <div class="left" id="Load_Video_<? echo $id_media; ?>"><a title="Thêm Vào Video Yêu Thích" style="cursor:pointer;" onclick="AddFAV(<? echo $id_media; ?>,3);"><img src="images/media/add.gif" class="hover_img"  /></a></div>
                <!-- End playlist ADD -->
                <div class="clr"></div>
            </div>
        
        <div class="clr"></div></div>
  
        </div>
			<? } ?>
</div>
</div>
					
			</table>
			
	</form>
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