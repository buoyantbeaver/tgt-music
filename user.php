<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["act"])) $act=$myFilter->process($_GET["act"]);
if(isset($_GET["id"])) $id=$myFilter->process($_GET["id"]);

if($act == "music/upload") $name_seo = "Bài hát";
if($act == "music/favourite") $name_seo = "Bài hát yêu thích";
if($act == "music/favouritep") $name_seo = "Playlist yêu thích";
if($act == "music/playlist") $name_seo = "Playlist";
if($act == "music/edit-playlist") $name_seo = "Sửa Playlist";
if($act == "video/upload") $name_seo = "Video";
if($act == "video/favourite") $name_seo = "Video yêu thích";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title><? echo $name_seo;?> của <? echo $_SESSION["tgt_user_name"];?> | TGT-music</title>
<meta name="title" content="<? echo $name_seo;?> của <? echo $_SESSION["tgt_user_name"];?> | TGT-music" />
<meta name="keywords" content="<? echo $_SESSION["tgt_user_name"];?>, playlist, album, tong hop, chon loc, chia se" />
<meta name="description" content="Các <? echo $name_seo;?> của <? echo $_SESSION["tgt_user_name"];?> được <? echo $_SESSION["tgt_user_name"];?> sưu tầm chọn lọc chia sẻ trên TGT music" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents"  class="contents_bg box">
		<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
                <td width="120" valign="top">
                    <? include("./theme/ip_user.php");?>
                </td>
                <td width="580" style="padding:0px 5px 0px 0px; border-left: 1px solid #cfcfcf;" valign="top">
					<?php
                    $link = '/user.php?';
                    if($_SERVER["QUERY_STRING"]) $link .= $_SERVER["QUERY_STRING"];
                    switch($act){
                        default							:include("./user/playlist.php");break;
                        case "music/upload"				:include("./user/upload.php");break;
						case "music/favourite"			:include("./user/favourite.php");break;
						case "music/playlist"			:include("./user/playlist.php");break;
						case "music/edit-playlist"		:include("./user/edit_playlist.php");break;
						case "music/favouritep"			:include("./user/favouritep.php");break;
                        case "video/upload"				:include("./user/v_up.php");break;
						case "video/favourite"			:include("./user/v_fav.php");break;
                    }
                    ?>
                </td>
                <td width="300" valign="top">
					
                </td>
            </tr>
        </table> 
     </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>