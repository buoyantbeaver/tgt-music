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
if(isset($_GET["id"])) $id_media = $myFilter->process($_GET['id']);
$id_media	=	del_id($id_media);
mysql_query("UPDATE tgt_nhac_data SET m_viewed = m_viewed+".NUMPLAY.", m_viewed_month = m_viewed_month+".NUMPLAY." WHERE m_id = '".$id_media."'");
//$cache = new cache();
//if ( $cache->caching ) {
$song 		= $tgtdb->databasetgt(" m_title, m_singer, m_cat, m_img, m_poster, m_viewed, m_lyric, m_kbs, m_sang_tac ","data"," m_id = '".$id_media."' ORDER BY m_id DESC ");
$title 		= get_data("singer","singer_name"," singer_id = '".$song[0][1]."'");
$song_url 	= url_link_mobile($song[0][0].'-'.$title,$id_media,'nghe-bai-hat');
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
$url 		= 'down.php?id='.del_id($id).'&key='.md5(del_id($id).'tgt_music');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><? echo un_htmlchars($song[0][0]).' - '.un_htmlchars($title); ?> | <? echo $user; ?>  | <? echo GetCAT($song[0][2]);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="<? echo un_htmlchars($song[0][0]).' - '.un_htmlchars($title); ?> | <? echo $user; ?>  | <? echo GetCAT($song[0][2]);?>" />
<meta name="description" content="Bài hát <? echo un_htmlchars($song[0][0]);?> do ca sĩ <? echo un_htmlchars($title);?> trình bày, upload bởi <? echo $user;?> thuộc thể loại <? echo $cat;?>" />
<meta name="keywords" content="<? echo $song[0][0];?>, Bài hát, <? echo un_htmlchars($title);?>, ca sĩ, <? echo un_htmlchars($title);?>, sáng tác, thể loại, <? echo GetCAT($song[0][2]);?>, <? echo $user;?>" />
<meta name="language" content="vietnamese" />
<base href="<? echo SITE_LINK ?>mobile/" />
<link rel="canonical" href="" 
<meta name="author" content="" />
<meta name="copyright" content="" />
<meta name="robots" content="index, archive, follow, noodp" />
<meta name="googlebot" content="index,archive,follow,noodp" />
<meta name="msnbot" content="all,index,follow" />
<link rel="image_src" href="<? echo $singer_img;?>" />
<link rel="video_src" href="<? echo SITE_LINK.'flash/mp3/'.en_id($id_media).'.swf'; ?>" />
<meta name="video_width" content="360" />
<meta name="video_height" content="84" />
<meta name="video_type" content="application/x-shockwave-flash" />
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />  
<!--
<link href="../theme/css/styles.css" rel="stylesheet" type="text/css" />
<link href="../theme/css/skin.css" rel="stylesheet" type="text/css" />
<link href="script/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="theme/js/ichphienpro.js"></script>
-->
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
<script type="text/javascript" src="js/core.0.1.js"></script>
<script type="text/javascript" src="js/flash_detect.0.1.js"></script>  
<script type="text/javascript" src="js/html5-player.0.1.js"></script>
<script type="text/javascript" src="js/exec.0.1.js"></script>
<script type="text/javascript" src="script/antt.js"></script>
<script type="text/javascript" src="script/jquery.min.js"></script>
<link href="css/screen.0.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
</head>
    <body>
        <div class="header">
            <h1 class="logo">
                <a href="<? echo SITE_LINK ?>mobile" title="IPOS 1.0 Mobile"><img src="images/logo.gif" alt="NhacCuaTui.Com" width="68" height="37" border="0" /></a>
            </h1>
            <span><a href="<? echo SITE_LINK ?>mobile/tim-kiem" title="Tìm kiếm"><img alt="Tìm kiếm" src="images/search.png" width="43" height="37" border="0" /></a></span>
            <span><a href="<? echo SITE_LINK ?>mobile/danh_muc" title="Danh mục"><img alt="Danh mục" src="images/list.png" width="43" height="37" border="0" /></a></span>                      
            <span><a href="<? echo SITE_LINK ?>mobile/login" title="Đăng nhập"><img alt="Đăng nhập" src="images/user.png" width="43" height="37" border="0" /></a></span>
        </div>          
		<!--Top Menu -->
        <div class="topmenu"> 
            <a href="<? echo SITE_LINK ?>mobile" class="home " title="TGT"></a>
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html" class="active"  title="Bài hát">Bài hát</a> 
            <a href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html"  title="Playlist">Playlist</a>              
            <a href="the-loai-video/Nhac-Tre/EZEFZOB.html"  title="MV">MV</a>
            
        </div>
<?php
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); $id = del_id($id);
$arr = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local, m_lyric ","data"," m_id = '".$id."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'"));
$xml = grab(get_url($arr[0][4],$arr[0][1]));
?>		
<div class="player-song">
    <h2>
        <img src="images/ico-m.gif" width="13" height="13" border="0"> <? echo un_htmlchars($song[0][0]);?></h2>
    <p>
        <img src="images/ico-singer.gif" width="12" height="11" border="0"> <a href="<? echo $singer_url;?>" title="Bài hát của ca sĩ <? echo $title;?>"><? echo un_htmlchars($title);?></a>
        <span><img src="images/ico-kb.gif" width="12" height="12" border="0"> 128kb/s</span>  
        <span><img src="images/ico-head.gif" width="11" height="11" border="0"> <? echo number_format($song[0][5]);?></span>
    </p> 

	<div class="player">
        <div class="hide-html5">
            <audio id="audio" controls="controls">	
                <source src="<? echo $xml;?>" type="audio/mpeg">
            </audio>
        </div> 
        <div id="play" class="play control">
        </div> 
        <div id="progress">
            <div id="progress_box">
                <div id="load_progress" style="width:0px;">
                    <div class="hand-control" id="hand_progress" style="left:-7px;">
                    </div>
                    <div id="play_progress" style="width:0px;">
                    </div>
                </div>
            </div>
        </div>
        <div id="play_time"> 
            <span id="current_time_display">00:00</span>
        </div>
    </div>
    <script type="text/javascript">
        bodyLoaded();
        document.getElementById("audio").addEventListener("ended",
                function() {
                    playAudio();
                }, false);
    </script>

    <div style="color:Red;text-align:center;padding:3px 0px;display:none;" id="notlogin"></div>
    <div class="pdlike">
        <input type="hidden" value="9Fd4zVvPMIbf" id="hdSong" />
        <input type="hidden" value="http%3A%2F%2Fm.nhaccuatui.com%2Fbai-hat%2Fem-cua-ngay-hom-qua-son-tung-m-tp.9Fd4zVvPMIbf.html" id="hdUrlCallback" />
        <!--<span>Đăng bởi: <a title="Tìm kiếm theo totti123456" href="http://m.nhaccuatui.com/tim-kiem?q=totti123456&amp;b=user">totti123456</a></span>  	-->
        <a title="Tải bài hát" target="_blank" href="<?=$download;?>">
            <input type="button" value="Tải bài hát" />
        </a>      
    </div>
</div>

<p class="noteRing"><strong></strong> <strong></strong></p>
<!--Tag -->
<div class="tag-main" id="tag-song">
    <a title="Bài hát liên quan" href="javascript:;" onclick="showRelatedSong(this);" class="active">Bài hát cùng ca sĩ</a>
    <a title="Lời bài hát" href="javascript:;" onclick="showLyric(this);">Lời bài hát</a>
</div>
<!--List song -->
<div id="relatedSong" style="display: block;">
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_type ","data"," m_singer = '".$song[0][1]."' AND m_type = 1 ORDER BY RAND() LIMIT 10");
for($z=0;$z<count($arr);$z++) {
$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$song_url = url_link_mobile($arr[$z][1],$arr[$z][0],'nghe-bai-hat');
?>
    <div class="row bgmusic ">
    <h3><a href="<? echo $song_url; ?>" title="Nghe bài hát <? echo $arr[$z][1]; ?>"><? echo un_htmlchars($arr[$z][1]); ?></a></h3> 
    <p><img src="images/ico-singer.gif" width="12" height="11" border="0" alt="<? echo $singer_name; ?>"/> <? echo $singer_name; ?> <span><img src="images/ico-head.gif" width="11" height="11" border="0" alt="<? echo number_format($song[0][5]);?> lượt nghe"/> <? echo number_format($song[0][5]);?></span></p>
</div>
<? } ?>

    <div class="more"><a href="#" title="Xem thêm">Xem thêm <img alt="Xem thêm" src="images/ico-more.gif" width="10" height="10" border="0" align="absmiddle" /></a></div>
</div>
<? if($lyric_info) { ?>
<div id="lyricSong" style="display: none;">
    <div class="lyric">
<br /><?=$lyric_info;?>
    </div>
<? } ?>
    
    
</div>
<!--Account -->
<div class="account">
</div>

<!--Footer -->
    <? include("./skin/ip_footer.php");?>
</body>
</html>