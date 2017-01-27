<?php

define('TGT-MUSIC',true);

include("../../tgt/tgt_music.php");

?>

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

                    <td class="title_c">Danh sách thể loại</td>

                  </tr>

                </table>               </td>

              </tr>

            </table>

			

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

			</table>

				

		    <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td style="padding: 20px;">



<?

echo "<table width=100% align=center cellpadding=2 cellspacing=2><form method=post>";

	$cat_query = mysql_query("SELECT * FROM tgt_nhac_theloai WHERE (sub_id IS NULL OR sub_id = 0) ORDER BY cat_order ASC",$link_music);

		while ($cat = mysql_fetch_array($cat_query)) {

			echo "<tr align=center><td colspan=2 class=cat_title>".$cat['cat_title']."</td></tr>";

			$iz = $cat['cat_order'];

			echo "<tr><td align=center class=fr><input onclick=this.select() type=text name='o".$cat['cat_id']."' value=$iz size=2 style='text-align:center'></td><td class=fr_2><a href='cat.php?del_id=".$cat['cat_id']."'>Xóa</a> - <a href='cat.php?mode=edit&id=".$cat['cat_id']."'><b>".$cat['cat_name']."</b></a></td></tr>";

			$sub_query = mysql_query("SELECT * FROM tgt_nhac_theloai WHERE sub_id = '".$cat['cat_id']."' AND sub_id_2 = 0 ORDER BY cat_order ASC",$link_music);

			if (mysql_num_rows($sub_query)) echo "<tr><td class=fr_2>&nbsp;</td><td class=fr><table width=100% cellpadding=2 cellspacing=0 class=border>";

			while ($sub = mysql_fetch_array($sub_query)) {

				$s_o = $sub['cat_order'];

				echo "<tr><td align=center class=fr width=5%><input onclick=this.select() type=text name='o".$sub['cat_id']."' value=$s_o size=2 style='text-align:center'></td><td class=fr_2 colspan=\"2\"><a href='cat.php?del_id=".$sub['cat_id']."'>Xóa</a> - <a href='cat.php?mode=edit&id=".$sub['cat_id']."'><b>".$sub['cat_name']."</b></a></td></tr>";
						$sub_2 = mysql_query("SELECT * FROM tgt_nhac_theloai WHERE sub_id != 0 AND sub_id_2 = '".$sub['cat_id']."' ORDER BY cat_order ASC",$link_music);
			
		
						while ($sub2 = mysql_fetch_array($sub_2)) {
			
							$s_o_2 = $sub2['cat_order'];
			
							echo "<tr><td></td><td align=center class=fr width=5%><input onclick=this.select() type=text name='o".$sub2['cat_id']."' value=$s_o_2 size=2 style='text-align:center'></td><td class=fr_2><a href='cat.php?del_id=".$sub2['cat_id']."'>Xóa</a> - <a href='cat.php?mode=edit&id=".$sub2['cat_id']."'><b>".$sub2['cat_name']."</b></a></td></tr>";
			
						}
			
			}

			if (mysql_num_rows($sub_query)) echo "</table></td></tr>";

		}

echo '<tr><td colspan="2" align="center"><input type="submit" name="sbm" class=submit value="Sửa thứ tự"></td></tr>';

echo '</form></table>';

if ($_POST['sbm']) {

	$z = array_keys($_POST);

	$q = mysql_query("SELECT cat_id FROM tgt_nhac_theloai",$link_music);

	for ($i=0;$i<mysql_num_rows($q);$i++) {

		$id = split('o',$z[$i]);

		$od = ${$z[$i]};

		mysql_query("UPDATE tgt_nhac_theloai SET cat_order = '$od' WHERE cat_id = '".$id[1]."'");

		echo "<script language='JavaScript'>{ window.parent.location='?act=list_cat' }</script>";

	}

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