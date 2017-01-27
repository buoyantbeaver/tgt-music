<?php
define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<? echo acp_cat(2); echo acp_singer(); echo acp_album_list(); echo acp_add_cat(0); echo acp_singer_type(0);?>
</body>
</html>
