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
<title>Functions</title>
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
                <td class="title_c">Chức năng</td>
              </tr>
            </table>
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" >Nhạc/Video</td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=add')" style="padding-left:7px; cursor:pointer;" height="22">Thêm mới Nhạc/Video </td>
              </tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=songs')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách media </td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=clip_music')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách video</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=broken')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách media bị lỗi</td>
              </tr>
                            <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=top_hot')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách top hot</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
                            <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=hq')" style="padding-left:7px; cursor:pointer;" height="19">D/s nhạc 320kps</td>
              </tr>
                            <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/library.php?mode=mem_upload')" style="padding-left:7px; cursor:pointer;" height="19">D/s media mem upload</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>

              
                          </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" >Album</td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/media.php?mode=multi_add_song')" style="padding-left:7px; cursor:pointer;" height="22">Thêm mới Album/Playlist</td>
              </tr>
			  

              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_album.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách album</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_album.php?mode=hot')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách album hot</td>
              </tr>           
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_album.php?mode=tv')" style="padding-left:7px; cursor:pointer;" height="19">D/s album member</td>
              </tr>  
            </table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td class="menu" >Tin tức</td>

</tr>

<tr>

<td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/news.php?mode=add')" style="padding-left:7px; cursor:pointer;" height="22">Thêm mới Tin Tức</td>

</tr>

<tr>

<td height="1" bgcolor="#CCCCCC"></td>

</tr>

<tr>

<td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_news.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh Sách</td>

</tr>

</table>
       
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  class="menu" >Quảng cáo</td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/adv.php?act=add')" style="padding-left:7px;cursor:pointer" height="19">Thêm mới </td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/adv_list.php')" style="padding-left:7px;cursor:pointer" height="19">Danh sách</td>
              </tr>
            </table>
 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" >Singer</td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/singer.php?mode=add')" style="padding-left:7px; cursor:pointer;" height="19">Thêm mới singer </td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_singer.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách singer</td>
              </tr>      
              
            </table>  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" >Thể loại</td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/cat.php?mode=add')" style="padding-left:7px; cursor:pointer;" height="22">Thêm mới thể loại </td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_cat.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách thể loại</td>
              </tr>
            </table>
                 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="menu" >Thành viên</td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/user.php?mode=add')" style="padding-left:7px; cursor:pointer" height="19">Thêm mới user </td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_user.php')" style="padding-left:7px; cursor:pointer" height="19">Danh sách thành viên</td>
              </tr>
            </table>
            
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  class="menu" >Administrator</td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/cau_hinh.php')" style="padding-left:7px; cursor:pointer;" height="19">Cấu hình website</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/chu_de1.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách chủ đề</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/list_cm.php')" style="padding-left:7px; cursor:pointer;" height="19">Danh sách bình luận</td>
              </tr>
              <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'./media/server.php')" style="padding-left:7px; cursor: pointer" height="19">Server chứa nhạc</td>
              </tr>
               <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              <tr>
                <td onMouseOver="bgColor='#c9daf6'" style="padding-left:7px; cursor:pointer;" height="19"><a href="xoa_cache.php" target="_blank">Cập nhật cache website</a></td>
              </tr>
               <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
               <tr>
                <td onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'" onMouseDown="ondown(this,'logout.php')" style="padding-left:7px;cursor:pointer;" height="19"><img src="images/reply.gif" width="14" height="12">&nbsp;&nbsp;&nbsp;Đăng xuất</td>
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
