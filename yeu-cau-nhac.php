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
<title>Yêu cầu nhạc | Video | Playlist</title>
<meta name="title" content="Upload nhạc miễn phí" />
<meta name="keywords" content="Upload nhạc miễn phí" />
<meta name="description" content="Upload,nhạc,miễn,phí,upload nhạc, miễn phí" />
<? include("./theme/ip_java.php");?>
<script type="text/javascript" src="up_v1/swfupload.js"></script>
<script type="text/javascript" src="up_v1/fileprogress.js"></script>
<script type="text/javascript" src="up_v1/handlers.js"></script>
<link rel="stylesheet" href="up_v1/default.css" type="text/css" />
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents">
    	<div id="m_4">
			<div class="box w_4">
            <h1>Yêu cầu bài hát | Video | Playlist</h1>
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
            <div style="padding:10px;">
		<form method="post">
			<table width="100%" cellpadding="5" cellspacing="5">
				<tr>
					<td valign="top" align="right"><label for="song_name">Tiêu đề: <span style="color:red;">*</span></label></td>
					<td><input name="song_name" id="song_name" type="text" class="upload_tgt" style="width: 500px;" /><br>
					<span style="padding-bottom: 5px;"><i>Tên chủ đề bài hát, Video, Playlist dạng tiếng Việt có dấu. </i></span>

					</td>
				</tr>
				<tr>
					<td valign="top" align="right"><label for="txtFileName">Link chia sẻ: <span style="color:red;">*</span></label></td>
					<td><input name="link_file" id="link_file" type="text" class="upload_tgt" style="width: 500px;" /><br>
					<span style="padding-bottom: 5px;"><i>Link nhạc, video. </i></span>

				</td>
				</tr>
				<tr>
					<td valign="top" align="right"><label for="lyric">Lời bài hát:</label></td>
					<td><textarea  class="upload_tgt" name="lyric" id="lyric" cols="0" rows="0" style="width: 500px; height: 215px;"></textarea>
					<br><span style="padding-bottom: 5px;"><i>Nếu là Playlist hãy viết danh sách nhạc. </i></span>
</td>				</tr>
                <tr><td></td>
                <td><input type="submit" name="post_nhac" value="Gửi yêu cầu" class="_add_" id="btnSubmit" /></td>
                </tr>
			</table>
			
		</form>
<p>Ghi chú: Những phần có dấu (*)là phần bắt buộc.</p>
                </div>
    </div>
            
        </div>
        <!--3-->
        <div id="m_3">
			<div class="box w_3">
            	<h1>Yêu cầu nhạc bằng Facebook comment</h1>
                <div style="padding: 10px;">
<p class="chu_y">* Quy định Yêu cầu nhạc: (Tên bài hát + Ca sỹ)</p>
<div class="fb-comments" data-href="<? echo SITE_LINK ?>yeu-cau-nhac.html" data-numposts="5" data-width="325" data-colorscheme="light">

</div>

</div>
            </div>
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