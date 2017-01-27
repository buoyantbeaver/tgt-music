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
if(isset($_GET["id"])) $id_media = $myFilter->process($_GET['id']);
$id_media	=	del_id($id_media);
mysql_query("UPDATE tgt_nhac_data SET m_viewed = m_viewed+".NUMPLAY.", m_viewed_month = m_viewed_month+".NUMPLAY." WHERE m_id = '".$id_media."'");
//$cache = new cache();
//if ( $cache->caching ) {
$song 		= $tgtdb->databasetgt(" m_title, m_singer, m_cat, m_img, m_url, m_viewed, m_lyric, m_kbs, m_sang_tac,  m_lyricLRCNCT, m_lyricLRC, m_lyricKAR, m_lyricZSTAR ","data"," m_id = '".$id_media."' ORDER BY m_id DESC ");
$title 		= get_data("singer","singer_name"," singer_id = '".$song[0][1]."'");
$song_url 	= url_link($song[0][0].'-'.$title,$id_media,'nghe-bai-hat');
$song_url_1 	= url_link_mobile($song[0][0].'-'.$title,$id_media,'nghe-bai-hat');
$user 		= 	get_user($song[0][4]);
$user_url 	= url_link('user',$song[0][4],'user');
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($title).'&ks=singer';
$st_name 	= $song[0][8];
$st_url 	= 'tim-kiem/bai-hat.html?key='.text_s($st_name).'&ks=composer';

$singer_img		= get_data("singer","singer_img"," singer_id = '".$song[0][1]."'");
$singer_img		= check_img($singer_img);
$singer_info	= text_tidy(un_htmlchars(get_data("singer","singer_info"," singer_id = '".$song[0][1]."'")));
$lyric_info		= text_tidy(un_htmlchars($song[0][6]));
$download 		= 'down.php?id='.del_id($id).'&key='.md5(del_id($id).'tgt_music');
$lyricLRCNCT = str_replace("'", " ", un_htmlchars($song[0][9]));
//Kiem tra xem co duong dan den file .lrc khong
$lyricLRC = str_replace("'", " ", un_htmlchars($song[0][10]));
$lyricKAR = str_replace("'", " ", un_htmlchars($song[0][11]));
$lyricZSTAR = str_replace("'", " ", un_htmlchars($song[0][12]));
$song_url_karaoke = '';
$song_url_karaoke = url_link($song[0][0].'-'.$title,$id_media,'nghe-bai-hat-nct');
//duong link den trang dung APlayer: them vao file tgt/box.php tuy chon nghe-bai-hat-lrc
$song_url_karaoke_lrc = url_link($song[0][0].'-'.$title,$id_media,'nghe-bai-hat-lrc');
//duong link den trang dung AS3 Flash Karaoke: them vao file tgt/box.php tuy chon nghe-bai-hat-kar
$song_url_karaoke_as3 = url_link($song[0][0].'-'.$title,$id_media,'nghe-bai-hat-kar');
$song_url_karaoke_zstar = url_link($song[0][0].'-'.$title,$id_media,'nghe-bai-hat-zstar');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="<? echo un_htmlchars($song[0][0]).' - '.un_htmlchars($title); ?>" />
<meta name="description" content="<? echo un_htmlchars($song[0][0]);?> do ca sĩ <? echo un_htmlchars($title);?> trình bày, lời bài hát <? echo un_htmlchars($song[0][0]);?>. Nghe, tải bài hát <? echo un_htmlchars($song[0][0]);?>..." />
<meta name="keywords" content="<? echo $song[0][0];?>, Bài hát, <? echo un_htmlchars($title);?>, ca sĩ, <? echo un_htmlchars($title);?>, sáng tác, thể loại, <? echo GetCAT($song[0][2]);?>" />
<base href="<? echo SITE_LINK ?>" />
<title><? echo un_htmlchars($song[0][0]).' - '.un_htmlchars($title); ?></title>
<meta property="og:url"           content="<? echo $song_url; ?>" />
<meta property="og:type"          content="mp3.nguyenthanhdoan.com" />
<meta property="og:title"         content="<? echo un_htmlchars($song[0][0]).' - '.un_htmlchars($title); ?>" />
<meta property="og:description"   content="<? echo un_htmlchars($song[0][0]);?> do ca sĩ <? echo un_htmlchars($title);?> trình bày, lời bài hát <? echo un_htmlchars($song[0][0]);?>. Nghe bài hát <? echo un_htmlchars($song[0][0]);?>..." />
<meta property="og:image"         content="<? echo SITE_LINK ?><? echo $song[0][3];?>" />
<? include("./theme/ip_java.php");?>
<script type="text/javascript">
(function(a,b){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))window.location=b})(navigator.userAgent||navigator.vendor||window.opera,'<? echo $song_url_1; ?>');
</script>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_play_mp3','1006');?></div>
    <div id="contents">
        <!--4-->
        <div id="m_4">

                	<div class="play_info">
<h1><? echo un_htmlchars($song[0][0]);?> - <span class="singer_"><a href="<? echo $singer_url;?>" title="Bài hát của ca sĩ <? echo $title;?>"><? echo un_htmlchars($title);?></a></span></h1>
  			<h2>Sáng tác : <span class="singer_"><? echo check_data($st_name);?></span> | Thể loại: <? echo GetTheLoai($song[0][2]);?> | <? echo check_kbs($song[0][7]);?> | Lượt nghe: <? echo number_format($song[0][5]);?></h2>
			<!--nghe ca khuc bang as3 karaoke player-->
<?if(strlen($lyricLRCNCT)>5){?>
			<h4 align="center"><a href="<? echo $song_url_karaoke;?>" title="">nghe ca khúc: "<? echo un_htmlchars($song[0][0]);?>" bằng NCT Karaoke Flash Player</a></h4>
<?}?>
<?if(strlen($lyricLRC)>5){?>
			<h4 align="center"><a href="<? echo $song_url_karaoke_lrc;?>" title="">nghe ca khúc: "<? echo un_htmlchars($song[0][0]);?>" bằng APlayer HTML5 Karaoke</a></h4>
<?}?>
<?if(strlen($lyricKAR)>5){?>
			<h4 align="center"><a href="<? echo $song_url_karaoke_as3;?>" title="">nghe ca khúc: "<? echo un_htmlchars($song[0][0]);?>" bằng AS3 Flash Karaoke</a></h4>
<?}?>
<?if(strlen($lyricZSTAR)>5){?>
			<h4 align="center"><a href="<? echo $song_url_karaoke_zstar;?>" title="nghe ca khúc: &#34;<?=un_htmlchars($song[0][0]);?>&#34; bằng ZingStar Flash Karaoke Player Player">nghe ca khúc: "<? echo un_htmlchars($song[0][0]);?>" bằng ZingStar Flash Karaoke Player</a></h4>
<?}?>

                    </div>
					<?=BANNER('play_mp3','633');?>

<!--<audio id="audio" controls="controls">
    <source id="mp3Source" src="<? echo SITE_LINK ?>play.php?url=<?php echo $song[0][4];?>" type="audio/mp3"></source>
</audio>

<ul style="list-style: none">
    <li>
        <ul>
            <li id="song1"><button onclick="updateSource(1)">128</button></li>            
			<li id="song1"><button onclick="updateSource(2)">320</button></li>
			<li id="song1"><button onclick="updateSource(3)">Lossless</button></li>
        </ul>
    </li>
</ul>
<script>
function updateSource(type) { 
        var audio = document.getElementById('audio');
        audio.src='play.php?url=<?php echo $song[0][4];?>&type=' + type;
        audio.load();
        audio.play();
    }
</script>-->

         
					<!--<div class="player">
<iframe scrolling="no" width="100%" height="186" src="http://mp3.zing.vn/embed/song/<? echo $song[0][4];?>?start=true" frameborder="0" allowfullscreen="true"></iframe>-->					
<!--<object id="flashplayer" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="84">
<param name="movie" value="player.swf" />
<param name="allowFullScreen" value="true" />
<param name="allowScriptAccess" value="always" />
<param name="FlashVars" value="plugins=plugins/proxy.swf&proxy.link=<? echo $song[0][4];?>" />
<embed name="flashplayer" src="player.swf" FlashVars="plugins=plugins/proxy.swf&autostart=true&proxy.link=<? echo $song[0][4];?>" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="100%" height="84" />
</object>

<audio controls>
   <source src="http://docs.google.com/uc?export=open&id=0Bwd-Z7VDrCl8Tkk3SnlsZUNBYUE" type="audio/mp3">
   <p>Your browser does not support HTML5 audio :(</p>
</audio> -->

<div class="player">
<div id='myElement'>Loading the player ...</div>
<script type='text/javascript'>
var playerInstance = jwplayer('myElement');
playerInstance.setup({
  playlist: "<? echo SITE_LINK; ?>xml/2/<? echo en_id($id_media);?>.xml",
  autostart: true,
  controls: true,
  repeat: true,
  width: '100%',
  height: 360
});
</script>
</div>

            <!-- begin shared -->
            <ul class="idTabs list_shared">
            	<li class="selected"><a class="_Embed" href="#_Embed">Chia sẻ</a></li>
            	<li><a class="_Add" href="#_Add">Thêm</a></li>
                <li><a class="_Error" href="#_Error">Báo lỗi</a></li>
                <li><a class="_Download" href="<?=$download;?>" target="_blank">Tải nhạc</a></li>
                <div class="fb-like" 
		data-href="<?=FACE_PAGE;?>" 
		data-layout="button_count"
                data-action="like"
                data-show-faces="false"
		data-share="false">
		</div>
                <!--<li><a class="_Cm" href="http://mp3.zing.vn/embed/song/<? echo $song[0][4];?>?start=true" target="_blank">Nguồn: Zing Mp3</a></li>-->
            </ul>
            <div class="clr"></div>
            <div id="_Embed" class="box_">
                    <table width="100%" cellpadding="2">
<div class="goodshare-color">
      <a href="#" class="goodshare" data-type="fb">Facebook</a> 
      <a href="#" class="goodshare" data-type="tw">Twitter</a> 
      <a href="#" class="goodshare" data-type="gp">Google+</a> 
      <a href="#" class="goodshare" data-type="li">LinkedIn</a> 
      <a href="#" class="goodshare" data-type="tm">tumblr</a> 
      <a href="#" class="goodshare" data-type="pt">Pinterest</a> 
      <a href="#" class="goodshare" data-type="bl">Blogger</a>
    </div>
                </table>
            </div>
            <div id="_Add" class="box_">
                <div class="one-three">
                <p align="center">Thêm vào danh sách yêu thích</p>
                <p align="center"><a onclick="AddFAV(<?=$id_media;?>,1);" class="_add_" id="0">Yêu thích</a></p>
                </div>
                <div class="one-three padding-left10">
                    <p align="center">Thêm vào Playlist của bạn</p>
                    <p align="center"><select class="select" id="_lstPls" style="width: 150px;">

<?
$farr = $tgtdb->databasetgt(" album_id, album_name ","album"," album_poster = '".$_SESSION["tgt_user_id"]."' AND album_type = 1 ORDER BY album_name ASC");
for($z=0;$z<count($farr);$z++) {
?>
                    <option value="<?=$farr[$z][0];?>"><?=$farr[$z][1];?></option>
<? } ?>
                    </select>
                    <a class="_add_" id="_addPls" onclick="_lstPlsAdd(<?=$id_media;?>);">Thêm</a></p>
                </div>
                
                <div class="one-three padding-left10 fjx">
                    <p align="center">Tạo một playlist mới</p>
                    <p align="center"><input type="text" style="width: 100px;" id="_playlist_name_<?=$id_media;?>" value="">
                    <a onclick="_CREATPLAYLIST(<?=$id_media;?>,1);" class="_add_">Tạo mới</a>
                    </p>
                </div>
                <div class="clr"></div>
                <div id="_Add2"></div>
            </div>
            <div id="_Error" class="box_">
            <div align="center" style="margin-bottom: 10px;">Thông báo lỗi bài hát, các vấn đề phát sinh.</div>
            <form method="post">
            <input type="hidden" id="media_id" value="<? echo $id_media;?>" /><input type="hidden" id="type" value="1" />
            <div align="center" id="ERCT" class="none"><textarea name="txtContent" rows="7" cols="20" id="txtContent" style="width:343px; margin-bottom: 10px;"></textarea></div>
            <div align="center">
<select class="select" id="drlReason" name="drlReason"><option value="0">Vui lòng chọn nguyên nhân</option><optgroup label="Vấn đề về kỹ thuật"><option value="Bài hát không play được">Bài hát không play được</option><option value="Bài hát có chất lượng kém">Bài hát có chất lượng kém</option><option value="1">Khác</option></optgroup><optgroup label="Vấn đề về nội dung"><option value="Bài hát có nội dung khiêu dâm, thô tục">Bài hát có nội dung khiêu dâm, thô tục</option><option value="Bài hát có nội dung bạo lực">Bài hát có nội dung bạo lực</option><option value="Bài hát có nội dung phản động, kích động thù địch">Bài hát có nội dung phản động, kích động thù địch</option><option value="1">Khác</option></optgroup></select>
<input type=button value="Gửi đi" class="_add_" onclick="SendError();"/>
             </div>
            </form>
            <div class="margin-top10 error_yeu_thich none"></div>
            </div>
          <!--  <div id="_Download" class="box_" align="center">
Link get https://drive.google.com/uc?export=download&id=ID
            <a class="_add_" href="https://drive.google.com/uc?export=download&id=0Bwd-Z7VDrCl8Q1FKQzM1enFETDQ">Tải 320kb/s</a>
            <a class="_add_" href="<?=$download;?>" target="_blank">Tải Lossless(FLAC)</a>
            </div>-->
		   <!-- end shared -->
            <!-- album -->
<? if($lyric_info) { ?>
<div id="_lyricContainer" class="w_4">
		<h3><strong><span class="seo">Lời bài hát </span><?=un_htmlchars($song[0][0]);?></strong></h3>
		<p id="lyric_load" class="_lyricContent rows4"><?=$lyric_info;?></p>
	 <div class="iLyric"><a class="_viewMore" onclick="LYRICSHOWHIDE(1);">Xem toàn bộ</a></div>
</div>
<? } ?>
<? if($singer_info) { ?>
            <div class="box w_4">
            	<h1>Thông tin ca sĩ <?=$title ;?><a onclick="SINGERSHOWHIDE();" id="singer_txt"> Xem thông tin</a></h1>
                <div id="singer_info" class="singer_info none">
                    <div class="info_singer" id="LoadSingerInfo"><?=$singer_info;?></div>
                    <div class="img_singer"><img class="img" src="<?=check_img($singer_img);?>" /></div>
                    <br class="clr" />
                </div>
            </div>
<? } ?>
<?
// album cung ca si
$arrz = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat ","album"," album_singer = '".$song[0][1]."' ORDER BY RAND() LIMIT 4");
if($arrz) {
?>
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
$arrz = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img, m_cat ","data"," m_singer = '".$song[0][1]."' AND m_type = 2 ORDER BY RAND()
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
<div class="fb-comments" data-href="<? echo $song_url; ?>" data-numposts="5" data-width="640" data-colorscheme="light"></div>
</div>
<!-- end binh luan -->
        </div>
        <!--3-->
        <div id="m_3">
        	<?=BANNER('play_right','345');?>
            <div class="box w_3">
            <h1>Bài hát cùng ca sĩ</h1>
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type ","data"," m_singer = '".$song[0][1]."' AND m_type = 1 ORDER BY RAND() LIMIT 10");
for($z=0;$z<count($arr);$z++) {
$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$song_url = url_link($arr[$z][1],$arr[$z][0],'nghe-bai-hat');
?>
        <div class="top_mp3">
        	<div class="x_1"><?=($z+1);?></div>
            <div class="x_2">
                <p class="song"><a class="sing_a" href="<? echo $song_url; ?>" title="Nghe bài hát <? echo $arr[$z][1]; ?>"><? echo un_htmlchars($arr[$z][1]); ?></a></p>
                <p class="singer">
        		<a class="singer" href="<? echo $singer_url; ?>" title="Bài hát của ca sĩ <? echo $singer_name; ?>"><? echo un_htmlchars($singer_name); ?></a></p>
            </div>
        <div class="clr"></div>
        
        </div>

<? } ?>
<div class="read_"><a class="read-more" href="tim-kiem/bai-hat.html?key=<? echo text_s($singer_name);?>&ks=singer">Xem thêm</a></div>
            </div>
        </div>

        <!--3-->
        <div id="m_3">
        	<?=BANNER('play_right','345');?>
            <div class="box w_3">
            <h1>Bài hát cùng thể loại</h1>
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type ","data"," m_cat = '".$song[0][2]."' ORDER BY RAND() LIMIT 10");
for($z=0;$z<count($arr);$z++) {
$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$song_url = url_link($arr[$z][1],$arr[$z][0],'nghe-bai-hat');
?>
        <div class="top_mp3">
        	<div class="x_1"><?=($z+1);?></div>
            <div class="x_2">
                <p class="song"><a class="sing_a" href="<? echo $song_url; ?>" title="Nghe bài hát <? echo $arr[$z][1]; ?>"><? echo un_htmlchars($arr[$z][1]); ?></a></p>
                <p class="singer">
        		<a class="singer" href="<? echo $singer_url; ?>" title="Bài hát của ca sĩ <? echo $singer_name; ?>"><? echo un_htmlchars($singer_name); ?></a></p>
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