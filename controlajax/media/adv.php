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

if(isset($_GET["act"])) 	$act	=	$myFilter->process($_GET["act"]);
if(isset($_GET["del_id"])) 	$del_id	=	$myFilter->process($_GET["del_id"]);
if(isset($_GET["id"])) 		$id		=	$myFilter->process($_GET["id"]);
if(isset($_GET["p"])) 		$page	=	$myFilter->process($_GET["p"]);

if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}
if($del_id) {
		$arr_img = $tgtdb->databasetgt(" adv_img ","adv"," adv_id = '".$del_id."'");
		delFile($arr_img[0][0]);
		mysql_query("DELETE FROM tgt_nhac_adv WHERE adv_id = '".$del_id."'");
		mss ("Đã xóa xong ","adv_list.php");
}
elseif($act == 'add') {
	$action	=	'adv.php?act=add';
	if($_POST['submit']) {
		$ten_banner 	 = stripslashes(trim(urldecode($_POST['ten_banner'])));
		$link_banner 	 = stripslashes(trim(urldecode($_POST['link_banner'])));
		$phan_loai 	 	 = stripslashes(trim(urldecode($_POST['phan_loai'])));
		$vitri 	 	 	 = stripslashes(trim(urldecode($_POST['vitri'])));
		$stt 	 	 	 = stripslashes(trim(urldecode($_POST['stt'])));
		$status		 	 = stripslashes(trim(urldecode($_POST['status'])));
		if(move_uploaded_file ($_FILES['img']['tmp_name'],ADV_FOLDER_ABSOLUTE."/".time()."-".$_FILES['img']['name'])) {
			$file = ADV_FOLDER."/".time()."-".$_FILES['img']['name'];
			mysql_query("INSERT INTO tgt_nhac_adv (adv_name,adv_vitri,adv_img,adv_url,adv_phanloai,adv_stt,adv_status) 
							 VALUES ('".$ten_banner."','".$vitri."','".$file."','".$link_banner."','".$phan_loai."','".$stt."','".$status."')");
			mss('Chưa xong','adv_list.php');
		}else { 
		mysql_query("INSERT INTO tgt_nhac_adv (adv_name,adv_vitri,adv_img,adv_url,adv_phanloai,adv_stt,adv_status) 
							 VALUES ('".$ten_banner."','".$vitri."','".$file."','".$link_banner."','".$phan_loai."','".$stt."','".$status."')");
		
			mss('Đã thêm xong','adv_list.php');
		}
	}
	include("adv_act.php");
}
elseif($act == 'edit') {
	$action	=	'adv.php?act=edit&id='.$id;
	$arrz	=	$tgtdb->databasetgt(" * ","adv"," adv_id = '".$id."' ");
	if($_POST['submit']) {
		$ten_banner 	 = stripslashes(trim(urldecode($_POST['ten_banner'])));
		$link_banner 	 = stripslashes(trim(urldecode($_POST['link_banner'])));
		$phan_loai 	 	 = stripslashes(trim(urldecode($_POST['phan_loai'])));
		$vitri 	 	 	 = stripslashes(trim(urldecode($_POST['vitri'])));
		$stt 	 	 	 = stripslashes(trim(urldecode($_POST['stt'])));
		$status		 	 = stripslashes(trim(urldecode($_POST['status'])));
		if(move_uploaded_file ($_FILES['img']['tmp_name'],ADV_FOLDER_ABSOLUTE."/".time()."-".$_FILES['img']['name'])) {
			delFile($arrz[0][3]);
			$file = ADV_FOLDER."/".time()."-".$_FILES['img']['name'];
		}else 		
		
		mysql_query("UPDATE tgt_nhac_adv SET 	adv_name 		= '".$ten_banner."',
												adv_url			= '".$link_banner."',
												adv_phanloai	= '".$phan_loai."',
												adv_vitri		= '".$vitri."',
												adv_stt			= '".$stt."',
												adv_status		= '".$status."',
												adv_img			= '".$file."' WHERE adv_id	=	'".$id."'");
		mss("Đã sửa xong !","adv_list.php");
	}
	include("adv_act.php");
}
elseif($act == "status") {
	if(isset($_GET["status"])) $status = $myFilter->process($_GET["status"]);
	mysql_query("UPDATE tgt_nhac_adv SET adv_status = '".$status."' WHERE adv_id = '".$id."'");
	header("Location: adv_list.php");
	exit();
}
?>