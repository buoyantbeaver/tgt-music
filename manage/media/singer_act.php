<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Ca Sĩ (Singer)</title>
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
			<td valign="top" class="style">
					<tr>
						<td valign="top" class="style_bg">
							<tr>
								<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td class="title_c"><font color="red"><b>Thêm / Sửa Ca sĩ</b></font></td>
								  </tr>
									</table>     
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td style="padding: 20px;">
									<form action="<?=$action;?>" method="post" enctype="multipart/form-data">
									<table width=100% align=center cellpadding="2" cellspacing="2">
										<tr>
										<tr>
												<p><input type="file" name="img" size=100></p>
												<p><input type=text name="imgz" size=100 value="<? echo $arrz[0][3];?>"</p>
											</td>
										<tr>
										<tr>
										<tr>
									</table>
									</form>       
								</td>
							</tr>
						</table>
					</tr>
				</table>
		</tr>
	</table>
</body>
</html>