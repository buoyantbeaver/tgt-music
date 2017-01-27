<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["act"])) $act = $myFilter->process($_GET['act']);
$up = $tgtdb->databasetgt(" * ","cf"," cf_id = 1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Bảng Xếp Hạng Nhạc Việt Nam Tháng <? echo date('m');?></title>
<meta name="title" content="Bảng xếp hạng nhạc việt nam tháng <? echo date('m');?>" />
<meta name="keywords" content="Bảng xếp hạng nhạc việt nam tháng <? echo date('m');?>" />
<meta name="description" content="Bảng xếp hạng nhạc việt nam tháng <? echo date('m');?>" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_play_album','1006');?></div>
    <div id="contents">
        <!--4-->
        <div id="m_4">
		<div class="play_info">
				<div class="img_"><img class="img" src="<?=check_img($album[0][4]);?>" /></div>
                <div class="album__">
					<h4>Bảng Xếp Hạng Nhạc Việt Nam Tháng <? echo date('m');?> - <a href="" title="Bài hát của Nhiều Ca Sĩ">Nhiều Ca Sĩ</a></h4>
					<p>Thời gian: <? echo $up[0][3];?></p>
                    <p>Số bài hát: 10</p>

                    <p>Thể loại: Nhạc Việt Nam</p>
                    <p><div id="info_load" class="row2"><?=check_info($album[0][5],$album[0][1]);?></div><div id="info_txt"><a class="_viewMore" onclick="ALBUMHOWHIDE(1);">Xem toàn bộ</a></div></p>
                </div>
                <div class="clr"></div>
			</div>


			<div class="player">
            
<div><object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="84">
	<param name="movie" value="<? echo SITE_LINK; ?>tgt_file/player.swf" />
	<param name="quality" value="high" />
	<param name="wmode" value="transparent" />
	<param name="allowscriptaccess" value="always"/>

	<param name="allowfullscreen" value="true"/>
	<param name="flashvars" value="file=<? echo SITE_LINK; ?>xml/6/bxh-nhac-vn.xml&playlistsize=0&playlist=bottom&info=true&autostart=true&songid=<?=$st;?>&uservip=true&ads=">
	<embed id="player" wmode="transparent" allowscriptaccess="always" allowfullscreen="true" width="100%" height="84" src="<? echo SITE_LINK; ?>tgt_file/player.swf" flashvars="file=<? echo SITE_LINK; ?>xml/6/bxh-nhac-vn.xml&playlistsize=0&playlist=bottom&info=true&autostart=true&songid=<?=$st;?>&uservip=true&ads=" />
</object></div>

<!--
<div class="player">		<div class="nghenhac-play" id="currentplay">&nbsp;</div><div id="mediaplayer"></div>
	<script type="text/javascript" src="<? echo SITE_LINK; ?>tgt_file/jwplayer.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		jwplayer("mediaplayer").setup({
            'flashplayer': '<? echo SITE_LINK; ?>tgt_file/jw_player.swf',
			'playlistfile': '<? echo SITE_LINK; ?>xml/3/<?=en_id($id_album);?>.xml',
			//'playlist': 'bottom',
			//'playlistsize': '50',
			//'autoscroll': 'false',
			'bufferlength': '1',
			'mute': 'false',

			'controlbar': 'bottom',
			'width': '100%',
			'height': '24',
			'repeat' : 'always',
			'wmode' : 'transparent',
			'quality' : 'high',
			'lightcolor' : '3333FF',
			'screencolor' : '2A2A2A',
			'frontcolor' : '3333FF',
			'backcolor' : 'FFFFFF',
			'shownavigation': 'true',			
			'autostart': 'true', 
			'item': '0', 
			'display.showmute': 'false', 
			'dock': 'true', 
			'logo.file':'http://www.baihathay.info//images/logo.png',
			'logo.hide' : 'false',
			'logo.position' : 'top-right',
			'logo.timeout': '10',			
			//'plugins': {
			//	'gapro-2': {}
			//},
            'plugins': {
                
            },
			events: {
				onPlaylistItem: function(event) { var currentItem = jwplayer().getPlaylistItem(); $('#currentplay').html(currentItem.title +' -<span class="nghenhac-play-casi"> '+currentItem.description+'</span>');dsp_thong_bao_chat_luong_nhac_dang_nghe(currentItem);}
			,onError: function(){playlistOnError(jwplayer())}}
		});
		//]]>
	</script>
	-->

            <div class="list_play_all_song" id="_plContainer">
            <?
				$arr_vn_ = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_viewed ","data"," m_cat LIKE '%,".IDCATVN.",%' AND m_type = 1 ORDER BY m_viewed_month DESC LIMIT 10");
				
				for($i=0;$i<count($arr_vn_);$i++) {
					$list_song	.=	$arr_vn_[$i][0].',';
					$list_song_ = 	substr($list_song,0,-1);
				if(date("w") == 0 && $up[0][4] == '1') {
					mysql_query("UPDATE tgt_nhac_cf SET cf_value = '".$list_song_."', cf_date = '".date("d/m/Y")." - ".tinh_tuan(7)."', cf_up = '0' WHERE cf_id = '1'");
				}
				$viewed 	= number_format($arr_vn_[$i][3]);
				$singer_vn_ = get_data("singer","singer_name"," singer_id = '".$arr_vn_[$i][2]."'");
				$song_vn_ = url_link($arr_vn_[$i][1],$arr_vn_[$i][0],'nghe-bai-hat');
				$singer_url_vn_ = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn_).'&ks=singer';
				$singer_img_vn_ = get_data("singer","singer_img"," singer_id = '".$arr_vn_[$i][2]."'");
				$download 		= 'down.php?id='.$arr_vn_[$i][0].'&key='.md5($arr_vn_[$i][0].'tgt_music');
				$number	=	$i+1;
                ?>
                <div id="_plItem<?=($i+1);?>" class="list_s009 <? if($i == $st) echo 'hover';?>">
                        <div class="k001"><b><? echo $i+1; ?></b>. <span class="title"><a href="<? echo url_link($arr_vn_[$i][1],$arr_vn_[$i][0],'nghe-bai-hat');?>"><? echo un_htmlchars($arr_vn_[$i][1]); ?></a></span> - <span class="title"><a href="<? echo $singer_url_vn_; ?>"><? echo un_htmlchars($singer_vn_); ?></a></span></div>
                        <div class="k002">
                        <div class="left"><a href="<? echo $download;?>" target="_blank" title="Tải bài hát <? echo $arr[$i][0][1];?> về máy"><img src="images/media/down.gif" class="hover_img" /></a></div>
                        <div class="left"><a title="Nghe bài hát <? echo $arr[$i][0][1];?>" href="<? echo url_link($arr_vn_[$i][1],$arr_vn_[$i][0],'nghe-bai-hat');?>"><img src="images/media/play.gif" class="hover_img" /></a></div>
                        <!-- Playlist ADD -->
                        <div class="left" id="playlist_<? echo $arr[$i][0][0]; ?>"><a style="cursor:pointer;" onclick="_load_box(<? echo $arr[$i][0][0]; ?>);"><img src="images/media/add.gif" class="hover_img" /></a></div>
                        <div class="_PL_BOX" id="_load_box_<? echo $arr[$i][0][0]; ?>" style="display:none;"><span class="_PL_LOAD" id="_load_box_pl_<? echo $arr[$i][0][0]; ?>"></span></div>
                        <!-- End playlist ADD -->
                        <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                </div>
            <? } ?>
            </div>
            </div>

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
        <!--3
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
		
  <!--3
        <div id="m_3">
        <?=BANNER('play_right','345');?>
            <div class="box w_3">
            <h1>Album nghe nhiều tháng <? echo date("m");?></h1>
<?php
$album_hot = $tgtdb->databasetgt(" album_name, album_singer, album_img, album_viewed, album_id ","album"," album_cat = '".$album[0][8]."' ORDER BY album_viewed_month DESC LIMIT 5");
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
        </div>		-->
        <div class="clr"></div>
    </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>