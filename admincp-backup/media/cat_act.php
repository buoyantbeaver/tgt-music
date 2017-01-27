<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../styles/admin.js"></script>
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
                    <td class="title_c">THÊM SỬA THỂ LOẠI</td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			</table>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding: 20px;">
                <form action="<?=$action;?>" method="post" enctype="multipart/form-data">
	<table width=100% align=center cellpadding="2" cellspacing="2">
		<tr><td class=fr width=100px>CAT NAME</td><td class=fr_2><input type=text name="name" size=50 value="<? echo $arrz[0][2];?>"></td></tr>
		<tr><td class=fr width=100px>STT </td><td class=fr_2><input type="text" name="stt" value="<? echo $arrz[0][3];?>" size=10></td></tr>
		<tr><td class=fr width=100px>CAT SUB I </td><td class=fr_2><?=acp_add_cat($arrz[0][4],'sub_id');?></td></tr>
		<tr><td class=fr width=100px>CAT SUB II </td><td class=fr_2><?=acp_add_cat($arrz[0][5],'sub_id_2');?></td></tr>
		<tr><td class="fr" align="center" colspan="2"><input class="sutm" type="submit" name="submit" value="ADD">  <input class="sutm" type="reset" value="RESET"></td></tr>
	</table>
</form>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>