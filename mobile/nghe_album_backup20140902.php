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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Album <? echo $album[0][1].' - '.$title; ?> | <? echo $user ?>  | Nghe - tải - chia sẻ nhạc | IPOS </title>
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
<meta property="og:image" content="images/logo_600x600.png"/>
<link rel="image_src" href="<? echo $singer_img;?>" />
<link rel="video_src" href="<? echo SITE_LINK.'flash/mp3/'.en_id($id_media).'.swf'; ?>" />
<meta name="video_width" content="360" />
<meta name="video_height" content="84" />
<meta name="video_type" content="application/x-shockwave-flash" />
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />  
<link href="./theme/css/styles.css" rel="stylesheet" type="text/css" />
<link href="./theme/css/skin.css" rel="stylesheet" type="text/css" />
<link href="script/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="theme/js/ichphienpro.js"></script>
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
<script type="text/javascript" src="js/core.0.2.js"></script>
<script type="text/javascript" src="js/flash_detect.0.1.js"></script>  
<script type="text/javascript" src="js/html5-player.0.1.js"></script>
<script type="text/javascript" src="js/exec.0.4.js"></script>
<script type="text/javascript" src="script/antt.js"></script>
<script type="text/javascript" src="script/jquery.min.js"></script>
<link href="css/screen.0.2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
</head>
<body>
    <body>
<div class="header">
            <h1 class="logo">
            </h1>
          
        </div>
        <!--Top Menu -->
        <div class="topmenu"> 
            <a href="#" class="home " title="TGT"></a>
            <a href="#"  title="Bài hát">Bài hát</a> 
            <a href="#"  class="active" title="Playlist">Playlist</a>  
            
            <a href="#"  title="MV">MV</a>
            
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
		


<div class="player-song">
    <div class="row">
        <div class="img-40">
            <a href="javascript:;" title="Đừng Cố Yêu (Single)">
                <img alt="Đừng Cố Yêu (Single)" src="<?=check_img($album[0][4]);?>" width="40" height="40" border="0" />
            </a>
        </div>
        <div class="txt-40">
            <h2><?=un_htmlchars($album[0][1]);?> - <?=$title;?></h2> 
            <p><img alt="445,354 lượt nghe" src="images/ico-head.gif" width="11" height="11" border="0" /> 445,354 &nbsp;&nbsp;&nbsp;<img alt="<?=SoBaiHat($album[0][10]);?> bài hát" src="images/ico-music.gif" width="11" height="11" border="0" /> <?=SoBaiHat($album[0][10]);?></p>
        </div>
    </div>
	<?php
		$myFilter = new InputFilter();
		if(isset($_GET["id"])) $id_album = $myFilter->process($_GET['id']);
							   $id_album = del_id($id_album);
		$album = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
		$s = explode(',',$album[0][0]);
		foreach($s as $x=>$val) {
		$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local ","data"," m_id = '".$s[$x]."'");
		$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));
		$xml = grab(get_url($arr[$x][0][4],$arr[$x][0][1]));
		}
	?>	
	  <script type="text/javascript" src="js/html5-player.0.1.js"></script>
    <script type="text/javascript">
        var index = 0;
        var songs = new Array();
        var titles = new Array();
        titles[0]="Đừng Cố Yêu";songs[0]="http://a.nixcdn.com/5ed0a3684d113624c14063932a0e7702/53242ce9/NhacCuaTui851/DungCoYeu-KhacViet-2978018.mp3";titles[1]="Anh Yêu Người Khác Rồi";songs[1]="http://stream1.nixcdn.com/9cac12babaac463ca8466e859e5de855/53242ce9/NhacCuaTui840/AnhYeuNguoiKhacRoi-KhacViet-2779198.mp3";titles[2]="Đừng Cố Yêu (Beat & Instrumental)";songs[2]="http://a.nixcdn.com/2fb9defe60001c2320d2e067d414e6a0/53242ce9/NhacCuaTui851/DungCoYeuBeatInstrumental-KhacViet-2978019.mp3";
        function changeSong(index)
        {
            audio.src = songs[index];
            setActiveSong(index);
            setNowPlayingSong(index);
            playAudio();
            return false;
        }
        ;
        function setNowPlayingSong(index) {
            if (index != 'undefined' && titles[index] != null) {
                document.getElementById("song-playing").innerHTML = titles[index];
            }
        }
        ;
    </script>	
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
        <input type="hidden" value="PQ7gl4xA81EF" id="hdPlaylist"/>
        <input type="hidden" value="http%3A%2F%2Fm.nhaccuatui.com%2Fplaylist%2Fdung-co-yeu-single-khac-viet.PQ7gl4xA81EF.html" id="hdUrlCallback" />
        <span>Đăng bởi: <a title="Tìm kiếm " href="">tgt_user</a></span>
        <script type="text/javascript">
            document.write('<a href="https://www.facebook.com/sharer/sharer.php?u='+window.location.href.replace("http://m.nhaccuatui.com/","http://www.nhaccuatui.com/")+'" target="_blank"><input type="button" value="Chia sẻ" /></a>');
        </script>
        
        <input type="button" value="Thích" id="btnLiked" onclick="userLikePlaylist('like');" />        
        
    </div>
</div>
<div class="noteRing"><strong></strong><strong></strong></div>
<div class="tag-main" id="tag-playlist">
    <a href="javascript:;" onclick="showSongPlaylist(this);" class="active" title="Bài hát">Bài hát trong album</a>
</div>
						<div id="songList">
    <div class="pd-playlist" id="listSong">

			
   <?php
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_album = $myFilter->process($_GET['id']);
					   $id_album = del_id($id_album);
$album = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
$s = explode(',',$album[0][0]);
foreach($s as $x=>$val) {
$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local ","data"," m_id = '".$s[$x]."'");
			$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));
            $singer_url 		= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
            $download 			= 'down.php?id='.$arr[$x][0][0].'&key='.md5($arr[$x][0][0].'tgt_music');
            $song_url 			= check_url_song($arr[$x][0][1].'-'.$singer_name,$arr[$x][0][0],$arr[$x][0][3]);
			$album_url_list 	= grab(get_url($arr[$x][0][4],$arr[$x][0][1]));
            ?>
        <div class="row ">
    <span class="ico-phone"></span>
    <h3>
        <a href="<? echo $album_url_list;?>" onclick="return changeSong('<? if($x == $st) echo 'hover';?>');" title=""><? echo un_htmlchars($arr[$x][0][2]); ?></a>
    </h3> 
    <p><? echo un_htmlchars($singer_name); ?></p> 
</div>
            <? } ?>
			


</div></div>



<!--Account -->

<div class="account">
    <p><input type="button" value="Đăng nhập" onclick="window.location = '#';"/></p>
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