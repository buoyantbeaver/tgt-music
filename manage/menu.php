<?php

define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý các chức năng của website <? echo substr(SITE_LINK,0,-1); ?></title>
<link href="styles/style.css" rel="stylesheet" rev="stylesheet">
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
function onover(obj,cls){obj.className=cls;}
function onout(obj,cls){obj.className=cls;}
function ondown(obj,url,cls){	obj.className=cls;	parent.content.location=url;}
function onMenudown(obj,url,url2,cls){parent.menu.location=url;parent.content.location=url2;}
//-->
</script>
<body topmargin="0" leftmargin="0">
<table width="170" height="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="170" valign="top" class="style"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top" class="style_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="title_c">Chức Năng</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr><td class="menu" ><font color="blue"><b>Thêm Media / Video</b></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=add')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Mới Media </td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_add_song')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Nhiều Media</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>


                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_zing')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Zing Album</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_zingz')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Zing Channel</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_singer_zing')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Zing Singer</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_video_singer_zing')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Zing Channel Singer</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
<!--                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_mv_nct')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Video NCT</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_cat_nct')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Thể Loại NCT</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_nct_album')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Album NCT</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr> -->
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_nct')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Album NCT</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_nct_song_cat')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Nhạc NCT</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_nctz')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Video NCT</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>

                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_tuoigi')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Media Tuổi Gì</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td>
              </tr>
            </table>
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
              <td class="menu" ><font color="blue"><b>Quản Lý Chung</b></font></td></tr>
              <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=songs')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Media </td></tr>
              <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
              <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=clip_music')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Video</td></tr>
              <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
              <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=broken')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Media Bị Lỗi</td></tr>
              <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
              <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=top_hot')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách TOP đề cử</td></tr>
              <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
              <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=hq')" style="padding-left:7px; cursor:pointer;" height="19">D/s Nhạc 320kps</td></tr>
              <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
              <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=mem_upload')" style="padding-left:7px; cursor:pointer;" height="19">D/s Media Mem Upload</td>
              <tr><td height="1" bgcolor="#CCCCCC"></td>
             </tr>
           </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" ><font color="blue"><b>Quản Lý Album</b></font></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_album.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Album</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_album.php?mode=hot')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Album Hot</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_album.php?mode=tv')" style="padding-left:7px; cursor:pointer;" height="19">D/s Album Member</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  class="menu" ><font color="blue"><b>Quảng Cáo</b></font></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/adv.php?act=add')" style="padding-left:7px;cursor:pointer" height="19">Thêm Mới </td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/adv_list.php')" style="padding-left:7px;cursor:pointer" height="19">Danh Sách</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" ><font color="blue"><b>Quản Lý Ca Sĩ</b></font></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/singer.php?mode=add')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Mới Singer </td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_singer.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Singer</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" ><font color="blue"><b>Quản Lý Thể Loại</b></font></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/cat.php?mode=add')" style="padding-left:7px; cursor:pointer;" height="19">Thêm Mới Thể Loại </td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_cat.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Thể Loại</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <tr><td class="menu" ><font color="blue"><b>Quản Lý Thành Viên</b></font></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/user.php?mode=add')" style="padding-left:7px; cursor:pointer" height="19">Thêm Mới Thành Viên </td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_user.php')" style="padding-left:7px; cursor:pointer" height="19">Danh Sách Thành Viên</td>
              </tr>
            </table>
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  class="menu" ><font color="blue"><b>Thông Tin Cấu Hình</b></font></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/cau_hinh.php')" style="padding-left:7px; cursor:pointer;" height="19">Cấu Hình Website</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/chu_de.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Chủ đề</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_cm.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách Bình Luận</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/server.php')" style="padding-left:7px; cursor: pointer" height="19">Server Chứa Nhạc</td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" style="padding-left:7px; cursor:pointer;" height="19"><a href="xoa_cache.php" target="_blank"><font color="red"><b>Cập Nhật Cache</b></font></a></td></tr>
                <tr><td height="1" bgcolor="#CCCCCC"></td></tr>
                <tr><td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'logout.php')" style="padding-left:7px;cursor:pointer;" height="19"><img src="images/reply.gif" width="14" height="12">&nbsp;&nbsp;&nbsp;<b>Đăng xuất</b></td>
              </tr>
            </table>
            </td>
        </tr>
        <tr>
          <td valign="bottom" class="style_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="7" align="center" background="./images/bg_line.gif"><img src="./images/line.gif" width="35" height="7"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

