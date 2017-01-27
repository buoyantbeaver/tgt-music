<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<link href="skins/default/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../styles/admin.js"></script>
<body topmargin="0" leftmargin="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="style_border" width="7" >&nbsp;
</td>
<td valign="top" class="style">
<table width="100%" height="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td valign="top" class="style_bg">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="title_c">Thên / sửa banner</td>
</tr>
</table>
</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<form action="<?=$action;?>" method="post" enctype="multipart/form-data">
<table width=100% align=center cellpadding="0" cellspacing="0">
<tr>
<td class=frz width=100px>Tên banner</td><td class=frz><input type=text name="ten_banner" size=50 value="<?=$arrz[0][1];?>"></td></tr>
<tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
<td class=frz width=100px>Link banner</td><td class=frz><input type=text name="link_banner" size=50 value="<?=$arrz[0][4];?>"></td></tr>
<tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
<tr><td class=frz width=100px>File</td><td class=frz><input type="file" name="img" size=50><?=$arrz[0][3];?></td></tr>
<tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
<tr><td class=frz width=100px>Phân loại</td><td class=frz>
<select name="phan_loai">
	<option value=0<? if($arrz[0][5]==0) echo ' selected';?>>Ảnh</option>
    <option value=1<? if($arrz[0][5]==1) echo ' selected';?>>Flash</option>
</select>
</td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
<tr><td class=frz width=100px>Vị trí hiện thị </td><td class=frz>
<select name="vitri">
<option value="top_banner_home"<? if($arrz[0][2]=='top_banner_home') echo ' selected';?>>Top banner (Trang chủ) (1006 x auto)</option>
<option value="top_banner_play_mp3"<? if($arrz[0][2]=='top_banner_play_mp3') echo ' selected';?>>Top banner (Trang Play Mp3) (1006 x auto)</option>
<option value="top_banner_play_video"<? if($arrz[0][2]=='top_banner_play_video') echo ' selected';?>>Top banner (Trang Play Video) (1006 x auto)</option>
<option value="top_banner_play_album"<? if($arrz[0][2]=='top_banner_play_album') echo ' selected';?>>Top banner (Trang Play Album) (1006 x auto)</option>
<option value="top_banner_category"<? if($arrz[0][2]=='top_banner_category') echo ' selected';?>>Top banner (Trang Thể Loại) (1006 x auto)</option>
<option value="top_banner_search"<? if($arrz[0][2]=='top_banner_search') echo ' selected';?>>Top banner (Trang Tìm kiếm) (1006 x auto)</option>
<option value="top_banner_bxh"<? if($arrz[0][2]=='top_banner_bxh') echo ' selected';?>>Top banner (Trang Bảng Xếp Hạng) (1006 x auto)</option>

<option value="banner_footer"<? if($arrz[0][2]=='banner_footer') echo ' selected';?>>Footer banner (Dưới footer) (1006 x auto)</option>

	<option value="play_mp3"<? if($arrz[0][2]=='play_mp3') echo ' selected';?>>Play MP3 (633 x auto)</option>
	<<option value="play_video"<? if($arrz[0][2]=='play_video') echo ' selected';?>>Play VIDEO (633 x auto)</option>
	<option value="home_left"<? if($arrz[0][2]=='home_left') echo ' selected';?>>Trang chủ - Left(140 x auto)</option>
    <option value="home_center_1"<? if($arrz[0][2]=='home_center_1') echo ' selected';?>>Trang chủ - Center 1(485 x auto)</option>
    <option value="home_center_2"<? if($arrz[0][2]=='home_center_2') echo ' selected';?>>Trang chủ - Center 2(485 x auto)</option>
    <option value="home_right_1"<? if($arrz[0][2]=='home_right_1') echo ' selected';?>>Trang chủ - Right 1(345 x auto)</option>
    <option value="home_right_2"<? if($arrz[0][2]=='home_right_2') echo ' selected';?>>Trang chủ - Right 2(345 x auto)</option>
    <option value="play_right"<? if($arrz[0][2]=='play_right') echo ' selected';?>>Trang nghe nhạc - Right (345 x auto)</option>
    <option value="the_loai"<? if($arrz[0][2]=='the_loai') echo ' selected';?>>Trang Thể loại - Right (345 x auto)</option>
    <option value="tim_kiem"<? if($arrz[0][2]=='tim_kiem') echo ' selected';?>>Trang Tìm kiếm - Right (300 x auto)</option>
</select>
</td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
<tr><td class=frz width=100px>Status </td><td class=frz>
<select name="status">
	<option value="0"<? if($arrz[0][7]==0) echo ' selected';?>>Yes</option>
    <option value="1"<? if($arrz[0][7]==1) echo ' selected';?>>No</option>
</select>
</td>
</tr>
<tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
<tr><td class=frz width=100px>Số thứ tự</td><td class="frz"><input type=text name="stt" size=10 value="<?=$arrz[0][6];?>"></td></tr>
<tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
<tr>
<td align="left" colspan="2"  class="menu" >
<input class="button" type="submit" name="submit" value="Gửi đi">
<input class="button" type="reset" value="Nhập lại">
</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>