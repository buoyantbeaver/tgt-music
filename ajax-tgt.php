<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include_once("./tgt/tgt_music.php");
	
if(isset($_POST['Login'])) {
	// kiểm tra đăng nhập
	$cookie = array();
	$cookie['USERID'] 	 = intval(_GETCOOKIE('member_id'));
	$cookie['USERPASS']  = _GETCOOKIE('pass_hash');
	if ($cookie['USERID'] != "" && $cookie['USERPASS'] != "") {
		$arrcookie	=	$tgtdb->databasetgt("username","user","userid = '".$cookie['USERID']."' AND password = '".$cookie['USERPASS']."'");
		if ($arrcookie) {
			$_SESSION["tgt_user_id"] 	= $cookie['USERID'];
			$_SESSION["tgt_user_name"] 	= $arrcookie[0][0];
		}
	}
	else {
			$_SESSION["tgt_user_id"] = "";
			$_SESSION["tgt_user_name"] = "";
	}

	// login
	if($_SESSION["tgt_user_id"]) {
		echo '<li class="right"><a href="./Member/Thoat.html">Thoát</a></li>
		<script>var loginTGT = \'YES\';</script>';
		exit();
	} else { 
		echo '<ul><li class="right"><a onclick="Login_Box();">Đăng nhập</a></li><li class="right"><a href="./Member/Dang-Ky.html">Đăng ký</a></li></ul><script>var loginTGT = \'NO\';</script>';
		exit();
	}
}

elseif(isset($_POST['checkPL'])) {
	$number	=	$_POST['number'];
	if($_SESSION["tgt_user_id"]) echo '<a style="cursor:pointer;" onclick="_load_box('.$number.');"><img src="images/media/add.gif" /></a>';
	else echo '<a onclick="Login_Box();" style="cursor:pointer;"><img src="images/media/add.gif" /></a>';	
}

elseif(isset($_POST['song_id']) && $_SESSION["tgt_user_id"]) {
	$song_id = (int)$_POST['song_id'];
	$arr = $tgtdb->databasetgt(" album_id, album_name ","album"," album_poster = '".$_SESSION["tgt_user_id"]."' AND album_type = 1 ORDER BY album_name ASC");
	echo '<div class="_list_box__">';
	echo '<li><a onclick="AddFAV('.$song_id.',1);">Yêu thích</a></li>';
	for($z=0;$z<count($arr);$z++) {
	echo '<li><a onclick="THEMPLAYLIST('.$arr[$z][0].','.$song_id.');">'.$arr[$z][1].'</a></li>';
	}
	echo '<li class="_pl_line"><a onclick="_CREATPLAYLIST('.$song_id.',0);">Tạo mới playlist</a></li>';
	echo '<div id="_CREATPLAYLIST_'.$song_id.'" class="PlTGT"></div>';
	echo '</div>';
}
elseif(isset($_POST['CreatPlaylist']) && $_SESSION["tgt_user_id"]) {
	$album_name 	= htmlchars(stripslashes($_POST['album_name']));
	$id_song 		= (int)$_POST['id'];
	$checkAL 		= get_data("album","album_id"," album_name = '".$album_name."'");
	if($album_name && !$checkAL) {
		mysql_query("INSERT INTO tgt_nhac_album (album_name,album_name_ascii,album_singer,album_poster,album_song,album_type,album_time) VALUES ('".$album_name."','".get_ascii($album_name)."','1','".$_SESSION["tgt_user_id"]."','".$id_song."','1','".GetTIMEDATE(time())."')");
		echo 0;
	}else {
		echo 1;
	}
	exit();
}
elseif ($_POST['FAV'] && $_SESSION["tgt_user_id"]) {
	$add_id 	= (int)$_POST['add_id'];
	$type		= (int)$_POST['type'];
	$fav_song 	= get_data("fav","fav_text","fav_user = '".$_SESSION["tgt_user_id"]."' AND fav_type = 1");
	$fav_album 	= get_data("fav","fav_text","fav_user = '".$_SESSION["tgt_user_id"]."' AND fav_type = 2");
	$fav_video 	= get_data("fav","fav_text","fav_user = '".$_SESSION["tgt_user_id"]."' AND fav_type = 3");
	// Add fav song
	if($type == 1){
		if(!$fav_song) {
			mysql_query("INSERT INTO tgt_nhac_fav (fav_text,fav_user,fav_type) VALUES ('".$add_id."','".$_SESSION["tgt_user_id"]."','1')");
		}else {
				$z = split(',',$fav_song);
				if (!in_array($add_id,$z)) {
					$fav_s	=	$fav_song.','.$add_id;
				mysql_query("UPDATE tgt_nhac_fav SET fav_text = '".$fav_s."' WHERE fav_user = '".$_SESSION["tgt_user_id"]."'  AND fav_type = 1");
				}
		}
	}
	// Add fav album
	elseif($type == 2){
		if(!$fav_album) {
			mysql_query("INSERT INTO tgt_nhac_fav (fav_text,fav_user,fav_type) VALUES ('".$add_id."','".$_SESSION["tgt_user_id"]."','2')");
		}else {
				$z = split(',',$fav_album);
				if (!in_array($add_id,$z)) {
					$fav_s	=	$fav_album.','.$add_id;
				mysql_query("UPDATE tgt_nhac_fav SET fav_text = '".$fav_s."' WHERE fav_user = '".$_SESSION["tgt_user_id"]."'  AND fav_type = 2");
				}
		}
	}
	// Add fav album
	elseif($type == 3){
		if(!$fav_video) {
			mysql_query("INSERT INTO tgt_nhac_fav (fav_text,fav_user,fav_type) VALUES ('".$add_id."','".$_SESSION["tgt_user_id"]."','3')");
		}else {
				$z = split(',',$fav_video);
				if (!in_array($add_id,$z)) {
					$fav_s	=	$fav_video.','.$add_id;
				mysql_query("UPDATE tgt_nhac_fav SET fav_text = '".$fav_s."' WHERE fav_user = '".$_SESSION["tgt_user_id"]."'  AND fav_type = 3");
				}
		}
	}
	echo 'oki!';
	exit();
}
elseif (isset($_POST['ADDPLAYLIST']) && $_SESSION["tgt_user_id"]) {
	$album_id 	= (int)$_POST['add_id'];
	$song_id	= (int)$_POST['bh_id'];
	$fav_song 	= get_data("album","album_song"," album_id = '".$add_id."'");
	$z = split(',',$fav_song);
	if (!in_array($song_id,$z)) {
		$fav_s	=	$fav_song.','.$song_id;
		mysql_query("UPDATE tgt_nhac_album SET album_song = '".$fav_s."' WHERE album_id = '".$album_id."'");
	}
	echo 'oki!';
	exit();
}
elseif(isset($_POST['AddFAVAlbum'])) {
	$add_id 	= (int)$_POST['add_id'];
	$fav_album 	= get_data("fav","fav_text","fav_user = '".$_SESSION["tgt_user_id"]."' AND fav_type = 2");	
	$z 			= split(',',$fav_album);
	if (in_array($add_id,$z)) echo 'no';
	else echo 'oki';
	exit();
}
elseif(isset($_POST['AddFAVVideo'])) {
	$add_id 	= (int)$_POST['add_id'];
	$fav_video 	= get_data("fav","fav_text","fav_user = '".$_SESSION["tgt_user_id"]."' AND fav_type = 3");	
	$z 			= split(',',$fav_video);
	if (in_array($add_id,$z)) echo 'no';
	else echo 'oki';
	exit();
}


elseif($_POST['SendError']) {
	$id_media 	 = (int)$_POST['media_id'];
	$errortxt	 = htmlchars(stripslashes($_POST['errortxt']));
	$type		 = (int)$_POST['type'];
	if(strlen($errortxt) > 250) {
		echo 1;
		exit();
	}else {
		mysql_query("UPDATE tgt_nhac_data SET m_is_broken = 1 WHERE m_id = '".$id_media."'");
		mysql_query("INSERT INTO tgt_nhac_error (er_id,er_text,er_type) VALUES ('".$id_media."','".$errortxt."','".$type."')");
		echo 2;
		exit();
	}	
}
?>