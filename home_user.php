<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/functions_user.php");
include("./tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["act"])) $act=$myFilter->process($_GET["act"]);
if(isset($_GET["id"])) $id=$myFilter->process($_GET["id"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Đăng ký thành viên</title>
<meta name="title" content="Đăng ký thành viên" />
<meta name="keywords" content="Đăng ký thành viên" />
<meta name="description" content="Đăng ký thành viên" />
<META name="y_key" content="891c2c92e9de3e04">
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents">
    	<div id="m_1">
            <? include("./theme/ip_singer_hot.php");?>
        </div>
        <!--2-->
        <div id="m_2">
					<?php
                    $link = '/home_user.php?';
                    if($_SERVER["QUERY_STRING"]) $link .= $_SERVER["QUERY_STRING"];
                    switch($act){
                        default					:include("./user/dang_ky.php");break;
                        case "Dang-Ky"			:include("./user/dang_ky.php");break;
						case "Quen-Mat-Khau"	:include("./user/reset_pass.php");break;
						case "Doi-Thong-Tin"	:include("./user/user_edit.php");break;
						case "Doi-Mat-Khau"		:include("./user/user_pass.php");break;
						case "Z"				:include("./user/user_info.php");break;
                    }
                    ?>
        </div>
        <!--3-->
        <div id="m_3">
        	<? include("./theme/ip_bxh_mp3.php");?>
        	<? include("./theme/ip_bxh_video.php");?>
        </div>
        <div class="clr"></div>
    </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>
<? 
//}
//$cache->close();
?>