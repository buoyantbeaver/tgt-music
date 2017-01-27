<div class="box w_2">
<h1>Đổi mật khẩu</h1>
	<div style="padding: 10px;">
<?

if(!$_SESSION['tgt_user_id']) mss("Bạn chưa đăng nhập","./index.php");

else {

$arr = $tgtdb->databasetgt(" password, salt  ","user"," userid = '".$_SESSION['tgt_user_id']."'");

if($_POST['pass_edit'] && $_SESSION['tgt_user_id']) {

	$pass 	= addslashes(urldecode($_POST['pass']));

	$pass2 	= addslashes(urldecode($_POST['pass2']));

	$pwd_0 	= md5(md5($pass) . $arr[0][1]);

	if($pass == "" || $pass2 == "") mss("Vui lòng nhập đầy đủ thông tin !","./Member/Doi-Mat-Khau.html");

	elseif($pwd_0 != $arr[0][0]) mss("Mật khẩu cũ của bạn không đúng !","./Member/Doi-Mat-Khau.html");

	elseif($pass == $pass2) mss("Mật khẩu cũ và mới không được giống nhau!","./Member/Doi-Mat-Khau.html");

	else {

	$pwd = md5(md5($pass2) . $arr[0][1]);

	mysql_query("UPDATE tgt_nhac_user SET password = '".$pwd."',pass_new = '' WHERE userid = '".$_SESSION['tgt_user_id']."'");

	mss("Đổi mật khẩu thành công !",'./index.php');

	}

}



?>

			<form method="post">

            <table width="100%" cellpadding="5" cellspacing="5">

            <tr>

            <td align="right">Mật khẩu cũ</td><td><input type="password" name="pass" size="50" /></td></tr>

            <tr>

            <td align="right">Mật khẩu mới</td><td><input type="password" name="pass2" size="50" /></td></tr>

            <tr>

            <td align="center" colspan="2">

            <input type="submit" class="_add_" name="pass_edit" value="Gửi đi" />

            </td></tr></table>

            </form>

			<? } ?>
	</div>
</div>