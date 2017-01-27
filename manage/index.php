<?php
session_start();
include("../tgt/securesession.class.php");
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
if (!$ss->Check() || !isset($_SESSION["username"]) || !$_SESSION["username"])
{
header('Location: login.php');
die();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý Website <? echo substr(SITE_LINK,0,-1); ?> | IPOS 1.2</title>

</head>


	<frameset cols="170,*" FRAMEBORDER="0" border=0>

		<frame name="menu" scrolling="auto" src="menu.php" FRAMEBORDER="0" MARGINWIDTH=0 NORESIZE >

		<frame name="content" id="content"  src="media/library.php" FRAMEBORDER="0" MARGINWIDTH=0 NORESIZE  >

	</frameset>	

</frameset>

<noframes></noframes>

