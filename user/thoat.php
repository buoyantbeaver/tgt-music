<?php
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
if(!$_SESSION["tgt_user_id"]) mss("Bạn chưa đăng nhập.","../index.php");
else {
	_SETCOOKIE("member_id" , "" );
	_SETCOOKIE("pass_hash" , "" );
	$_SESSION["tgt_user_id"] = "";
	$_SESSION["tgt_user_name"] = "";
	mss("Thoát thành công","../index.php");
}
?>