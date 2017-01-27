<?php
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
include("../tgt/class.inputfilter.php");
include("../tgt/securesession.class.php");

$myFilter = new InputFilter();
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
$ss->Open();
		  
if(isset($_GET["act"]) && $_GET["act"] == "login"){
	$username = mysql_real_escape_string($myFilter->process($_POST["user"]));
	$password =mysql_real_escape_string($myFilter->process($_POST["pass"]));
	$pass2 =mysql_real_escape_string($myFilter->process($_POST["pass2"]));
	$arr = $tgtdb->databasetgt(" userid, username, password, salt , user_level ","user"," username = '".$username."'");
	$pass_new = md5(md5($password) . $arr[0][3]);
	if (count($arr)<1) { 
		mss("Tên đăng nhập không tồn tại !","index.php");
		exit();
	}
	elseif ($pass_new != $arr[0][2]) {
		mss("Mật khẩu không đúng !","index.php");
		exit();
	}
	elseif ($pass2 != PASS2ADMIN) {
		mss("Mật khẩu không đúng !","index.php");
		exit();
	}
	elseif ($arr[0][4] == 3) {
			$_SESSION["username"] = $username;
			$_SESSION["admin_id"] = $arr[0][0];
			$_SESSION["rights"] = $arr[0][2];
			mss("Chào mừng ".$_SESSION["username"]." đến với admincp !","index.php");
			exit();
	}
	else {
		mss("Bạn không có quyền vào trang này !","index.php");
		exit();
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Administration Area</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="js/functions.js" language="JavaScript" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<style>
.border { border: 1px solid #cfcfcf;}
</style>
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="350"  border="0" cellspacing="0" cellpadding="1" align="center">
  <tr>
    <td><strong><?php echo VER?> - ADMINISTRATOR</strong></td>
  </tr>
  <tr>
    <td><table width="100%" class="border" border="0" cellspacing="0" cellpadding="3" align="center"  >
        <form name="signin" method="post" action="login.php?act=login">
          <tr>
            <td colspan="2" class="menu_o">ĐĂNG NHẬP</td>
          </tr>
          <tr >
            <td width="40%" align="right">Tên đăng nhập</td>
            <td width="60%" class="row2td"><input type="text" value="" name="user" class="input"></td>
          </tr>
          <tr >
            <td align="right">Mật khẩu</td>
            <td ><input type="password" name="pass" value="" class="input"></td>
          </tr>
          <tr >
            <td align="right">Mật khẩu II</td>
            <td ><input type="password" name="pass2" value="" class="input"></td>
          </tr>
          <tr >
            <td></td>		  
            <td ><input type="submit" name="login" class="sutm" value=" LOGIN "></td>
          </tr>
        </form>
      </table></td>
  </tr>
  <tr>
    <td align="center">Powered by <a href="http://portaldn.com" target="_blank">Portal</a> code by ichphien_pro</td>
  </tr>
</table>
</body>
</html>