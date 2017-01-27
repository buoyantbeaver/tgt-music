<?php
define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../../tgt/class.inputfilter.php");
include("../../tgt/securesession.class.php");
include("../../tgt/class.upload.php");
include("../fckeditor/fckeditor.php");
include("../functions.php");
$myFilter = new InputFilter();
$upload = new UPLOAD_FILES();
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
$ss->Open();
include("../auth.php");

if(isset($_GET["mode"])) $mode=$myFilter->process($_GET["mode"]);
if(isset($_GET["del_id"])) $del_id=$myFilter->process($_GET["del_id"]);
if(isset($_GET["id"])) $id=$myFilter->process($_GET["id"]);
if(isset($_GET["del_song_id"])) $del_song_id=$myFilter->process($_GET["del_song_id"]);

if ($del_id) {
	if ($_POST['submit']) {
		$del_id	= del_id($del_id);
		$arr_img = $tgtdb->databasetgt(" album_img ","album"," album_id = '".$del_id."'");
		delFile($arr_img[0][0]);
		mysql_query("DELETE FROM tgt_nhac_album WHERE album_id = '".$del_id."'");
		mss ("Đã xóa xong ","list_album.php");
	}
	?>
    <table align="center" width="100%" style="border: 1px solid red;">
    <form method="post">Bạn có muốn xóa album này không ? <input class="sutm" value="Có" name=submit type=submit class=submit></form>
    </table><?
}
if($mode == 'edit') {
		$id	  =	del_id($id);
		$arrz = $tgtdb->databasetgt(" * ","album"," album_id = '$id'");
		$action			= "album.php?mode=edit&id=".en_id($id);
		if(isset($_POST['submit'])) {
					$album		 = htmlchars(stripslashes(trim(urldecode($_POST['name']))));
					$s_nghe		 = htmlchars(stripslashes(trim(urldecode($_POST['s_nghe']))));
					$imgbig		 = htmlchars(stripslashes(trim(urldecode($_POST['imgbig']))));
					$album_ascii  = strtolower(get_ascii($album));
					if($_POST['new_singer'] && $_POST['singer_type']) {
						$new_singer 	 = htmlchars(stripslashes(trim(urldecode($_POST['new_singer']))));
						$singer_type = $_POST['singer_type'];
						$singer = them_moi_singer($new_singer,$singer_type);
					}
					else $singer 	 = $_POST['singer'];
					if(move_uploaded_file ($_FILES['img']['tmp_name'],FOLDER_ALBUM."/[TGT-music]-".time()."-".$_FILES['img']['name'])) {
						delFile($arrz[0][4]);
					$img = LINK_ALBUM."/[TGT-music]-".time()."-".$_FILES['img']['name'];
					}else 
						$img		 = htmlchars(stripslashes(trim(urldecode($_POST['pimg']))));
					
					$info	=	$_POST['info'];
					$cat		 = implode(',',$_POST['cat']);
					$cat		 = ",".$cat.",";
					@mysql_query("UPDATE tgt_nhac_album SET
						album_cat			= 	'".$cat."',
						album_name			=  	'".$album."',
						album_name_ascii 	= 	'".$album_ascii."',
						album_singer		= 	'".$singer."',
						album_viewed_month	= 	'".$s_nghe."',
						album_img			= 	'".$img."',
						album_info			=	'".$info."',
						album_img_big		=	'".$imgbig."' WHERE album_id = '".$id."'");
				mss ("Update thành công ","list_album.php");
		}
	include("album_act.php");

}

?>
