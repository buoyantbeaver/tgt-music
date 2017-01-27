<div class="box w_2">
<h1>Quên mật khẩu ?</h1>
	<div style="padding: 10px;">
<?

if($_SESSION['tgt_user_id']) mss("Bạn vui lòng thoát.","./index.php");

else {


if($_POST['sendpass']) {
	
	$email 	= addslashes(urldecode($_POST['email']));

	$arr = $tgtdb->databasetgt("userid, salt ","user"," email = '".$email."'");
	if($email == ""){
		mss("Vui lòng nhập email!",'./Member/Quen-Mat-Khau.html');
	}
	else if($arr){
		$pass =	rand(1000000,9999999);
		$pwd = md5(md5($pass) . $arr[0][1]);
		@mysql_query("UPDATE tgt_nhac_user SET pass_new = '".$pwd."' WHERE userid = '".$arr[0][0]."'");
		# cấu hình gửi email
		$pfw_header = "[ ".NAMEWEB." ] - Mật Khẩu Mới";
		$pfw_subject = "[ ".NAMEWEB." ] - Mật Khẩu Mới"; // tiêu đề email
		$pfw_email_to = $email;
		$pfw_message = "Mật khẩu mới của bạn là : $pass\n"
				. "Vui lòng truy cập vào ".NAMEWEB." và đổi lại mật khẩu của bạn ngay sau khi đăng nhập\n"
				. "-----------------------------------------------------------------\n"
				. "Hệ Thống Liên Hệ ".NAMEWEB."\n"
				. "[C] TGT - 4.5 \n";
				
		$send_mail = @mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header ) ;
		if($send_mail) mss("Mật khẩu mới của bạn đã được gửi tới Email : !".$email." Bạn vui lòng kiểm tra lại hộp mail của bạn !",'./index.php');
		else mss("Hostting của bạn không hỗ trợ hàm gửi mail",'./index.php');
	}
	else {
		mss("Email của bạn không tồn tại trên hệ thống website!",'./Member/Quen-Mat-Khau.html');
	}

}



?>
			<form method="post">
            <table width="100%" cellpadding="5" cellspacing="5">
            <tr>
            <td align="right" width="170">Email của bạn </td><td  width="300"><input type="text" name="email" size="40" /></td>
            <td align="left"><input type="submit" class="_add_" name="sendpass" value="Gửi đi" /></td>
            </tr>
		</table>

            </form>

			<? } ?>
    </div>
</div>