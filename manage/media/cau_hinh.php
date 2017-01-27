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


$web_name			=	getConfig('web_name');
$web_key			=	getConfig('web_key');
$domain				=	getConfig('domain');
$cat_vn				=	getConfig('cat_vn');
$cat_hq				=	getConfig('cat_hq');
$cat_am				=	getConfig('cat_am');
$passii				=	getConfig('passii');
$upload				=	getConfig('upload');
$play				=	getConfig('play');

if(isset($_POST['add'])) {
		$web_name			=	$_POST['web_name'];
		$web_key			=	$_POST['web_key'];
		$domain				=	$_POST['domain'];
		$cat_vn				=	$_POST['cat_vn'];
		$cat_hq				=	$_POST['cat_hq'];
		$cat_am				=	$_POST['cat_am'];
		$passii				=	$_POST['passii'];
		$upload				=	$_POST['server'];
		$play				=	$_POST['play'];
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$web_name."' WHERE cf_name = 'web_name'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$web_key."' WHERE cf_name = 'web_key'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$domain."' WHERE cf_name = 'domain'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$cat_vn."' WHERE cf_name = 'cat_vn'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$cat_hq."' WHERE cf_name = 'cat_hq'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$cat_am."' WHERE cf_name = 'cat_am'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$passii."' WHERE cf_name = 'passii'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$upload."' WHERE cf_name = 'upload'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$play."' WHERE cf_name = 'play'");
		mss("Đã sửa xong!","cau_hinh.php");
		exit();
	}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
</head>
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
                    <td class="title_c"> Cấu Hình Website </td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<form name="add" method="post" enctype="multipart/form-data">
				<tr >
                      <td nowrap class="menu" width="25%">Cấu Hình Website</td>
                </tr>
					<tr >
					  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					 	<tr>
                            <td class="frz">Mật khẩu Admin</td>
                            <td class="frz"><input type="text" name="passii"  value="<?=$passii;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td width="200" class="frz">URL Website</td>
                            <td class="frz"><input type="text" name="domain"  value="<?=$domain;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Tên Website</td>
                            <td class="frz"><input type="text" name="web_name"  value="<?=$web_name;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Từ khóa Website</td>
                            <td class="frz"><input type="text" name="web_key"  value="<?=$web_key;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">ID Thể Loại Nhạc Việt Nam</td>
                            <td class="frz"><input type="text" name="cat_vn"  value="<?=$cat_vn;?>" size="5"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">ID Thể Loại Nhạc Hàn Quốc</td>
                            <td class="frz"><input type="text" name="cat_hq"  value="<?=$cat_hq;?>"  size="5"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">ID Thể Loại Nhạc Âu Mỹ</td>
                            <td class="frz"><input type="text" name="cat_am"  value="<?=$cat_am;?>"  size="5"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Server Upload Cho Thành Viên</td>
                            <td class="frz"><?=acp_server($upload)?></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Số Lần + Cho 1 Lần Nghe Nhạc</td>
                            <td class="frz"><input type="text" name="play"  value="<?=$play;?>"  size="5"></td>
                        </tr>
                      </table></td>
				    </tr>
					<tr >
					  <td align="left" class="menu" ><input type="submit" class="button" name="add" value=" ĐỒNG Ý "></td>
				    </tr></form>
            </table>
				
	      </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>