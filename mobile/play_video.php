<?php
#####################################
#    	IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
include("../tgt/ajax.php");
include("../tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_media = $myFilter->process($_GET['id']); $id_media	=	del_id($id_media);
mysql_query("UPDATE tgt_nhac_data SET m_viewed = m_viewed+".NUMPLAY.", m_viewed_month = m_viewed_month+".NUMPLAY." WHERE m_id = '".$id_media."'");
$song = $tgtdb->databasetgt(" m_title, m_singer, m_cat, m_img, m_poster, m_viewed, m_lyric, m_time, m_url ","data"," m_id = '".$id_media."' ORDER BY m_id DESC ");
$title = get_data("singer","singer_name"," singer_id = '".$song[0][1]."'");
$singer_img = get_data("singer","singer_img"," singer_id = '".$song[0][1]."'");
$song_url = url_link_mobile($song[0][0].'-'.$title,$id_media,'xem-video');
$user_name = get_user($song[0][4]);
$user_url = url_link('user',$song[0][4],'user');
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($title).'&ks=singer';
$download 		= 'down.php?id='.$id_media.'&key='.md5($id_media.'tgt_music');
$singer_info	= text_tidy(un_htmlchars(get_data("singer","singer_info"," singer_id = '".$song[0][1]."'")));
$user 		= 	get_user($song[0][4]);
$user_url 	= url_link('user',$song[0][4],'user');
$url = $song[0][8];
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
<link rel="image_src" href="http://nhac.topgiaitri.com/vn/img_album/tgt_mp3.jpg" />
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<link href="css/screen.0.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
</head>
<body>
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
            <a href="<? echo SITE_LINK ?>mobile" class="home " title="IPOS 1.0 Mobile"></a>
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html"  title="Bài hát">Bài hát</a> 
            <a href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html"  title="Playlist">Playlist</a>              
            <a href="the-loai-video/Nhac-Tre/EZEFZOB.html" class="active" title="MV">MV</a>
            
        </div>
        <!--Search -->
        
        <div class="search" id="search">
            <div class="bgsearch">
                <div class="pd-input">
                    <input type="text" value="" class="input-search" onkeypress="return searchKeyPress(event);" id="txtSearchkey" name="txtSearchkey">
                    <input type="button" class="btn-search" onclick="search();
                return false;" id="btnSearch">
                </div>
            </div>
        </div>
<?php
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); $id = del_id($id);
$arr = $tgtdb->databasetgt(" m_id, m_url, m_title, m_img, m_singer, m_is_local, m_lyric ","data"," m_id = '".$id."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'"));
$xml = grab(get_url($arr[0][4],$arr[0][1]));
$video_img		= check_img($arr[0][3]);
?>	

<div class="player-song">
    <h2>
        <img src="./nct/ico-m.gif" width="13" height="13" border="0"> <? echo un_htmlchars($song[0][0]);?></h2>
    <p>
        <img src="./nct/ico-singer.gif" width="12" height="11" border="0"> <a href="<? echo $singer_url;?>" title="Bài hát của ca sĩ <? echo $title;?>"><? echo un_htmlchars($title);?></a>
        <span><img src="./nct/ico-kb.gif" width="12" height="12" border="0"> 128kb/s</span>  
        <span><img src="./nct/ico-head.gif" width="11" height="11" border="0"> <? echo number_format($song[0][5]);?></span>
    </p>  
	<div class="player-video">
     <div class="screen">
            <video width="100%" id="audio" controls="controls" poster="<? echo check_img($arr[0][3]);?>">
                <source src="<? echo $xml;?>" type="video/mp4">
            </video>
        </div>
    </div>
    <script type="text/javascript">
        document.getElementById("audio").addEventListener("ended",
                function() {
                    document.getElementById("audio").play();
                }, false);
    </script>
                </div>
            </div>
</div>
    <div style="color:Red;text-align:center;padding:3px 0px;display:none;" id="notlogin"></div>
    <div class="pdlike">
        <input type="hidden" value="nmhS641Gw3ef" id="hdSong" />
        <input type="hidden" value="http%3A%2F%2Fm.nhaccuatui.com%2Fbai-hat%2Fmot-nguoi-phia-sau-nguyen-duc-tung-ft-linh-rin.nmhS641Gw3ef.html" id="hdUrlCallback" />
        <span>Đăng bởi: <a title="Tìm kiếm theo " href="#">tgt_user</a></span>  	
        
            <div id="_Download" class="box_" align="center"><a class="_add_" href="<?=$download;?>" target="_blank">
            <input type="button" value="Tải bài hát" /></a></div>       
    </div>
</div>
<!--Tag -->
<div class="tag-main" id="tag-song">
    <a title="Bài hát liên quan" href="javascript:;" onclick="showRelatedSong(this);" class="active">Video liên quan</a>
</div>

<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_img, m_singer, m_type, m_viewed, m_downloaded ","data"," m_cat = '".$song[0][2]."' AND m_type = 2 ORDER BY m_id DESC LIMIT 8");

for($i=0;$i<count($arr);$i++) {
	$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$i][3]."'");
	$song_title		= un_htmlchars($arr[$i][1]);
	$video_img		= check_img($arr[$i][2]);
	$song_url 		= url_link($arr[$i][1],$arr[$i][0],'nghe-bai-hat');
	$video_url 		= url_link_mobile($arr[$i][1],$arr[$i][0],'xem-video');
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$checkhq		= check_song($arr[$i][5],$arr[$i][6]);
	$download 		= 'down.php?id='.$arr[$i][0].'&key='.md5($arr[$i][0].'tgt_music');
	$stt			= $i+1;
	// 1
	if($num == 1 || $num == 2 || $num == 3) { 
		if($stt	< 4)	$classb[$i]	=	"fjx";

			
	}
?>
        
<div class="row ">
    <div class="img-80"><span class="icon"></span><a href="<? echo $video_url; ?>"><img src="<? echo $video_img; ?>" width="80" height="45" border="0"></a></div>
    <div class="txt-80">
        <h3><a href="<? echo $video_url; ?>"><? echo un_htmlchars($arr[$i][1]); ?></a></h3> 
        <p><img src="./nct/ico-singer.gif" width="12" height="11" border="0"> <a href="<?=$singer_url; ?>" title="Bài hát của ca sĩ <?=$singer_name; ?>"><?=un_htmlchars($singer_name);?></a><span><img src="./nct/ico-head.gif" width="11" height="11" border="0"> <? echo number_format($arr[$i][5]); ?></span></p>
    </div>
</div>
<? } ?>
    <div class="more"><a href="#" title="Xem thêm">Xem thêm <img alt="Xem thêm" src="http://stc.m.nixcdn.com/images/ico-more.gif" width="10" height="10" border="0" align="absmiddle" /></a></div>
</div>
        </div>
		
        <div class="clr"></div>
    </div>
<? if($lyric_info) { ?>
<div id="_lyricContainer" style="display: none;">
	 <div class="lyric"><?=$lyric_info;?>
</div>
<? } ?>   
</div>
<div id="fbComment" style="display: none;">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
            return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=";
            fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
            (function() {
            var po = document.createElement('script');
                    po.type = 'text/javascript';
                    po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(po, s);
            })();</script>
    <script type="text/javascript">
                                var str = '<fb:comments href="' + window.location.href.replace(NCTInfo.ROOT_URL, "http://www.nhaccuatui.com/") + '" colorscheme="light" numposts="10"></fb:comments>';
                                document.write(str);</script>
</div>
<!--Account -->
<div class="account">
</div>
<!--Footer -->
<div class="footer">
    <p><a href="#" title="Mobile">Mobile</a>  |  <a href="#" rel="nofollow" title="Desktop">Desktop</a></p>
    Copyright © 2014 TGT Mobile
</div>
<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-273986-27']);
        _gaq.push(['_trackPageview']);

        _gaq.push(['nct._setAccount', 'UA-273986-19']);
        _gaq.push(['nct._setDomainName', 'nhaccuatui.com']);
        _gaq.push(['nct._trackPageview']);
        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
</script>
</body>
</html>