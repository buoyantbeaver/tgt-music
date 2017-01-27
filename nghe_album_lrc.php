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
if(isset($_GET["id"])) $id_album = $myFilter->process($_GET['id']);
if(isset($_GET["st"])) $st 	 	 = $myFilter->process((int)$_GET['st']);
$id_album 						 = del_id($id_album);

mysql_query("UPDATE tgt_nhac_album SET album_viewed = album_viewed+".NUMPLAY.", album_viewed_month = album_viewed_month+".NUMPLAY." WHERE album_id = '".$id_album."'");
//$cache = new cache();
//if ( $cache->caching ) {
$album 			= $tgtdb->databasetgt(" * ","album"," album_id = '".$id_album."' ORDER BY album_id DESC ");
$title 			= get_data("singer","singer_name"," singer_id = '".$album[0][3]."'");
$album_url 		= url_link($album[0][1].'-'.$title,$id_album,'nghe-album');
$user 			= get_user($album[0][7]);
$user_url 		= url_link($user,$album[0][7],'user');
$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($title).'&ks=singer';
$singer_img		= get_data("singer","singer_img"," singer_id = '".$album[0][3]."'");
$singer_img		= check_img($singer_img);
$singer_info	= text_tidy(un_htmlchars(get_data("singer","singer_info"," singer_id = '".$album[0][3]."'")));
$album_link_jwplayer = url_link($album[0][1],$album[0][0],'nghe-album');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<Meta http-equiv="Content-Language" Content="vi">
<base href="<? echo SITE_LINK ?>" />
<title>Album <? echo $album[0][1].' - '.$title; ?> | <? echo $user ?>  | Nghe - tải - chia sẻ nhạc | IPOS </title>
<meta name="title" content="Album <? echo $album[0][1].' - '.$title; ?>  | <? echo $user; ?>  | Nghe - tải - chia sẻ nhạc | TGT music" />
<meta name="description" content="Nghe & tải album <? echo $album[0][1].' - '.$title; ?> , album <? echo $album[0][1].' - '.$title; ?> , do <? echo $user; ?>  tạo tại TGT music - web nhạc chất lượng cao, tốc độ load nhanh & bài hát" />
<meta name="keywords" content="Nghe,tải album,<? echo $album[0][1].','.$title; ?>,album <? echo $album[0][1].', '.$title; ?> , <? echo $user; ?>  ,TGT music,web nhạc chất lượng cao, tốc độ load nhanh,bài hát" />
<link rel="canonical" href="<? echo $album_url;?>"/>
<link rel="image_src" href="<? echo SITE_LINK.$album[0][4];?>" />
<link rel="video_src" href="<? echo SITE_LINK.'flash/album/'.en_id($id_album).'.swf'; ?>" />
<meta name="video_width" content="300" />
<meta name="video_height" content="300" />
<meta name="video_type" content="application/x-shockwave-flash" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_play_album','1006');?></div>
    <div id="contents">
        <!--4-->
        <div id="m_4">
        <? if($album[0][11] == '0') {?>
        	<div class="play_info">
				<div class="img_"><img class="img" src="<?=check_img($album[0][4]);?>" /></div>
                <div class="album__">
					<h4><?=un_htmlchars($album[0][1]);?> - <a href="<?=$singer_url;?>" title="Bài hát của ca sĩ <?=$title;?>"><?=$title;?></a></h4>
					<p>Lượt nghe: <?=number_format($album[0][6]);?></p>
                    <p>Số bài hát: <?=SoBaiHat($album[0][10]);?></p>
                    <p>Ngày upload: <?=check_data($album[0][12]);?></p>
                    <p>Thể loại: <?=GetTheLoai($album[0][8],'album');?></p>
                    <p><div id="info_load" class="row2"><?=check_info($album[0][5],$album[0][1]);?></div><div id="info_txt"><a class="_viewMore" onclick="ALBUMHOWHIDE(1);">Xem toàn bộ</a></div></p>
                </div>
                <div class="clr"></div>
				<h4 align="center">Nghe <a href="<?=$album_link_jwplayer;?> " title="Bài hát của ca sĩ <?=$title;?>"><?=un_htmlchars($album[0][1]);?> - <?=$title;?></a> bằng JWPlayer 7.x</h4>
			</div>
          <? } ?>

<div class="player">
	   <h3><?=un_htmlchars($album[0][1]);?> - <?=$title;?></h3>
	   <h4><font color="red">Lưu ý: APlayer vừa mới cập nhật sửa lỗi chuyển bài hát với APlayer Playlist</font></h4>
	   <h4><font color="blue">Cảm ơn bạn đã nghe nhạc - Chúc bạn luôn luôn vui vẻ và hạnh phúc.</font></h4>
       <div id="player5" class="aplayer"></div>
	   <script src="<? echo $SITE_LINK.'xml/lrc/'.en_id($id_album).'.js'; ?>"></script>
</div>
<ul class="list_play_all_song">
            <?php            
            $s = explode(',',$album[0][10]);
            foreach($s as $x=>$val) {
                
            $arr[$x] 			= $tgtdb->databasetgt(" m_id, m_title, m_singer,m_type ","data"," m_id = '".$s[$x]."'");
            
            $singer_name 		= get_data("singer","singer_name"," singer_id = '".$arr[$x][0][2]."'");
            $singer_url 		= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
            $download 			= 'down.php?id='.$arr[$x][0][0].'&key='.md5($arr[$x][0][0].'tgt_music');
            $song_url 			= check_url_song($arr[$x][0][1].'-'.$singer_name,$arr[$x][0][0],$arr[$x][0][3]);
			$album_url_list 	= url_link($album[0][1].'-'.$title,$id_album,'nghe-album',$x);
            ?>
<li class="list_s009">
<div class="k003"><b><? echo $x+1; ?></b></div>
<div class="k001"><span class="title"><a title="<? echo un_htmlchars($arr[$x][0][1]); ?> - <? echo un_htmlchars($singer_name); ?>" href="javascript:;" onclick="jwplayer().playlistItem('<? echo $x; ?>');"><? echo un_htmlchars($arr[$x][0][1]); ?> - <? echo un_htmlchars($singer_name); ?></a></span></div>
<div class="k002">
<a class="nghe" title="<? echo un_htmlchars($arr[$x][0][1]); ?> - <? echo un_htmlchars($singer_name); ?>" href="<? echo $album_url_list;?>"></a>


                        <div class="them" id="playlist_<? echo $arr[$x][0][0]; ?>"><a style="cursor:pointer;" onclick="_load_box(<? echo $arr[$x][0][0]; ?>);"></a></div>
                        <div class="_PL_BOX" id="_load_box_<? echo $arr[$x][0][0]; ?>" style="display:none;"><span class="_PL_LOAD" id="_load_box_pl_<? echo $arr[$x][0][0]; ?>"></span></div>



<a class="tai" href="<? echo $download;?>" target="_blank" title="Tải bài hát <? echo $arr[$x][0][1];?> về máy"></a>
</div>
<div class="_lyric" style="display: none;"></div>
<p class="seo"><a title="Tìm bài hát Cố Quên Đi Hết" href="/tim-bai-hat/co-quen-di-het-1.html">Cố Quên Đi Hết</a></p>
<div class="clr"></div>
</li>           			
            <? } ?>
            </ul>

            <!-- begin shared -->
            <ul class="idTabs list_shared">
            	<li class="selected"><a class="_Embed" href="#_Embed">Chia sẻ</a></li>
            	<li><a class="_Add" href="#_Add" onclick="AddFAVAlbum(<?=$id_album;?>);">Yêu thích</a></li>
            </ul>
            <div class="clr"></div>
            <div id="_Embed" class="box_">
                    <table width="100%" cellpadding="2">
                    <tr><td width="100"><strong>Link nhạc:</strong></td><td><input class="in" type="text" value="<? echo $song_url; ?>" onclick='this.select();copy(this.value);'  readonly="1" /></td></tr>
                    
                    <tr><td><strong>Nhúng blog:</strong></td><td><input class="in" type="text" value="<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' align='middle'codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' height='60' width='305'><param name='movie' value='<? echo SITE_LINK.'flash/album/'.en_id($id_album).'.swf'; ?>'><param name='loop' value='false'><param name='menu' value='false'><param name='quality' value='high'><param name='scale' value='exactfit'><param name='bgcolor' value='#7B5DA5'><embed src='<? echo SITE_LINK.'flash/album/'.$id_album.'.swf'; ?>' loop='false' menu='false' quality='high' scale='exactfit' type='application/x-shockwave-flash' pluginspage=http://www.macromedia.com/go/getflashplayer height=60 width=300></object>" onclick='this.select();copy(this.value);'  readonly="1" /></td></tr>
                    <tr><td><strong>Nhúng forum:</strong></td><td><input class="in" type="text" value="[FLASH]<? echo SITE_LINK.'flash/album/'.en_id($id_album).'.swf'; ?>[/FLASH]" onclick='this.select();copy(this.value);'  readonly="1" /></td></tr>
                </table>
            </div>
            <div id="_Add" class="box_"></div>
            <!-- end shared -->
            <!-- album -->
<?
// album cung ca si
$arrz = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat ","album"," album_singer = '".$album[0][3]."' ORDER BY RAND() LIMIT 4");
if($arrz) {
?>
<? if($lyric_info) { ?>
<div id="_lyricContainer" class="w_4">
		<h3><strong><span class="seo">Lời bài hát </span><?=un_htmlchars($song[0][0]);?></strong></h3>
		<p id="lyric_load" class="_lyricContent rows4"><?=$lyric_info;?></p>
	 <div class="iLyric"><a class="_viewMore" onclick="LYRICSHOWHIDE(1);">Xem toàn bộ</a></div>
</div>
<? } ?>
<? if($singer_info) { ?>
            <div class="box w_4">
            	<h1>Thông tin ca sĩ <?=$title ;?><a onclick="SINGERSHOWHIDE();" id="singer_txt">Xem thông tin</a></h1>
                <div id="singer_info" class="singer_info none">
                    <div class="info_singer" id="LoadSingerInfo"><?=$singer_info;?></div>
                    <div class="img_singer"><img class="img" src="<?=check_img($singer_img);?>" /></div>
                    <br class="clr" />
                </div>
            </div>
<? } ?>


            <div class="box w_4">
            	<h1>Album cùng ca sĩ</h1>
                <div class="new_album_bg">
<?
 for($z=0;$z<count($arrz);$z++) {
     $singer_name = get_data("singer","singer_name"," singer_id = '".$arrz[$z][2]."'");
     $singer_url = 'tim-kiem/playlist.html?key='.text_s($singer_name).'&ks=singer';
     $album_url = url_link($arrz[$z][1].'-'.$singer_name,$arrz[$z][0],'nghe-album');
	 if($z==3)	$class[$z]	=	"fjx";
?>
<div class="album_ <?=$class[$z];?>">
    <p class="images">
	<a href="<?=$album_url?>" title="<?=$arrz[$z][1];?> - <?=$singer_name;?>"><img alt="<?=$arrz[$z][1];?> - <?=$singer_name;?>" src="<?=check_img($arrz[$z][3]);?>"></a></p>
    <p style="margin-top:15px;"><a href="<?=$album_url?>" title="<?=$arrz[$z][1];?> - <?=$singer_name;?>"><?=$arrz[$z][1];?></a></p>
</div>
<? } ?>
<div class="clr"></div>
<div class="read_"><a href="<?=$singer_url;?>" class="read-more">Xem thêm</a></div>
				</div>
            </div>
<? } ?>


<?
// video cung ca si
$arrz = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img, m_cat ","data"," m_singer = '".$album[0][3]."' AND m_type = 2 ORDER BY RAND()
 LIMIT 4");
if($arrz) {
?>
            <div class="box w_4">
            	<h1>Video cùng ca sĩ</h1>
                <div class="new_video_bg">
<?
for($z=0;$z<count($arrz);$z++) {
    $singer_name 	= get_data("singer","singer_name"," singer_id = '".$arrz[$z][2]."'");
    $singer_url 	= 'tim-kiem/video.html?key='.text_s($singer_name).'&ks=singer';
    $video_url 		= url_link($arrz[$z][1].'-'.$singer_name,$arrz[$z][0],'xem-video');
	if($z==3)	$class[$z]	=	"fjx";
?>
<div class="video_ <?=$class[$z];?>">
    <p class="images">
	<a href="<?=$video_url?>" title="<?=$arrz[$z][1];?> - <?=$singer_name;?>"><img alt="<?=$arrz[$z][1];?> - <?=$singer_name;?>" src="<?=check_img($arrz[$z][3]);?>"></a></p>
    <p style="margin-top:10px;"><a href="<?=$video_url?>" title="<?=$arrz[$z][1];?> - <?=$singer_name;?>"><?=$arrz[$z][1];?></a></p>
</div>
<? } ?>
<div class="clr"></div>
<div class="read_"><a href="<?=$singer_url;?>" class="read-more">Xem thêm</a></div>
                </div>
            </div>
<? } ?>

<!-- begin binh luan -->
<div class="box w_4">
<h1>Bình luận</h1>
<?=cam_nhan($id_album,1,2);?>
</div>
<!-- end binh luan -->
        </div>
        <!--3-->
        <div id="m_3">
        <?=BANNER('play_right','345');?>
            <div class="box w_3">
            <h1>Album cùng thể loại</h1>
<?php
$album_hot = $tgtdb->databasetgt(" album_name, album_singer, album_img, album_viewed, album_id ","album"," album_cat = '".$album[0][8]."' ORDER BY RAND() DESC LIMIT 5");
for($h=0;$h<count($album_hot);$h++) {
		$singer_name_hot 	= get_data("singer","singer_name"," singer_id = '".$album_hot[$h][1]."'");
		$singer_url_hot 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name_hot).'&ks=singer';
		$album_url_hot		= url_link($album_hot[$h][0],$album_hot[$h][4],'nghe-album');
?>
        <div class="top_video">
        	<div class="x_e">
            <a href="<?=$album_url_hot; ?>" title="<?=$album_hot[$h][0];?> - <?=$singer_name_hot; ?>"><img alt="<?=$album_hot[$s][2]; ?> - <?=$singer_name_hot; ?>" src="<?=check_img($album_hot[$h][2]);?>"></a></div>
            <div class="x_3">
                <p class="song"><a href="<?=$album_url_hot; ?>" title="<?=$album_hot[$h][0]; ?>"><?=un_htmlchars($album_hot[$h][0]);?></a></p>
                <p class="singer">
        		<a href="<?=$singer_url_hot; ?>" title="Bài hát của ca sĩ <?=$singer_name_hot; ?>"><?=un_htmlchars($singer_name_hot);?></a></p>
            </div>
        <div class="clr"></div>
        
        </div>

<? } ?>
<div class="read_"><a class="read-more" href="tim-kiem/bai-hat.html?key=<? echo text_s($singer_name);?>&ks=singer">Xem thêm</a></div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>