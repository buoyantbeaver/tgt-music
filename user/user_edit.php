<div class="box w_2">
<h1>Đổi thông tin cá nhân</h1>
	<div style="padding: 10px;">
<?
if(!$_SESSION['tgt_user_id']) mss("Bạn chưa đăng nhập","./index.php");
else {
	$arr = $tgtdb->databasetgt(" avatar, email, info, yahoo  ","user"," userid = '".$_SESSION['tgt_user_id']."'");
if($_POST['edit'] && $_SESSION['tgt_user_id']) {
	$avatar 	= addslashes(urldecode($_POST['avatar']));
	$yahoo 	= addslashes(urldecode($_POST['yahoo']));
	$info 	= addslashes(urldecode($_POST['user_info']));
	if($email == "") mss("Bạn chưa nhập tên email !","./Member/Doi-Thong-Tin.html");
	else {
	mysql_query("UPDATE tgt_nhac_user SET avatar = '".$avatar."', info = '".$info."', yahoo = '".$yahoo."' WHERE userid = '".$_SESSION['tgt_user_id']."'");
	//mss("Đổi thông tin thành công !",'./index.php');
	header("Location: ../index.php");
	}
}
?>

			<form method="post">

            <table width="100%" cellpadding="5" cellspacing="5">

            <tr>

            <td align="right" width="150">Avatar</td><td><input type="text" name="avatar" value="<? echo $arr[0][0];?>" size="50" /></td></tr>

            <tr>

            <td align="right">Email</td><td><input type="text" name="email" value="<? echo $arr[0][1];?>" size="50" /></td></tr>

            <tr>

            <td align="right">Yahoo</td><td><input type="text" name="yahoo" value="<? echo $arr[0][3];?>" size="50" /></td></tr>

            <tr>

            <tr>

            <td align="right" valign="top">Thông tin thêm</td><td><textarea name="user_info" style="height:150px; width: 315px;"><? echo $arr[0][2];?></textarea></td></tr>

            <tr>

            <td align="right" colspan="2">

            <input type="submit" class="_add_" name="edit" value="Gửi đi" />

            </td></tr></table>

            </form>

			<? } ?>
    </div>
</div>