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
$songalbum = "";
//$songalbum_java: lay thon tin album de chay javascript
$songalbum_java = "var songs = [";
$album1 = $tgtdb->databasetgt(" album_song ","album"," album_id = '".$id_album."'");
$song_name_1 = "";
$song_singer_1 = "";
$song_image_1 = "";
$s = explode(',',$album1[0][0]);
foreach($s as $x=>$val) {
	$arr[$x] = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local, m_lyricKAR, m_img ","data"," m_id = '".$s[$x]."'");
	$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[$x][0][3]."'"));
	$song_name = str_replace("'", " ", un_htmlchars($arr[$x][0][2]));
	$song_image = str_replace("'", " ", un_htmlchars($arr[$x][0][6]));
	$lyricKAR = str_replace("'", " ", un_htmlchars($arr[$x][0][5]));
	$song_url = grab(get_url($arr[$x][0][4],$arr[$x][0][1]));
	//kiem soat mau darkcolor, lightcolor
	$darkColor = "#3A4E55"; //mac dinh
	$lightColor = "#F2F2F2"; //mac dinh
	//tao mau $darkColor va $lightColor ngau nhien
	mt_srand((double)microtime()*1000000);  
	$rand = mt_rand(0, 2);
	switch ($rand){
		case 0:
			$darkColor = "#3A4E55";
			$lightColor = "#F2F2F2";
			break;
		case 1:
			$darkColor = "#4B3A40";
			$lightColor = "#E0D9C6";
			break;
		case 2:
			$darkColor = "#231F16";
			$lightColor = "#FFF8E8";
			break;
	}
	if($x==0){
		//neu bai hat co lyricKAR thi them vao chuoi
		//$songalbum .= $song_name.",".$lyricKAR.";";
		$song_name_1 = $song_name;
		$song_singer_1 = $singer_name;
		$song_image_1 = $song_image;
	}
	if($x==1){
		$darkColor = "#4B3A40";
		$lightColor = "#E0D9C6";
	}
	if($x==2){
		$darkColor = "#231F16";
		$lightColor = "#FFF8E8";
	}
	
	//$songalbum .= $song_name.",".$lyricCaption.";";
	//$dem = $dem + 1;	
	$songalbum .= "<audio preload='auto' autobuffer id='audio".$x."' type='audio/mpeg' src='".$song_url."'>\n".
	"</audio>";
	$songalbum_java .= "{".
	"'title':'".$song_name."',".
	"'artist':'".$singer_name."',".
	"'cover':'".check_img($song_image)."',".
	"'num':'".$x."',".
	"'darkColor':'".$darkColor."',".
	"'lightColor':'".$lightColor."'".
	"},";
	
}
//cat bo ; o cuoi chuoi
$songalbum_java = rtrim($songalbum_java,",");
$songalbum_java .= "];";
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
<title>Album <? echo $album[0][1].' - '.$title; ?> | <? echo $user ?>  | Nghe - tải - chia sẻ nhạc | IPOS </title>
<link rel="stylesheet" href="./theme/css/stylemusic2.css">
</head>
<body>
<? //echo $songalbum;?>
<div id="backgroundGradientTransition"></div>
<div id="backgroundGradient"></div>
	<div id="player">
		<div id="vinyl">
			<div id="disc"></div>
			<div id="timer">
				<svg id="svg4203" height="32.185mm" width="33.339mm" version="1.1"viewBox="0 0 33.338757 32.184547">
				 <g id="layer1" transform="translate(.031909 .39310)">
				  <path id="total-timer" style="color-rendering:auto;text-decoration-color:#000000;color:#000000;font-variant-numeric:normal;shape-rendering:auto;solid-color:#000000;stroke:#232323;text-decoration-line:none;stroke-width:.79005;fill:#232323;font-variant-position:normal;mix-blend-mode:normal;block-progression:tb;font-feature-settings:normal;shape-padding:0;font-variant-alternates:normal;text-indent:0;font-variant-caps:normal;image-rendering:auto;white-space:normal;text-decoration-style:solid;font-variant-ligatures:none;isolation:auto;stroke-linecap:round;text-transform:none" d="m16.638 0.0019233c-2.815 0-5.6302 0.72765-8.1517 2.1835-4.775 2.7568-7.8131 7.7296-8.1228 13.194 0 0.93263 1.3916 0.96025 1.4276 0 0.31027-4.977 3.0165-9.5095 7.3708-12.023 4.6271-2.6714 10.325-2.6714 14.952 0 4.3543 2.5139 7.0601 7.0465 7.3704 12.023 0 0.94918 1.4276 0.96035 1.4276 0-0.311-5.465-3.349-10.438-8.124-13.195-2.521-1.4554-5.336-2.1831-8.151-2.1831z"/>
				  <path id="timer-dash"
				   transform="scale(-1)"
				   style="font-variant-ligatures:none;font-variant-caps:normal;font-variant-numeric:normal;opacity:1;fill:none;fill-opacity:0.57034218;stroke:#cdcdcd;stroke-width:1.34621394;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0 49;stroke-dashoffset:0;stroke-opacity:1; pointer-events: none;"
				   d="m -1.0605774,-16.198862 c 0,5.565088 -2.9689391,10.7074411 -7.7884466,13.489985 -4.819508,2.78254381 -10.757386,2.78254366 -15.576893,-4e-7 -4.819507,-2.7825442 -7.788446,-7.9248976 -7.788446,-13.4899856" />
				 </g>
				</svg>
			</div>
		</div>

		<div id="cover">
			<img id="album" src="<?=$song_image_1;?>"/>
		</div>

		<div id="playlist">
		</div>

		<div id="infos">
			<div id="title"><?=$song_name_1;?></div>
			<div id="artist"><?=$song_singer_1;?></div>
		</div>

		<div id="buttons">
			<div id="playlistLink"></div>
			<div src="arrow.png" class="previous"><p>&lsaquo;</p></div>
			<div src="arrow.png" class="next"><p>&rsaquo;</p></div>
			<div id="playPause"><p>&rtrif;</p></div>
			<label for="volumeCheckbox" id="volume">
				<input id="volumeCheckbox" type="checkbox">
				<input id="volumeSlider" type="range"></span>
			</div>
		</div>
	</div>
</div>

<div>
	<?=$songalbum;?>
</div>
<h3 align="center"><a href="<?=SITE_LINK."nghe_album_mp3.php?id=".$id_album_mahoa;?> " title="Nghe Album <?=$album_title;?> bằng Audio HTML5 Player" target="blank">Nghe Album "<?=un_htmlchars($album[0][1]);?> - <?=$title;?>" bằng Better Audio HTML5 Player</a></h3>
  <script src='<?=SITE_LINK;?>/theme/js/jquery-3.1.1.min.js'></script>

    <script>
	"use strict";
$(document).ready(function() {
	<?=$songalbum_java;?>

	var nbSongs = songs.length;
	var currentSong = 0;
	var dashLength = 49;
	var audio = null;
	var timer = null;

	function init() {
		// Chargement de la playlist
		for (var i=0; i<songs.length; i++) {
			$("<p>").html(songs[i].title + " &#183; " + songs[i].artist).appendTo($("#playlist"));
		}
		$("#playlist p:first-child").addClass("active");

		// Chargement de la première musique
		loadSong(1);
		pause();
		$("#volumeSlider").change();

		// Playlist
		$("#playlist p").click(function() {
			loadSong($(this).index());
			hidePlaylist();
		});

		// Rotation du disque
		$("#disc").addClass("rotateDisc");

		$("#playPause").on("click", function() {
			if (audio.paused) on();
			else pause();
		});

		$(".previous").on("click", function() {
			nextSong(-1);
		});

		$(".next").on("click", function() {
			nextSong(1);
		});

		$("#total-timer").click(function(e) {
			// Coordonnées du centre du cercle
			var posElement = $("#total-timer").offset();
			var left = parseInt(posElement.left+12);
			var top = parseInt(posElement.top) + 136/2;
			console.log(posElement);

			var dx = e.pageX - left;
			var dy = e.pageY - top;
			console.log("dx: "+ dx + " - dy: " + dy);

			// On récupère l'angle
			var angleRad = Math.atan2(dx, dy);
			var angle = angleRad * 180 / Math.PI;

			// On va au bon endroit dans la musique
			audio.currentTime = (180 - angle)/180 * audio.duration;
			console.log((180 - angle)/180 * audio.duration);
		});

		$("#playlistLink").click(function() {
			if ($("#cover").hasClass("show90"))
				hidePlaylist();
			else showPlaylist();
		});

		// Son
		$("#volumeSlider").on("change mousemove", function() {
			audio.volume = ($(this).get(0).value / 100).toFixed(2);
		});
	}

	function loadSong(num) {
		currentSong = num;
		if (audio !== null) audio.pause();
		audio = $("#audio"+num).get(0);
		on(0);
		audio.volume = ($("#volumeSlider").get(0).value / 100).toFixed(2);

		$("#album").attr("src", songs[currentSong].cover);
		setTimeout( function(){
			// Infos
			$("#title").html(songs[currentSong].title);
			$("#artist").html(songs[currentSong].artist);
				$("#playlist p").removeClass("active");
				$("#playlist p span").remove();
				$("#playlist p:eq("+currentSong+")").addClass("active");

			// Style
				$("#playlist p").css("color", "#231f16");
				$("#playlist p.active").css("color", songs[currentSong].darkColor);
				$("#playlist p.active").html("<span>&rtrif;</span> " + $("#playlist p.active").html());
			$("#artist").css("color", songs[currentSong].darkColor);
			changeBackground();
		}, 300);

	}

	function changeBackground() {
		var bg = $("#backgroundGradient");
		$("#backgroundGradientTransition").css("background", "radial-gradient("+songs[currentSong].lightColor+","+songs[currentSong].darkColor+")");
			bg.css("opacity", "0");


		setTimeout( function(){
				bg.css("background", "radial-gradient("+songs[currentSong].lightColor+","+songs[currentSong].darkColor+")");
				bg.css("opacity", "1");
		}, 500);
	}

	function showPlaylist() {
		// On rentre le CD
		animateVinyl(0);

		// On tourne la pochette
		setTimeout( function(){
			$("#disc").css("opacity", "0");
			$("#timer").css("opacity", "0");
	    },600);

		setTimeout( function(){
			$("#cover").addClass("show90");
		}, 600);

		// On affiche la playlist
		setTimeout( function(){
			$("#playlist").addClass("show0");
	    },900);
	}

	function hidePlaylist() {
		// On cache la playlist
		$("#playlist").removeClass("show0");

	    // On tourne la pochette
		setTimeout( function(){
			$("#cover").removeClass("show90");
		}, 200);

		setTimeout( function(){
			$("#disc").css("opacity", "1");
			$("#timer").css("opacity", "1");
		}, 700);

	    // On sort le CD
		if (!audio.paused) {
			setTimeout( function(){
				animateVinyl("50%");
			},800);
		}
	}

	function animateVinyl(direction) {
		$("#vinyl").css({
			"left": direction,
			"transition": "all 0.8s"
		});
	}

	function on(start) {
		animateVinyl("50%");
		if (start !== undefined && audio.currentTime !== start)
			audio.currentTime = start;
		audio.play();
		$("#playPause p").html("&#61;").css({
			"transform": "rotate(90deg) scale(1,1.5)",
			"margin": "8px 0 0 18px"
		});

		// MAJ du temps
		if (timer) clearInterval(timer);
		timer = setInterval(updateTime, 1000);

		audio.removeEventListener("ended", off);
		audio.addEventListener("ended", off);
	}

	function pause() {
		animateVinyl(0);
		audio.pause();
		$("#playPause p").html("&rtrif;").css({
			"transform": "rotate(0deg) scale(1,1.5)",
			"margin": "6px 0 0 16px"
		});

		if (timer) clearInterval(timer);
		timer = null;
	}

	function off() {
		pause();
		nextSong(1);
		$("#timer-dash").css("stroke-dasharray", 0 + " " + (dashLength));
		$("#disc").css("transform", "rotate(0deg)");
	}

	function nextSong(direction) {
		currentSong = (currentSong + direction + nbSongs) % nbSongs;
		loadSong(currentSong);
	}

	function updateTime() {
		var ratio = 49 * audio.currentTime / audio.duration;
		$("#timer-dash").css("stroke-dasharray", ratio + " " + (dashLength - ratio));
	}

	init();
});
	</script>

</html>