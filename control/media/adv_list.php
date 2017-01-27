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
<script type="text/javascript" src="../styles/admin.js">
</script>
</head>
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
<td class="title_c" style="padding: 5px;">Danh sách banner</td>
</tr>
</table>
</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<table width=100% align=center cellpadding="0" cellspacing="0">
                    <tr >
                      <td nowrap class="menu" width="1%">STT</td>
                      <td width="30%" align="center" nowrap class="menu">Tên banner</td>
                      <td width="30%" align="center" nowrap class="menu">Vị trí</td>
					  <td width="5%" align="center" nowrap class="menu">trạng thái</td>
                      <td width="10%" align="center" nowrap class="menu">actions</td>				  
                    </tr>
<?php
	$arr = $tgtdb->databasetgt(" adv_id ,adv_name ,adv_vitri , adv_status,adv_stt ","adv"," adv_id != 0 ORDER BY adv_stt ASC");
	for($i=0;$i<count($arr);$i++) {
		if($arr[$i][3]==0)	$status	=	'<a href="adv.php?act=status&status=1&id='.$arr[$i][0].'">Hiện</a>';
		if($arr[$i][3]==1)	$status	=	'<a class=\"no\" href="adv.php?act=status&status=0&id='.$arr[$i][0].'">Ẩn</a>';
	?>
        <tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#fff'">
        <td align="center"><?=$arr[$i][4];?></td>
        <td align="center"><?=$arr[$i][1];?></td>
        <td align="center"><?=$arr[$i][2];?></td>
        <td align="center"><?=$status;?></td>
        <td align="center"><a href="adv.php?act=edit&id=<?=$arr[$i][0];?>" title="Edit"><img src="../images/edit.png" width="16" height="16" border="0"></a> <a href="adv.php?del_id=<?=$arr[$i][0];?>" title="Xóa"  onClick="return ask()" ><img src="../images/b_delete.png" width="11" height="14" border="0"></a></td>
        </tr>
        <tr><td colspan="7" height="1" bgcolor="#CCCCCC"></td></tr>
       <? } ?>
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
<script>
function ask(){
	if (confirm("Bạn có muốn xóa quảng cáo này ?")) return true;
	return false ;
}
</script>