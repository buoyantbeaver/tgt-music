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
$id_album_mahoa = $id_album;
$id_album 						 = del_id($id_album);

mysql_query("UPDATE tgt_nhac_album SET album_viewed = album_viewed+".NUMPLAY.", album_viewed_month = album_viewed_month+".NUMPLAY." WHERE album_id = '".$id_album."'");
//$cache = new cache();
//if ( $cache->caching ) {
$album 			= $tgtdb->databasetgt(" * ","album"," album_id = '".$id_album."' ORDER BY album_id DESC ");
$album_title = $album[0][1];
$title 			= get_data("singer","singer_name"," singer_id = '".$album[0][3]."'");
$album_url 		= url_link($album[0][1].'-'.$title,$id_album,'nghe-album');
$user 			= get_user($album[0][7]);
$user_url 		= url_link($user,$album[0][7],'user');
$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($title).'&ks=singer';
$singer_img		= get_data("singer","singer_img"," singer_id = '".$album[0][3]."'");
$singer_img		= check_img($singer_img);
$singer_info	= text_tidy(un_htmlchars(get_data("singer","singer_info"," singer_id = '".$album[0][3]."'")));
//Kiem tra bai nao co lyricKAR thi cho vao playlist choi bang AS3 Karaoke Flash Player
$songalbum = "var playlist = [";
$album1 = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
$dem = 0;
$dem1 = 0;
$s = explode(',',$album1[0][0]);
foreach($s as $x=>$val) {
	$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local, m_lyricKAR, m_img ","data"," m_id = '".$s[$x]."'");
	$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));
	$song_name = str_replace("'", " ", un_htmlchars($arr[$x][0][2]));
	$song_image = str_replace("'", " ", un_htmlchars($arr[$x][0][6]));
	$lyricKAR = str_replace("'", " ", un_htmlchars($arr[$x][0][5]));
	$song_url = grab(get_url($arr[$x][0][4],$arr[$x][0][1]));
	if(strlen($lyricKAR)>5){
		//neu bai hat co lyricKAR thi them vao chuoi
		//$songalbum .= $song_name.",".$lyricKAR.";";
	}
	//$songalbum .= $song_name.",".$lyricCaption.";";
	//$dem = $dem + 1;	
	$songalbum .= "{\n".
	"'song':'".$song_name."',\n".
	"'album':'".$album_title."',\n".
	"'artist':'".$singer_name."',".
	"'artwork':'".$song_image."',".
	"'mp3':'".$song_url."'".
	"},";
	
}
//cat bo ; o cuoi chuoi
$songalbum = rtrim($songalbum,",");
$songalbum .= "];";
//end kiem tra
$album_link_jwplayer = url_link($album[0][1],$album[0][0],'nghe-album');
$album_link_karaoke_lrc = url_link($album[0][1],$album[0][0],'nghe-album-lrc');
$album_link_karaoke_nct = url_link($album[0][1],$album[0][0],'nghe-album-nct');
//$album_link_karaoke_kar = url_link($album[0][1],$album[0][0],'nghe-album-kar');
$album_link_karaoke_zmp3 = url_link($album[0][1],$album[0][0],'nghe-album-zmp3');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8">
<title>Album <? echo $album[0][1].' - '.$title; ?> | <? echo $user ?>  | Nghe - tải - chia sẻ nhạc | IPOS </title>
<link rel="stylesheet" href="<?=SITE_LINK;?>theme/css/styleaudio.css">
<!--styleaudio-->
</head>
<body>
<? //echo $songalbum;?>
<div class="player">
	<span id="arm"></span>
	<ul>
		<li class="artwork">
		</li>
		<li class="info">
			<h1 id="artist">loading</h1>
			<h4 id="album">loading</h4>
			<h2 id="song">loading</h2>
			<div class="button-items">
				<audio id="music" preload="auto" control autoplay loop>
				</audio>
				<div id="slider">
					<div id="elapsed"></div>
					<div id="buffered"></div>
				</div>
				<p id="timer">0:00</p>
				<div class="controls">
					<span class="expend">
						<svg id="previous" class="step-backward" viewBox="0 0 25 25" xml:space="preserve">
							<g>
								<polygon points="4.9,4.3 9,4.3 9,11.6 21.4,4.3 21.4,20.7 9,13.4 9,20.7 4.9,20.7"/>
							</g>
						</svg>
					</span>
					<svg id="play" viewBox="0 0 25 25" xml:space="preserve">
						<defs>
							<rect x="-49.5" y="-132.9" width="446.4" height="366.4"/>
						</defs>
						<g>
							<circle fill="none" cx="12.5" cy="12.5" r="10.8"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M8.7,6.9V18c0,0,0.2,1.4,1.8,0l8.1-4.8c0,0,1.2-1.1-1-2L9.8,6.5 C9.8,6.5,9.1,6,8.7,6.9z"/>
						</g>
					</svg>
					<svg id="pause" viewBox="0 0 25 25" xml:space="preserve">
						<g>
							<rect x="6" y="4.6" width="3.8" height="15.7"/>
							<rect x="14" y="4.6" width="3.9" height="15.7"/>
						</g>
					</svg>
					<span class="expend">
						<svg id="next" class="step-foreward" viewBox="0 0 25 25" xml:space="preserve">
							<g>
								<polygon points="20.7,4.3 16.6,4.3 16.6,11.6 4.3,4.3 4.3,20.7 16.7,13.4 16.6,20.7 20.7,20.7"/>
							</g>
						</svg>
					</span>
					<div class="slider">
						<div class="volume"></div>
						<input type="range" id="volume" min="0" max="1" step="0.01" value="1" />
					</div>
				</div>
			</div>
		</li>
	</ul>
</div>
  <h3 align="center"><a href="<?=SITE_LINK."nghe_album_audio.php?id=".$id_album_mahoa;?> " title="Nghe Album <?=$album_title;?> bằng Audio HTML5 Player" target="blank">Nghe Album "<?=un_htmlchars($album[0][1]);?> - <?=$title;?>" bằng Pixeden Audio HTML5 Player</a></h3>
 
    <script type="text/javascript">
	/* Music 
======================================*/
<? echo $songalbum;?>

/* General Load / Variables
======================================*/
var rot = 0;
var duration;
var playPercent;
var rotate_timer;
var armrot = -45;
var bufferPercent;
var currentSong = 0;
var arm_rotate_timer;
var arm = document.getElementById("arm");
var next = document.getElementById("next");
var song = document.getElementById("song");
var timer = document.getElementById("timer");
var music = document.getElementById("music");
var album = document.getElementById("album");
var artist = document.getElementById("artist");
var volume = document.getElementById("volume");
var playButton = document.getElementById("play");
var timeline = document.getElementById("slider");
var playhead = document.getElementById("elapsed");
var previous = document.getElementById("previous");
var pauseButton = document.getElementById("pause");
var bufferhead = document.getElementById("buffered");
var artwork = document.getElementsByClassName("artwork")[0];
var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;
var visablevolume = document.getElementsByClassName("volume")[0];

music.addEventListener("ended", _next, false);
music.addEventListener("timeupdate", timeUpdate, false);
music.addEventListener("progress", 	bufferUpdate, false);
load();

/* Functions
======================================*/
function load(){
	pauseButton.style.visibility = "hidden";
	song.innerHTML = playlist[currentSong]['song'];
	song.title = playlist[currentSong]['song'];
	album.innerHTML = playlist[currentSong]['album'];
	album.title = playlist[currentSong]['album'];
	artist.innerHTML = playlist[currentSong]['artist'];
	artist.title = playlist[currentSong]['artist'];
	artwork.setAttribute("style", "background:url(http://i.imgur.com/m0FfYwQ.png), url('"+playlist[currentSong]['artwork']+"') center no-repeat;");
	music.innerHTML = '<source src="'+playlist[currentSong]['mp3']+'" type="audio/mp3">';
	music.load();
}
function reset(){ 
	rotate_reset = setInterval(function(){ 
		Rotate();
		if(rot == 0){
			clearTimeout(rotate_reset);
		}
	}, 1);
	fireEvent(pauseButton, 'click');
	armrot = -45;
	playhead.style.width = "0px";
	bufferhead.style.width = "0px";
	timer.innerHTML = "0:00";
	music.innerHTML = "";
	currentSong = 0; // set to first song, to stay on last song: currentSong = playlist.length - 1;
	song.innerHTML = playlist[currentSong]['song'];
	song.title = playlist[currentSong]['song'];
	album.innerHTML = playlist[currentSong]['album'];
	album.title = playlist[currentSong]['album'];
	artist.innerHTML = playlist[currentSong]['artist'];
	artist.title = playlist[currentSong]['artist'];
	artwork.setAttribute("style", "background:url(http://i.imgur.com/m0FfYwQ.png), url('"+playlist[currentSong]['artwork']+"') center no-repeat;");
	music.innerHTML = '<source src="'+playlist[currentSong]['mp3']+'" type="audio/mp3">';
	music.load();
}
function formatSecondsAsTime(secs, format) {
  var hr  = Math.floor(secs / 3600);
  var min = Math.floor((secs - (hr * 3600))/60);
  var sec = Math.floor(secs - (hr * 3600) -  (min * 60));
  if (sec < 10){ 
    sec  = "0" + sec;
  }
  return min + ':' + sec;
}
function timeUpdate() {
	bufferUpdate();
	playPercent = timelineWidth * (music.currentTime / duration);
	playhead.style.width = playPercent + "px";
	timer.innerHTML = formatSecondsAsTime(music.currentTime.toString());
}
function bufferUpdate() {
	bufferPercent = timelineWidth * (music.buffered.end(0) / duration);
	bufferhead.style.width = bufferPercent + "px";
}
function Rotate(){
	if(rot == 361){
		artwork.style.transform = 'rotate(0deg)';
		rot = 0;
	} else {
		artwork.style.transform = 'rotate('+rot+'deg)';
		rot++;
	}
}
function RotateArm(){
	if(armrot > -12){
		arm.style.transform = 'rotate(-38deg)';
		armrot = -45;
	} else {
		arm.style.transform = 'rotate('+armrot+'deg)';
		armrot = armrot + (26 / duration);
	}
}
function fireEvent(el, etype){
	if (el.fireEvent) {
		el.fireEvent('on' + etype);
	} else {
		var evObj = document.createEvent('Events');
		evObj.initEvent(etype, true, false);
		el.dispatchEvent(evObj);
	}
}
function _next(){
	if(currentSong == playlist.length - 1){
		reset();
	} else {
		fireEvent(next, 'click');
	}
}
playButton.onclick = function() {
	music.play();
}
pauseButton.onclick = function() {
	music.pause();
}
music.addEventListener("play", function () {
	playButton.style.visibility = "hidden";
	pause.style.visibility = "visible";
	rotate_timer = setInterval(function(){ 
		if(!music.paused && !music.ended && 0 < music.currentTime){
			Rotate();
		}
	}, 10);	
	if(armrot != -45){
		arm.setAttribute("style", "transition: transform 800ms;");
		arm.style.transform = 'rotate('+armrot+'deg)';
	}
	arm_rotate_timer = setInterval(function(){ 
		if(!music.paused && !music.ended && 0 < music.currentTime){
			if(armrot == -45){
				arm.setAttribute("style", "transition: transform 800ms;");
				arm.style.transform = 'rotate(-38deg)';
				armrot = -38;
			}
			if(arm.style.transition != ""){
				setTimeout(function(){
					arm.style.transition = "";
				}, 1000);
			}
			RotateArm();
		}
	}, 1000);
}, false);
music.addEventListener("pause", function () {
	arm.setAttribute("style", "transition: transform 800ms;");
	arm.style.transform = 'rotate(-45deg)';
	playButton.style.visibility = "visible";
	pause.style.visibility = "hidden";
	clearTimeout(rotate_timer);
	clearTimeout(arm_rotate_timer);
}, false);
next.onclick = function(){
	arm.setAttribute("style", "transition: transform 800ms;");
	arm.style.transform = 'rotate(-45deg)';
	clearTimeout(rotate_timer);
	clearTimeout(arm_rotate_timer);
	playhead.style.width = "0px";
	bufferhead.style.width = "0px";
	timer.innerHTML = "0:00";
	music.innerHTML = "";
	arm.style.transform = 'rotate(-45deg)';
	armrot = -45;
	if((currentSong + 1) == playlist.length){
		currentSong = 0;
		music.innerHTML = '<source src="'+playlist[currentSong]['mp3']+'" type="audio/mp3">';
	} else {
		currentSong++;
		music.innerHTML = '<source src="'+playlist[currentSong]['mp3']+'" type="audio/mp3">';
	}
	song.innerHTML = playlist[currentSong]['song'];
	song.title = playlist[currentSong]['song'];
	album.innerHTML = playlist[currentSong]['album'];
	album.title = playlist[currentSong]['album'];
	artist.innerHTML = playlist[currentSong]['artist'];
	artist.title = playlist[currentSong]['artist'];
	artwork.setAttribute("style", "transform: rotate("+rot+"deg); background:url(http://i.imgur.com/m0FfYwQ.png), url('"+playlist[currentSong]['artwork']+"') center no-repeat;");
	music.load();
	duration = music.duration;
	music.play();
}
previous.onclick = function(){
	arm.setAttribute("style", "transition: transform 800ms;");
	arm.style.transform = 'rotate(-45deg)';
	clearTimeout(rotate_timer);
	clearTimeout(arm_rotate_timer);
	playhead.style.width = "0px";
	bufferhead.style.width = "0px";
	timer.innerHTML = "0:00";
	music.innerHTML = "";
	arm.style.transform = 'rotate(-45deg)';
	armrot = -45;
	if((currentSong - 1) == -1){
		currentSong = playlist.length - 1;
		music.innerHTML = '<source src="'+playlist[currentSong]['mp3']+'" type="audio/mp3">';
	} else {
		currentSong--;
		music.innerHTML = '<source src="'+playlist[currentSong]['mp3']+'" type="audio/mp3">';
	}
	song.innerHTML = playlist[currentSong]['song'];
	song.title = playlist[currentSong]['song'];
	album.innerHTML = playlist[currentSong]['album'];
	album.title = playlist[currentSong]['album'];
	artist.innerHTML = playlist[currentSong]['artist'];
	artist.title = playlist[currentSong]['artist'];
	artwork.setAttribute("style", "transform: rotate("+rot+"deg); background:url(http://i.imgur.com/m0FfYwQ.png), url('"+playlist[currentSong]['artwork']+"') center no-repeat;");
	music.load();
	duration = music.duration;
	music.play();
}
volume.oninput = function(){
	music.volume = volume.value;
	visablevolume.style.width = (80 - 11) * volume.value + "px";
}
music.addEventListener("canplay", function () {
	duration = music.duration;
}, false);
	
	</script>
</body>
</html>