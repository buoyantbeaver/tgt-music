<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code vui lòng liên hệ yahoo: ichphien_pro !");

if ($_POST['loadTopsong']) {
   echo top_song($_POST['type'],$_POST['number']);
   exit();
}
elseif ($_POST['load_album']) {
   echo album_new($_POST['singer_type'],$_POST['album_type']);
   exit();
}
elseif ($_POST['load_video']) {
   echo video_new($_POST['singer_type']);
   exit();
}
elseif ($_POST['showcomment']) {
    echo cam_nhan($_POST['media_id'],$_POST['page'],$_POST['comment_type']);
	exit();
}

elseif ($_POST['SingerInfo']) {
	$id_singer = del_id($_POST['name_singer']);
	$type	   = $_POST['type'];
	$type_2	   = $_POST['type_2'];
	$singer_info	= text_tidy(un_htmlchars(get_data("singer","singer_info"," singer_id = '".$id_singer."'")));
	if($type == 1) 
    	echo text_tidy($singer_info).'<p><a class="_viewMore_" onclick="LoadInfoSinger(\''.$_POST['name_singer'].'\',0,'.$type_2.')">Ẩn toàn bộ</a></p>';
	else 
		echo text_tidy(rut_ngan($singer_info,50)).'<p><a class="_viewMore" onclick="LoadInfoSinger(\''.$_POST['name_singer'].'\',1,'.$type_2.')">Xem toàn bộ</a></p>';
	exit();
}
elseif ($_POST['comment']) {
    if (isFloodPost($_SESSION['prev_post'])) {
			echo "<div class=\"error_yeu_thich\">Bạn cần phải chờ thêm $wait_post giây nữa để có thể gửi thêm bình luận";
		exit();
	 }
	$warn = '';
	$media_id = (int)$_POST['media_id'];
	$comment_poster = $_POST['comment_poster'];
	$comment_type = $_POST['comment_type'];
	$comment_content = $_POST['comment_content'];
	if ($comment_content == ""){
	        echo "<div class=\"error_yeu_thich\">Bạn chưa nhập nội dung bình luận</div>";
		exit();
	 }
	elseif ($media_id && $comment_poster && $comment_type && $comment_content){
	mysql_query("INSERT INTO tgt_nhac_comment (comment_media_id,comment_poster,comment_content,comment_time,comment_type) VALUES ('".$media_id."','".$comment_poster."','".$comment_content."','".NOW."','".$comment_type."')");
	}
	else{ 
	     $warn = "<div class=\"error_yeu_thich\">Bạn chưa nhập cảm nhận hoặc tên người gửi</div>";
	}
	if ($warn) echo "<b>*Lỗi :</b> ".$warn;
	else echo "OK";
	$_SESSION['prev_message_post'] = time();
	exit();
}
elseif ($_POST['login_oki']) {
	$name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : '';
	$pass = isset($_POST["pass"]) ? htmlspecialchars($_POST["pass"]) : '';
	$remember = isset($_POST["remember"]) ? htmlspecialchars($_POST["remember"]) : '';
	if (empty($name) || empty($pass)) { 
		mss("Bạn chưa nhập đầy đủ thông tin !",SITE_LINK."index.php");
		}
	else {
	// check user
	$arr = $tgtdb->databasetgt(" userid, username, password, salt, pass_new ","user"," username = '".$name."'");
	$pass_new = md5(md5($pass) . $arr[0][3]);
	if (count($arr)<1) {
			mss("Tên đăng nhập không tồn tại !",SITE_LINK."index.php");
	}
	else if ($pass_new == $arr[0][4] || $pass_new == $arr[0][2]){
			$_SESSION["tgt_user_id"] = $arr[0][0];
			$_SESSION["tgt_user_name"] = $arr[0][1];
			if ($remember == 1) {
				_SETCOOKIE("member_id" , $arr[0][0] , 1);
				_SETCOOKIE("pass_hash" , $arr[0][2] , 1);
			}
			mss("Đăng nhập thành công !",SITE_LINK."index.php");
		}
	else {
			mss("Mật khẩu không đúng !",SITE_LINK."index.php");
	}
	}
}


?>