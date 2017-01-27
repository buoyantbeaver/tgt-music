<div class="box w_2">
<h1>Đăng ký thành viên</h1>
	<div style="padding: 10px;">
<?
if($_SESSION['tgt_user_id'])
	mss("Bạn Đã đăng nhập","./index.php");
else {

if($_POST['dang_ky']) {

	$name 	= addslashes(urldecode($_POST['name']));
	$pass 	= addslashes(urldecode($_POST['pass']));
	$pass2 	= addslashes(urldecode($_POST['pass2']));
	$email 	= addslashes(urldecode($_POST['email']));
	
	if($name == "" || $pass == "" || $pass2 == "" || $email == "") {
		mss("Vui lòng nhập đầy đủ thông tin !","./Member/Dang-Ky.html");
	}
	elseif ($pass != $pass2) {
		mss("Mật khẩu ko giống nhau !","./Member/Dang-Ky.html");
	}
	elseif (mysql_num_rows(mysql_query("SELECT userid FROM tgt_nhac_user WHERE username = '".$name."'",$link_music))) {
		mss("Tài khoản này đã có người sử dụng","./Member/Dang-Ky.html");
	}
	elseif (mysql_num_rows(mysql_query("SELECT userid FROM tgt_nhac_user WHERE email = '".$email."'",$link_music))) {
		mss("Email này đã có người sử dụng","./Member/Dang-Ky.html");
	}
	else {
	$salt = rand(100000,999999);
	$pwd = md5(md5($pass) . $salt);
	mysql_query("INSERT INTO tgt_nhac_user (username,password,email,salt,time) VALUES ('".$name."','".$pwd."','".$email."','".$salt."','".time()."')");
	header("Location: ../index.php");
	}
}

?>
			<form method="post">
            <table width="100%" cellpadding="5" cellspacing="5">
            <tr>
            <td align="right" width="150">User Name</td><td><input type="text" name="name" size="50" /></td></tr>
            <tr>
            <td align="right">Mật khẩu</td><td><input type="password" name="pass" size="50" /></td></tr>
            <tr>
            <td align="right">Nhập lại mật khẩu</td><td><input type="password" name="pass2" size="50" /></td></tr>
            <tr>
            <td align="right">Email</td><td><input type="email" name="email" size="50" /></td></tr>
            <tr>
            <td align="center" colspan="2">
            <input type="submit" name="dang_ky" class="_add_" value="Đăng ký" />  <input class="_add_" type="reset" value="Nhập lại" />
            </td></tr></table>
            </form>
            <? } ?>
    </div>
</div>