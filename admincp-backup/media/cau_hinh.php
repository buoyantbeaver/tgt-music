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
$web_desc			=	getConfig('web_desc');
$domain				=	getConfig('domain');
$google_analytics		=       getConfig('google_analytics');
$face_page       		=       getConfig('face_page');
$cat_vn				=	getConfig('cat_vn');
$cat_hq				=	getConfig('cat_hq');
$cat_am				=	getConfig('cat_am');
$passii				=	getConfig('passii');
$upload				=	getConfig('upload');
$play				=	getConfig('play');

if(isset($_POST['add'])) {
		$web_name			=	$_POST['web_name'];
		$web_key			=	$_POST['web_key'];
		$web_des			=	$_POST['web_desc'];
		$domain				=	$_POST['domain'];
		$google_analytics		=	$_POST['google_analytics'];
		$face_page      		=	$_POST['face_page'];
		$cat_vn				=	$_POST['cat_vn'];
		$cat_hq				=	$_POST['cat_hq'];
		$cat_am				=	$_POST['cat_am'];
		$passii				=	$_POST['passii'];
		$upload				=	$_POST['server'];
		$play				=	$_POST['play'];
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$web_name."' WHERE cf_name = 'web_name'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$web_key."' WHERE cf_name = 'web_key'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$web_desc."' WHERE cf_name = 'web_desc'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$domain."' WHERE cf_name = 'domain'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$google_analytics."' WHERE cf_name = 'google_analytics'");
		@mysql_query("UPDATE tgt_nhac_config SET cf_value = '".$face_page."' WHERE cf_name = 'face_page'");
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
                    <td class="title_c"> Cấu hình website </td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<form name="add" method="post" enctype="multipart/form-data">
				<tr >
                      <td nowrap class="menu" width="25%">Cấu hình website</td>
                </tr>
					<tr >
					  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
					 	<tr>
                            <td class="frz">Mật khẩu 2 đăng nhập admincp</td>
                            <td class="frz"><input type="text" name="passii"  value="<?=$passii;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td width="200" class="frz">URL website</td>
                            <td class="frz"><input type="text" name="domain"  value="<?=$domain;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Tiêu đề (Tối đa 60 ký tự)</td>
                            <td class="frz"><input type="text" name="web_name"  value="<?=$web_name;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Từ khóa</td>
                            <td class="frz"><input type="text" name="web_key"  value="<?=$web_key;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Mô tả từ khóa (160 ký tự)</td>
                            <td class="frz"><input type="text" name="web_desc"  value="<?=$web_desc;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Google Analytics ID (VD: UA-45446389-6)</td>
                            <td class="frz"><input type="text" name="google_analytics"  value="<?=$google_analytics;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Facebook Fanpage</td>
                            <td class="frz"><input type="text" name="face_page"  value="<?=$face_page;?>"  size="60"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">ID thể loại nhạc Việt Nam</td>
                            <td class="frz"><input type="text" name="cat_vn"  value="<?=$cat_vn;?>" size="5"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">ID thể loại nhạc Hàn Quốc</td>
                            <td class="frz"><input type="text" name="cat_hq"  value="<?=$cat_hq;?>"  size="5"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">ID thể loại nhạc Âu Mỹ</td>
                            <td class="frz"><input type="text" name="cat_am"  value="<?=$cat_am;?>"  size="5"></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Server upload dành cho thành viên</td>
                            <td class="frz"><?=acp_server($upload)?></td>
                        </tr>
                        <tr><td colspan="2" height="1" bgcolor="#CCCCCC"></td></tr>
					 	<tr>
                            <td class="frz">Số lần + cho 1 lần nghe nhạc</td>
                            <td class="frz"><input type="text" name="play"  value="<?=$play;?>"  size="5"></td>
                        </tr>
                      </table></td>
				    </tr>
					<tr >
					  <td align="left" class="menu" ><input type="submit" class="button" name="add" value="  Submit  "></td>
				    </tr></form>
            </table>
				
	      </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>