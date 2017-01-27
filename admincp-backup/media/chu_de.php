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
                    <td class="title_c">Quản lý server chứa nhạc</td>
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
$q = mysql_query("SELECT * FROM tgt_nhac_chude ORDER BY chude_id ASC",$link_music);
$total = mysql_num_rows(mysql_query("SELECT chude_id  FROM tgt_nhac_chude"));
if (!$_POST['submit']) {
    ?>
    <form method="post">
    <table cellspacing="2" cellpadding="2" width="100%" class=border>
        <? $i = 1;
        while ($r = mysql_fetch_array($q)) { 
        ?>
        <tr><td class=fr>Tên chủ đề <?=$i?>:</td><td class=fr_2><input name="chude_name_[<?=$r['chude_id']?>]" size="50" value="<?=$r['chude_name']?>"></td></tr>
        <tr><td class=fr width="130px;"><font color="#FF0000" size="+1">Link <?=$i?>:</font></td><td align="left" class=fr_2><input name="chude_link_[<?=$r['chude_id']?>]" size="50" value="<?=$r['chude_link']?>"></td></tr>
		<tr><td class=fr width="130px;"><font color="#FF0000" size="+1">Link img <?=$i?>:</font></td><td align="left" class=fr_2><input name="chude_img_[<?=$r['chude_id']?>]" size="50" value="<?=$r['chude_img']?>"></td></tr>
		<? $i++; } ?>
        <tr><td align="center" class=fr_2>Tổng số server <input size=4 name="local_total" value="<?=$total?>" onClick="this.select()"></td><td class=fr><input type="submit" value="SUBMIT" name=submit class=submit></td></tr>
        <tr><td colspan=2>
        </td></tr>
    </td></tr>
    </table>
    </form>
    <?php
    }
    else {
        $i = 1;    
        while ($r = mysql_fetch_array($q)) {
            $id[$i] = $r['chude_id'];
            $i++;
            if ($r['chude_name'] != $chude_name_[$r['chude_id']]) {
                mysql_query("UPDATE tgt_nhac_chude SET chude_name = '".$chude_name_[$r['chude_id']]."' WHERE chude_id IN (".$r['chude_id'].")");
            }
            if ($r['chude_img'] != $chude_link_[$r['chude_id']]) {
                mysql_query("UPDATE tgt_nhac_chude SET chude_img = '".$chude_img_[$r['chude_id']]."' WHERE chude_id IN (".$r['chude_id'].")");

            }			
            if ($r['chude_link'] != $chude_link_[$r['chude_id']]) {
                mysql_query("UPDATE tgt_nhac_chude SET chude_link = '".$chude_link_[$r['chude_id']]."' WHERE chude_id IN (".$r['chude_id'].")");

            }
		}
        if ($local_total > $total) {
            for ($i=$total+1; $i<=$local_total; $i++) {
                mysql_query("INSERT INTO tgt_nhac_chude (chude_name, chude_img, chude_link) VALUES ('','')");
            }
        }
        elseif ($local_total < $total) {
            for ($i=$local_total+1; $i<=$total; $i++) {
                natsort($id);
                mysql_query("DELETE FROM tgt_nhac_chude WHERE chude_id IN (".$id[$i].")");
            }
        }
        echo "Đã sửa xong !<meta http-equiv='refresh' content='0;url=$link'>";
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