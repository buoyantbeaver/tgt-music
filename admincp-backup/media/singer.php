<?php
define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../../tgt/class.inputfilter.php");
include("../../tgt/securesession.class.php");
include("../fckeditor/fckeditor.php");
include("../functions.php");
$myFilter = new InputFilter();
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
if(isset($_GET["sethot"])) $sethot=$myFilter->process($_GET["sethot"]);
if(isset($_GET["bohot"])) $bohot=$myFilter->process($_GET["bohot"]);

if($sethot) {
	mysql_query("UPDATE tgt_nhac_singer SET singer_hot = 1 WHERE singer_id = '".$sethot."'");
	mss ("Update xong ","list_singer.php");
}
if($bohot) {
	mysql_query("UPDATE tgt_nhac_singer SET singer_hot = 0 WHERE singer_id = '".$bohot."'");
	mss ("Update xong ","list_singer.php");
}
if ($del_id) {
	if ($_POST['submit']) {
		$del_id	= del_id($del_id);
		$arr_img = $tgtdb->databasetgt(" singer_img ","singer"," singer_id = '".$del_id."'");
		delFile($arr_img[0][0]);
		mysql_query("DELETE FROM tgt_nhac_singer WHERE singer_id = '".$del_id."'");
		mss ("Đã xóa xong ","list_singer.php");
	}

	?>
    <table align="center" width="100%" style="border: 1px solid red;">
    <form method="post">Bạn có muốn xóa ca sĩ này không ? <input class="sutm" value="Có" name="submit" type="submit" class="submit"></form>
    </table><?
}
// ADD
if($mode == 'add') {
	if(isset($_POST['submit'])) {
		if($_POST['name'] == "") {
			mss ("Chưa nhập đầy đủ thông tin ");
		}
			else {
			$singer			=	htmlchars(stripslashes(trim(urldecode($_POST['name']))));
			$singer_ascii	=	strtolower(get_ascii($singer));
			if(move_uploaded_file ($_FILES['img']['tmp_name'],FOLDER_SINGER."/[TGT-music]-".time()."-".$_FILES['img']['name'])) {
			$img = LINK_SINGER."/[TGT-music]-".time()."-".$_FILES['img']['name'];
			}else $img		=	$_POST['imgz'];
			$type			=	$_POST['singer_type'];
			$info			=	htmlchars($_POST['info']);
			$action		 	= "singer.php?mode=add";
			mysql_query("INSERT INTO tgt_nhac_singer (singer_name,singer_name_ascii,singer_img,singer_type,singer_info) 
						 VALUES ('".$singer."','".$singer_ascii."','".$img."','".$type."','".$info."')");
			mss ("Thêm ca sĩ mới thành công ","media.php?mode=add");
		}
	}
include("singer_act.php"); 
}
if($mode == 'edit') {
		$id	= del_id($id);
		$arrz = $tgtdb->databasetgt(" * ","singer"," singer_id = '$id'");
		$action			= "singer.php?mode=edit&id=".en_id($id);
		if(isset($_POST['submit'])) {
			if($_POST['name'] == "") {
				mss ("Chưa nhập đầy đủ thông tin ");
			}
				else {
					$singer		=	htmlchars(stripslashes(trim(urldecode($_POST['name']))));
					$singer_ascii	=	strtolower(get_ascii($singer));
					if(move_uploaded_file ($_FILES['img']['tmp_name'],FOLDER_SINGER."/[TGT-music]-".time()."-".$_FILES['img']['name'])) {
						delFile($arrz[0][3]);
						$img = LINK_SINGER."/[TGT-music]-".time()."-".$_FILES['img']['name'];
					}else $img		=	$_POST['imgz'];

					$type		=	$_POST['singer_type'];
					$info			=	htmlchars($_POST['info']);
					mysql_query("UPDATE tgt_nhac_singer SET
						singer_name			=  	'".$singer."',
						singer_name_ascii 	= 	'".$singer_ascii."',
						singer_img			= 	'".$img."',
						singer_type			= 	'".$type."',
						singer_info			= 	'".$info."'
						WHERE singer_id 	= 	'".$id."'");
				mss ("sửa ca sĩ thành công ","list_singer.php");
			}
		}
	include("singer_act.php");
}
?>

