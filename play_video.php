<?php
#####################################
#    	IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_media = $myFilter->process($_GET['id']); $id_media	=	del_id($id_media);
mysql_query("UPDATE tgt_nhac_data SET m_viewed = m_viewed+".NUMPLAY.", m_viewed_month = m_viewed_month+".NUMPLAY." WHERE m_id = '".$id_media."'");
$song = $tgtdb->databasetgt(" m_title, m_singer, m_cat, m_img, m_poster, m_viewed, m_lyric, m_time, m_url, m_is_local ","data"," m_id = '".$id_media."' ORDER BY m_id DESC ");
$title = get_data("singer","singer_name"," singer_id = '".$song[0][1]."'");
$singer_img = get_data("singer","singer_img"," singer_id = '".$song[0][1]."'");
$song_url = url_link($song[0][0].'-'.$title,$id_media,'xem-video');
$user_name = get_user($song[0][4]);
$user_url = url_link('user',$song[0][4],'user');
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($title).'&ks=singer';
$download 		= 'down.php?id='.$id_media.'&key='.md5($id_media.'tgt_music');
$singer_info	= text_tidy(un_htmlchars(get_data("singer","singer_info"," singer_id = '".$song[0][1]."'")));
$user 		= 	get_user($song[0][4]);
$user_url 	= url_link('user',$song[0][4],'user');
$url = $song[0][8];
$song_link = grab(get_url($song[0][9],$song[0][8]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="Video <? echo $song[0][0].','.$title; ?>, <? echo $user_name; ?> , <? echo GetCAT($song[0][2]);?>" />
<meta name="description" content="Video <? echo $song[0][0];?> do ca sĩ <? echo $title;?> trình bày, upload bởi <? echo $user_name;?> thuộc thể loại <? echo GetCAT($song[0][2]);?>" />
<meta name="keywords" content="<? echo $song[0][0];?>, Video, <? echo $title;?>, ca sĩ, <? echo $title;?>, sáng tác, thể loại, <? echo GetCAT($song[0][2]);?>, <? echo $user_name;?>" />
<base href="<? echo SITE_LINK ?>" />
<title>Video <? echo $song[0][0].' - '.$title; ?> | <? echo $user_name; ?>  | <? echo GetCAT($song[0][2]);?></title>

<link rel="image_src" href="<? echo $song[0][3];?>" />
<link rel="video_src" href="<? echo SITE_LINK.'flash/video/'.en_id($id_media).'.swf'; ?>" />
<meta name="video_width" content="360" />
<meta name="video_height" content="304" />
<meta name="video_type" content="application/x-shockwave-flash" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_play_video','1006');?></div>
    <div id="contents">
        <!--4-->
        <div id="m_4">
        	<div id="v_load_x1">
                <div class="play_info">
                        <h4><? echo $song[0][0];?> - <span class="singer_"><a href="<? echo $singer_url;?>" title="Bài hát của ca sĩ <? echo $title;?>"><? echo $title;?></a></span></h4>
                <p>Thể loại:  <? echo GetTheLoai($song[0][2],'video');?> | Lượt xem: <? echo number_format($song[0][5]);?></p>
                </div>

				<div class="player border boxsd">
				<div id="mediaplayer"></div>
					<script type="text/javascript" src="<? echo SITE_LINK; ?>tgt_file/jwplayer.js"></script>
					<script type="text/javascript">
					//<![CDATA[
					jwplayer("mediaplayer").setup({
					'flashplayer': '<? echo SITE_LINK; ?>tgt_file/jw_player.swf',
					'file': '<? echo $song_link;?>',
					//'playlist': 'bottom',
					//'playlistsize': '50',
					//'autoscroll': 'false',
					'bufferlength': '1',
					'mute': 'false',
					'controlbar': 'bottom',
					'width': '100%',
					'height': '400',
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
					'logo.file':'<? echo SITE_LINK; ?>/tgt_file/skin_img/logo.png',
					'logo.hide' : 'false',
					'logo.position' : 'top-right',
					'logo.timeout': '10',
					//'plugins': {
					// 'gapro-2': {}
					//},
					'plugins': {

					},
					events: {
					onPlaylistItem: function(event) { var currentItem = jwplayer().getPlaylistItem();}
					,onError: function(){playlistOnError(jwplayer())}}
					});
					//]]>
					</script> 
									</div>
				
            </div>
            <!-- begin shared -->
            <ul class="idTabs list_shared">
            	<li class="selected"><a class="_Embed" href="#_Embed">Chia sẻ</a></li>
            	<li><a class="_Add" href="#_Add" onclick="AddFAVVideo(<?=$id_media;?>);">Yêu thích</a></li>
                <li><a class="_Error" href="#_Error">Báo lỗi</a></li>
                <!--<li><a class="_Download" href="#_Download">Tải Video</a></li>-->
            </ul>
            <div class="clr"></div>
            <div id="_Embed" class="box_">
                    <table width="100%" cellpadding="2">
                    <tr><td width="100"><strong>Link nhạc:</strong></td><td><input class="in" type="text" value="<? echo $song_url; ?>" onclick='this.select();copy(this.value);'  readonly="1" /></td></tr>
                    
                    <tr><td><strong>Nhúng blog:</strong></td><td><input class="in" type="text" value="<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' align='middle'codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' height='60' width='305'><param name='movie' value='<? echo SITE_LINK.'flash/video/'.en_id($id_media).'.swf'; ?>'><param name='loop' value='false'><param name='menu' value='false'><param name='quality' value='high'><param name='scale' value='exactfit'><param name='bgcolor' value='#7B5DA5'><embed src='<? echo SITE_LINK.'flash/video/'.$id_media.'.swf'; ?>' loop='false' menu='false' quality='high' scale='exactfit' type='application/x-shockwave-flash' pluginspage=http://www.macromedia.com/go/getflashplayer height=60 width=300></object>" onclick='this.select();copy(this.value);'  readonly="1" /></td></tr>
                    <tr><td><strong>Nhúng forum:</strong></td><td><input class="in" type="text" value="[FLASH]<? echo SITE_LINK.'flash/video/'.en_id($id_media).'.swf'; ?>[/FLASH]" onclick='this.select();copy(this.value);'  readonly="1" /></td></tr>
                </table>
            </div>
            <div id="_Add" class="box_"></div>
            <div id="_Error" class="box_">
            <div align="center" style="margin-bottom: 10px;">Thông báo lỗi bài hát, các vấn đề phát sinh.</div>
            <form method="post">
            <input type="hidden" id="media_id" value="<? echo $id_media;?>" /><input type="hidden" id="type" value="1" />
            <div align="center" id="ERCT" class="none"><textarea name="txtContent" rows="7" cols="20" id="txtContent" style="width:343px; margin-bottom: 10px;"></textarea></div>
            <div align="center">
<select class="select" id="drlReason" name="drlReason"><option value="0">Vui lòng chọn nguyên nhân</option><optgroup label="Vấn đề về kỹ thuật"><option value="Video không play được">Video không play được</option><option value="Video có chất lượng kém">Video có chất lượng kém</option><option value="1">Khác</option></optgroup><optgroup label="Vấn đề về nội dung"><option value="Video có nội dung khiêu dâm, thô tục">Video có nội dung khiêu dâm, thô tục</option><option value="Video có nội dung bạo lực">Video có nội dung bạo lực</option><option value="Video có nội dung phản động, kích động thù địch">Video có nội dung phản động, kích động thù địch</option><option value="1">Khác</option></optgroup></select>
<input type=button value="Gửi đi" class="_add_" onclick="SendError();"/>
             </div>
            </form>
            <div class="margin-top10 error_yeu_thich none"></div>
            </div>
            <!--<div id="_Download" class="box_" align="center"><a class="_add_" href="<?=$download;?>" target="_blank">Click vào đây để tải video này</a></div>-->
            <!-- end shared -->
            <!-- album -->
<?
// album cung ca si
$arrz = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat ","album"," album_singer = '".$song[0][1]."' ORDER BY RAND() LIMIT 4");
if($arrz) {
?>
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
	<a href="<?=$album_url?>" title="<?=$arrz[$z][1];?> - <?=$singer_name;?>"><img alt="<?=$arrz[$z][1];?> - <?=$singer_name;?>" src="<?=$arrz[$z][3];?>"></a></p>
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
$arrz = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img, m_cat ","data"," m_singer = '".$song[0][1]."' AND m_id != '$id_media' AND m_type = 2 ORDER BY RAND()
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
	<a href="<?=$video_url?>" title="<?=$arrz[$z][1];?> - <?=$singer_name;?>"><img alt="<?=$arrz[$z][1];?> - <?=$singer_name;?>" src="<?=$arrz[$z][3];?>"></a></p>
    <p style="margin-top:10px;"><a href="<?=$video_url?>" title="<?=$arrz[$z][1];?> - <?=$singer_name;?>"><?=$arrz[$z][1];?></a></p>
</div>
<? } ?>
<div class="clr"></div>
<div class="read_"><a href="<?=$singer_url;?>" class="read-more">Xem thêm</a></div>
                </div>
            </div>
<? } ?>
<!-- begin binh luan -->
<div class="w_4">
<div class="fb-comments" data-href="<? echo $song_url; ?>" data-numposts="5" data-width="635" data-colorscheme="light"></div>
</div>
<!-- end binh luan -->
        </div>
        <!--3-->
        <div id="m_3">
        <?=BANNER('play_right','345');?>
            <div class="box w_3">
            <h1>Có thể bạn muốn xem ?</h1>
<?php
// co the ban muon xem
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type, m_img ","data"," m_cat = '".$song[0][2]."' AND m_type = 2 ORDER BY RAND() LIMIT 5");
for($z=0;$z<count($arr);$z++) {
$singer_name 	= 	get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
$singer_url		= 	'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$video_url 		= 	url_link($arr[$z][1],$arr[$z][0],'xem-video');
?>
        <div class="top_video">
        	<div class="x_2">
            <a href="<?=$video_url; ?>" title="<?=$arr[$z][1]; ?> - <?=$singer_name; ?>"><img alt="<?=$arr[$z][1]; ?> - <?=$singer_name; ?>" src="<?=$arr[$z][4];?>"></a></div>
            <div class="x_3">
                <p class="song"><a href="<?=$video_url; ?>" title="Xem video <?=$arr[$z][1]; ?>"><?=un_htmlchars($arr[$z][1]);?></a></p>
                <p class="singer">
        		<a href="<?=$singer_url; ?>" title="Bài hát của ca sĩ <?=$singer_name; ?>"><?=un_htmlchars($singer_name);?></a></p>
            </div>
        <div class="clr"></div>
        
        </div>

<? } ?>
<div class="read_"><a class="read-more" href="tim-kiem/bai-hat.html?key=<?=text_s($title);?>&ks=singer">Xem thêm</a></div>
            </div>
        
            <div class="box w_3">
            <h1>Video cùng thể loại</h1>
<?php
// cung the loai
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type, m_img ","data"," m_cat = '".$song[0][2]."' AND m_type = 2 ORDER BY m_id DESC LIMIT 5");
for($z=0;$z<count($arr);$z++) {
$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$video_url = url_link($arr[$z][1],$arr[$z][0],'xem-video');
?>
        <div class="top_video">
        	<div class="x_2">
            <a href="<?=$video_url; ?>" title="<?=$arr[$z][1]; ?> - <?=$singer_name; ?>"><img alt="<?=$arr[$z][1]; ?> - <?=$singer_name; ?>" src="<?=$arr[$z][4];?>"></a></div>
            <div class="x_3">
                <p class="song"><a href="<?=$video_url; ?>" title="Xem video <?=$arr[$z][1]; ?>"><?=un_htmlchars($arr[$z][1]);?></a></p>
                <p class="singer">
        		<a href="<?=$singer_url; ?>" title="Bài hát của ca sĩ <?=$singer_name; ?>"><?=un_htmlchars($singer_name);?></a></p>
            </div>
        <div class="clr"></div>
        
        </div>

<? } ?>
<div class="read_"><a class="read-more" href="tim-kiem/bai-hat.html?key=<?=text_s($title);?>&ks=singer">Xem thêm</a></div>
            </div>
        </div>
        
        
        <div class="clr"></div>
    </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>