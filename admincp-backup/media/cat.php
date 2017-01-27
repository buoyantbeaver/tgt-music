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

		mysql_query("DELETE FROM tgt_nhac_theloai WHERE cat_id = '".$del_id."'");

		mss ("Đã xóa xong ","list_cat.php");

	}

	?>

    <table align="center" width="100%" style="border: 1px solid red;">

    <form method="post">Bạn có muốn xóa thể loại này không ? <input class="sutm" value="Có" name=submit type=submit class=submit></form>

    </table><?

}





// ADD SONGS

if($mode == 'add') {

	if(isset($_POST['submit'])) {

		if($_POST['name'] == "") {

			mss ("Chưa nhập đầy đủ thông tin ");

		}

			else {

			$cat_name		=	htmlchars(stripslashes(trim(urldecode($_POST['name']))));

			$stt			=	htmlchars(stripslashes(trim(urldecode($_POST['stt']))));

			$cat_name_ascii	=	strtolower(get_ascii($cat_name));

			$sub			=	htmlchars(stripslashes(trim(urldecode($_POST['sub']))));
			$sub_2			=	htmlchars(stripslashes(trim(urldecode($_POST['sub_2']))));

			$action		 	= 	"cat.php?mode=add";

			mysql_query("INSERT INTO tgt_nhac_theloai (cat_name,cat_order,sub_id,sub_id_2,cat_type) 

					VALUES ('".$name."','".$stt."','".$sub."','".$sub_2."','sub')");

			mss ("Thêm thể loại mới thành công ","cat.php?mode=add");

		}

	}

include("cat_act.php"); 

}



if($mode == 'edit') {

		$arrz = $tgtdb->databasetgt(" * ","theloai"," cat_id = '$id'");

		$action			= "cat.php?mode=edit&id=".$arrz[0][0];

		if(isset($_POST['submit'])) {

			if($_POST['name'] == "") {

				mss ("Chưa nhập đầy đủ thông tin ");

			}

				else {

					$cat_name		=	htmlchars(stripslashes(trim(urldecode($_POST['name']))));
					$stt			=	htmlchars(stripslashes(trim(urldecode($_POST['stt']))));
					$cat_name_ascii	=	strtolower(get_ascii($cat_name));
					$sub			=	htmlchars(stripslashes(trim(urldecode($_POST['sub']))));
					$sub_2			=	htmlchars(stripslashes(trim(urldecode($_POST['sub_2']))));

				mysql_query("UPDATE tgt_nhac_theloai SET
					cat_name		=  	'".$name."',
					cat_order 		= 	'".$stt."',
					sub_id			=	'".$sub."',
					sub_id_2			=	'".$sub_2."' WHERE cat_id = '".$id."'");
				mss ("sửa thể loại thành công ","list_cat.php");
			}
		}
	include("cat_act.php");
}
?>

