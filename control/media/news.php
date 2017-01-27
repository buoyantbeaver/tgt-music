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

if ($del_id) {
	if ($_POST['submit']) {
		if($del_id == 1 || $del_id == 2) mss ("Không thể xóa tin tức này ","list_news.php");
		else {
			$arr_img = $tgtdb->databasetgt(" news_img ","news"," news_id = '".$del_id."'");
		$img_az = $_SERVER["DOCUMENT_ROOT"] ."/mp3/".$arr_img[0][0];
		unlink($img_az);
		mysql_query("DELETE FROM tgt_nhac_news WHERE news_id = '".$del_id."'");
		mss ("Đã xóa xong ","list_news.php");
		}
	}
	?>
    <table align="center" width="100%" style="border: 1px solid red;">
    <form method="post">Bạn có muốn xóa tin tức này không ? <input class="sutm" value="Có" name=submit type=submit class=submit></form>
    </table><?
}


// ADD NEWS
if($mode == 'add') {
	if(isset($_POST['submit'])) {
		if($_POST['name'] == "") {
			mss ("Chưa nhập đầy đủ thông tin ");
		}
			else {
			$news_title			=	htmlchars(stripslashes(trim(urldecode($_POST['name']))));
			$news_title_ascii	=	strtolower(get_ascii($news_title));
			if(move_uploaded_file ($_FILES['img']['tmp_name'],FOLDER_SINGER."/alohot.net-".time()."-".$_FILES['img']['name'])) {
			$img = LINK_SINGER."/alohot.net-".time()."-".$_FILES['img']['name'];
			}else $img		=	$_POST['img'];
			$cat			=	$_POST['cat'];
			//$cat			= 	htmlspecialchars($cat);
			//$info			=	htmlspecialchars($_POST['info']);
			$action		 	= "news.php?mode=add";
			echo $cat;
			mysql_query("INSERT INTO tgt_nhac_news (news_title,news_title_ascii,news_cat,news_img,news_info) 
						 VALUES ('".$news_title."','".$news_title_ascii."','".htmlspecialchars($cat)."','".$img."','".htmlspecialchars($info)."')");
			mss ("Thêm tin tức mới thành công ","news.php?mode=add");
		}
	}
include("news_act.php"); 
}

if($mode == 'edit') {
		$arrz = $tgtdb->databasetgt(" * ","news"," news_id = '$id'");
		$action			= "news.php?mode=edit&id=".$arrz[0][0];
		if(isset($_POST['submit'])) {
			if($_POST['name'] == "") {
				mss ("Chưa nhập đầy đủ thông tin ");
			}
			else {
			$news_title			=	htmlchars(stripslashes(trim(urldecode($_POST['name']))));
			$news_title_ascii	=	strtolower(get_ascii($news_title));
			if(move_uploaded_file ($_FILES['img']['tmp_name'],FOLDER_SINGER."/mp3.kinhmon.biz-".time()."-".$_FILES['img']['name'])) {
			$img = LINK_SINGER."/mp3.kinhmon.biz-".time()."-".$_FILES['img']['name'];
			}else $img		=	$_POST['img'];
			$cat			=	$_POST['cat'];
			//$cat = htmlspecialchars($cat);
			$info			=	$_POST['info'];
			//$info			=   htmlspecialchars($info);
			$action		 	= "news.php?mode=edit";
			

					mysql_query("UPDATE tgt_nhac_news SET
						news_title			=  	'".$news_title."',
						news_title_ascii 	= 	'".$news_title_ascii."',
						news_cat			= 	'".htmlspecialchars($cat,ENT_QUOTES)."',
						news_img			= 	'".$img."',
						news_info			= 	'".htmlspecialchars($info)."'						
						WHERE news_id 	= 	'".$id."'");
				mss ("sửa tin tức thành công ","list_news.php");
			}
		}
	include("news_act.php");

}

?>