<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/functions_user.php");

$used_degraded = false;
$resume_id = "";
if (isset($_FILES["resume_degraded"]) && is_uploaded_file($_FILES["resume_degraded"]["tmp_name"]) && $_FILES["resume_degraded"]["error"] == 0) {
    $resume_id = $_FILES["resume_degraded"]["name"];
    $used_degraded = true;
}

if (isset($_POST["hidFileID"]) && $_POST["hidFileID"] != "" ) {
	$resume_id 		= $_POST["hidFileID"];
	$File_Name 		= $_SERVER["DOCUMENT_ROOT"]."/file_music/".date("m-Y")."/".$resume_id;
	$song_url 		= date("m-Y")."/".$resume_id;
	$type_cv 		= explode(".",$resume_id);
	$type_cv 		= $type_cv[1];
	$title	   	  	= htmlchars(stripslashes(trim(urldecode($_POST['song_name']))));
	$title_ascii  	= strtolower(get_ascii($title));
	$new_singer 	= htmlchars(stripslashes(trim(urldecode($_POST['singer_new']))));
	$singer_type 	= $_POST['singer_type'];
	$singer 		= them_moi_singer($new_singer,$singer_type);		  
	$category_name 	= $_POST['cat_name'];
	$lyric	 		= htmlchars(stripslashes(trim(urldecode($_POST['lyric']))));
	$user_id	 	= $_SESSION["tgt_user_id"];
	$date		 	= date("Y-m-d",time());
	$type		 	= acp_type($song_url);
	
	if(empty($title) || empty($new_singer)) {
			delFile("file_music/".date("m-Y")."/".$resume_id);
			mss( "Bạn chưa nhập đầy đủ thông tin !","./upload.html");
			exit();
		}

		@mysql_query("INSERT INTO tgt_nhac_data (m_title,m_title_ascii,m_singer,m_cat,m_poster,m_lyric,m_type,m_time,m_url,m_is_local,m_mempost) 
							 VALUES ('".$title."','".$title_ascii."','".$singer."',',".$category_name.",','".$user_id."','".$lyric."','".$type."','".time()."','".$song_url."','".SERVER."','1')");
	mss( " Đã Upload xong !","./upload.html");

}else {
mss( " Địa chỉ bạn vừa truy cập không tồn tại !","./upload.html");
}
?>