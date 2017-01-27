<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
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
                    <td class="title_c">Thêm sửa thành viên</td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			</table>
				
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding: 20px;">
                <form action="<?=$action;?>" method="post">
	<table width=100% align=center cellpadding="2" cellspacing="2">
		<tr><td class=fr width=100px>user name</td><td class=fr_2><input type=text name="name" size=50 value="<? echo $arrz[0][0];?>"></td></tr>
		<tr><td class=fr width=100px>pass </td><td class=fr_2><input type=text name="pass" size=50 value=""></td></tr>
        <tr><td class=fr width=100px>Email </td><td class=fr_2><input type=text name="email" size=50 value="<? echo $arrz[0][1];?>"></td></tr>
		<tr><td class=fr width=100px>level </td><td class=fr_2><?=acp_level($arrz[0][2]);?></td></tr>
        <tr><td colspan="2"><input type="submit" name="submit" value="Gửi đi"></td></tr>
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