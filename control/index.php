<?php
session_start();
include("../tgt/securesession.class.php");
include("../tgt/lang.php");
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
<title><?=$lang[admincp]?> | <?=$lang[sitename]?></title>	
</head>

<body style="margin:0">

<iframe name="menu" id="content" src="menu.php" style="position:absolute;left:0;width:170px;height:100%;border:none;" scrolling="auto"></iframe>

<iframe name="content" id="content" src="media/library.php" style="width:100%;height:100%;border:none;margin-left:170px;"></iframe>

</body>



