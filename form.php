<?php
$_GET['action'] = (isset($_GET['action'])) ? $_GET['action'] :
'';
if ($_GET['action'] == 'send') {
if (empty($_POST['name']) || empty($_POST['sender']) || empty($_POST['subject']) || empty($_POST['text']))
// Ki?m tra các thông tin trong field
{
echo '<p>Vui l&#x00F2;ng nh&#x1EAD;p &#x0111;&#x1EA7;y &#x0111;&#x00F9; th&#x00F4;ng tin!</p>';
} else {
extract($_POST);
$ip = $_SERVER['REMOTE_ADDR'];
$email = "minhdoanpro@yahoo.com"; //Đổi Thành mail của bạn 
$mailmsg = "Họ và Tên: $name\n";
$mailmsg .= "Địa chỉ Email: $sender\n";
$mailmsg .= "Yahoo: $subject\n";
$mailmsg .= "IP: $ip\n\n";
$mailmsg .= "Lỗi: $text";
if (mail($email, $subject, $mailmsg, "From: $sender\n"));
{
print("<p>G&#x1EED;i th&#x00E0;nh c&#x00F4;ng! C&#x1EA3;m &#x01A1;n b&#x1EA1;n &#x0111;&#x00E3; th&#x00F4;ng b&#x00E1;o cho ch&#x00FA;ng t&#x00F4;i.</p>");
}
}
}
?>