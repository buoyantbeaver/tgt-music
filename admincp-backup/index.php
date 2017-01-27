<?php
session_start();
include("../tgt/securesession.class.php");
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

<html>
<head>

<title>Quan tri website</title>	

</head>

<frameset rows="67,*" cols="*" frameborder="no" border="0" framespacing="0">

  <frame src="header.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />

	<frameset cols="170,*" FRAMEBORDER="0" border=0>

		<frame name="menu" scrolling="auto" src="menu.php" FRAMEBORDER="0" MARGINWIDTH=0 NORESIZE >

		<frame name="content" id="content"  src="media/library.php" FRAMEBORDER="0" MARGINWIDTH=0 NORESIZE  >

	</frameset>	

</frameset>

<noframes></noframes>

