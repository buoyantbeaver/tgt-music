<?php
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/functions_user.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>404</title>
<meta name="title" content="404" />
<meta name="keywords" content="404" />
<meta name="description" content="404" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents">
<?
if($_POST['post_nhac']) {
	$title	   	  	= htmlchars(stripslashes(trim(urldecode($_POST['song_name']))));
	$title_ascii  	= strtolower(get_ascii($title));
	$new_singer 	= htmlchars(stripslashes(trim(urldecode($_POST['singer_new']))));
	$singer_type 	= $_POST['singer_type'];
	$singer 		= them_moi_singer($new_singer,$singer_type);		  
	$cat		 	= $_POST['cat_name'];
	$lyric	 		= htmlchars(stripslashes(trim(urldecode($_POST['lyric']))));
	$user_id	 	= $_SESSION["tgt_user_id"];
	$date		 	= date("Y-m-d",time());
	$type		 	= $_POST['type'];
	$song_url		= $_POST['link_file'];
	$img		 	= $_POST['img'];
	//..if($title == "" || $song_url == "") mss("Vui lòng nhập đầy đủ thông tin !","dang-nhac.html");
	if($title == "") mss("Vui lòng nhập Title Bài Hát !");
	elseif($song_url == "") mss("Vui lòng nhập Link Bài Hát");
	else {
	@mysql_query("INSERT INTO tgt_nhac_data (m_title,m_title_ascii,m_singer,m_cat,m_poster,m_lyric,m_type,m_time,m_url,m_is_local,m_mempost,m_img) 
							 VALUES ('".$title."','".$title_ascii."','".$singer."','".$cat."','".$user_id."','".$lyric."','".$type."','".time()."','".$song_url."','0','1','".$img."')");
	mss( " Cảm ơn bạn chia sẻ. Vui lòng chờ Ban Quản Trị phê duyệt bài hát !","./yeu-cau-nhac.php");
	}
}
?>
<div style="margin: 30px auto; border: 1px dotted #FF0000; width: 300px; background: #fff; padding: 10px; text-align: center;">
<font color="#FF0000">Phần Này chưa có dữ liệu trên hệ thông website</font><br />
Nếu trang không tự chuyển, nhấn <a href="../index.php">vào đây</a> để về trang chủ
</div>

            



        <div class="clr"></div>
    </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>
<? 
//}
//$cache->close();
?>