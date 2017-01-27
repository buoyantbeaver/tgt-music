<?php
define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../../tgt/class.inputfilter.php");
include("../../tgt/securesession.class.php");
include("../../tgt/class.upload.php");
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
		mysql_query("DELETE FROM tgt_nhac_user WHERE userid = '".$del_id."'");
		mss ("Đã xóa xong ","list_user.php");
	}
	?>
    <table align="center" width="100%" style="border: 1px solid red;">
    <form method="post">Bạn có muốn xóa thành viên này không ? <input class="sutm" value="Có" name=submit type=submit class=submit></form>
    </table><?
}

function acp_level($lv) {
	$html = "<select name=lv>".
		"<option value=1".(($lv==1)?' selected':'').">Member</option>".
		"<option value=3".(($lv==3)?' selected':'').">Admin</option>".
	"</select>";
	return $html;
}
// ADD SONGS
if($mode == 'add') {
	if(isset($_POST['submit'])) {
		if($_POST['name'] == "") {
			mss ("Chưa nhập đầy đủ thông tin ");
		}
		if($_POST['name']) { 	
			$name		 = htmlchars(stripslashes(trim(urldecode($_POST['name']))));			
			$pass		 = htmlchars(stripslashes(trim(urldecode($_POST['pass']))));
			$email		 = htmlchars(stripslashes(trim(urldecode($_POST['email']))));
			$lv			 = htmlchars(stripslashes(trim(urldecode($_POST['lv']))));
			$st			 = rand(1000,9999);
			$pwd		 = md5(md5($pass) . $st);
			$action		 = "user.php?mode=add";
			mysql_query("INSERT INTO tgt_nhac_user (username,email,password ,user_level,salt) 
						 VALUES ('".$name."','".$email."','".$pwd."','".$lv."','".$st."')");
			mss ("Thêm thành viên mới thành công ","user.php?mode=add");
		}
	}
include("user_act.php"); }
if($mode == 'edit') {
		$arrz = $tgtdb->databasetgt(" username,email,user_level,salt,password ","user"," userid = '$id'");
		$action		= "user.php?mode=edit&id=".$id;
		if($_POST['submit']) {
			$name		 = htmlchars(stripslashes(trim(urldecode($_POST['name']))));	
			$pass		 = htmlchars(stripslashes(trim(urldecode($_POST['pass']))));
			$email		 = htmlchars(stripslashes(trim(urldecode($_POST['email']))));
			$lv			 = htmlchars(stripslashes(trim(urldecode($_POST['lv']))));
			if($_POST['pass'] == "") {
				$pwd = $arrz[0][4];
			}
			else {
				$st			 = $arrz[0][3];
				$pwd		 = md5(md5($pass) . $st);
			}

			mysql_query("UPDATE tgt_nhac_user SET
					username		=  	'".$name."',
					password	 	= 	'".$pwd."',
					email			= 	'".$email."',
					user_level		= 	'".$lv."' WHERE userid	= '".$id."'");
				mss ("sửa thành viên thành công ","list_user.php");
		}
	include("user_act.php");

}
?>
