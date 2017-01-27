<?php

define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../../tgt/class.inputfilter.php");
include("../../tgt/securesession.class.php");
include("../../tgt/class.upload.php");
include("../fckeditor/fckeditor.php");
include("../functions.php");
$myFilter = new InputFilter();
$upload = new UPLOAD_FILES();
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
$ss->Open();
include("../auth.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../temp/js/jquery.js"></script>

<script type="text/javascript" src="../styles/admin.js"></script>
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
function onover(obj,cls){obj.className=cls;}
function onout(obj,cls){obj.className=cls;}
function ondown(obj,url,cls){obj.className=cls; window.location=url;}
//-->
</script>
<body topmargin="0" leftmargin="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="style_border" width="7" >&nbsp;</td>
    <td valign="top" class="style"><table width="100%" height="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td valign="top" class="style_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="title_c">Thêm nhiều Media từ Zing MP3</td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			</table>
				
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding: 20px;">
<?php
if (!$_GET['id']) die('ERROR');
if(isset($_GET["id"])) $id=$myFilter->process($_GET["id"]);
if (!$_POST['submit']) {
?>
<form method=post enctype="multipart/form-data">
<table class=border cellpadding=2 cellspacing=0 width=95%>
<tr><td colspan=2 class=title align=center>Tạo ALbum Mới</td></tr>
<tr>
	<td class=fr width=30%><b>Các bài hát trong album</b></td>
	<td class=fr_2>
	<?php
	$in_sql = $id;
	
	$arr = $tgtdb->databasetgt(" m_title ","data"," m_id IN (".$in_sql.")");
	
	for($i=0;$i<count($arr);$i++) {
	?>
		+ <b><? echo $arr[$i][0];?></b><br>
	<? }
	?>
	</td>
</tr>
<tr>
	<td class=fr width=30%>
		<b>Tạo Album</b>
		<br>Vui lòng điền đầy đủ thông tin</td>
	<td class=fr_2>
    <table>
    <tr>
    <td><font color="red">Tên Album :</font></td><td><input name=new_album size=50></td></tr>
    <tr><td><font color="blue">Loại Album :</font></td><td><select name=singer_type_a>
			<option value=1>Album Việt Nam</option>
			<option value=2>Album Quốc Tế</option>
		</select></td></tr>
   <tr> <td><font color="grenn">Ca sĩ (Album):</font></td><td><input name=new_singer_a size=50></td>
    </tr></table>
	</td>
</tr>
<tr>
	<td class=fr width=30%>
		<b>Ảnh Album</b></td>
	<td class=fr_2>
		 File : <input name=album_img type=file size=50>
        <br />
         Link : <input name=album_img type=text size=50>
	</td>
</tr>
<tr>
	<td class=fr width=30%><b>Thể loại</b></td>
	<td class=fr_2><?=acp_cat(NULL,1)?></td>
</tr>
<tr><td class=fr colspan=2 align=center><input type=submit name=submit class=submit value="Thêm Album"></td></tr>
</table>
</form>
<?php
}
else {
	$cat = implode(',',$_POST['cat']);
	$cat		 = ",".$cat.",";
	$singer = them_moi_singer($_POST['new_singer_a'], $_POST['singer_type_a']);
	if ($_POST['new_album']) {
			if(move_uploaded_file ($_FILES['album_img']['tmp_name'],FOLDER_ALBUM."/[TGT-music]-".time()."-".$_FILES['album_img']['name']))
			$album_img = LINK_ALBUM."/[TGT-music]-".time()."-".$_FILES['album_img']['name'];
			else $album_img = $_POST['album_img'];
			$album = them_moi_album($_POST['new_album'],$singer,$album_img,$cat,$id);
			}
	mss ("Đã thêm xong ! ","list_album.php");
}
?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>