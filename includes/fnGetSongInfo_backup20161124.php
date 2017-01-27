<?php
$action = $_GET['id'];
switch ($action) {

	case '365': include "fnGetSongInfo_365.htm";
	break;
	
	case 'xxxx': include "fnGetSongInfo_xxxx.htm";
	break;
}
?>

