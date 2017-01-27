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
$q = mysql_query("SELECT * FROM tgt_nhac_local ORDER BY local_id ASC",$link_music);
$total = mysql_num_rows(mysql_query("SELECT local_id  FROM tgt_nhac_local"));
if (!$_POST['submit']) {
    ?>
    <form method="post">
    <table cellspacing="2" cellpadding="2" width="100%" class=border>
        <? $i = 1;
        while ($r = mysql_fetch_array($q)) { 
        ?>
        <tr><td class=fr width="130px;"><font color="#FF0000" size="+1">Link <?=$i?>:</font></td><td align="left" class=fr_2><input name="local_link_[<?=$r['local_id']?>]" size="50" value="<?=$r['local_link']?>"></td></tr>
        <tr><td class=fr>Folder chứa nhạc<?=$i?>:</td><td class=fr_2><input name="local_folder_[<?=$r['local_id']?>]" size="50" value="<?=$r['local_folder']?>"></td></tr>
        <tr><td class=fr>FTP <?=$i?>:</td><td class=fr_2><input name="local_ftp_[<?=$r['local_id']?>]" size="50" value="<?=$r['local_ftp']?>"></td></tr>
        <tr><td class=fr>FTP user <?=$i?>:</td><td class=fr_2><input name="local_user_[<?=$r['local_id']?>]" size="50" value="<?=$r['local_user']?>"></td></tr>
        <tr><td class=fr>FTP pass <?=$i?>:</td><td class=fr_2><input name="local_pass_[<?=$r['local_id']?>]" size="50" value="<?=$r['local_pass']?>"></td></tr>

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
            $id[$i] = $r['local_id'];
            $i++;
            if ($r['local_folder'] != $local_folder_[$r['local_id']]) {
                mysql_query("UPDATE tgt_nhac_local SET local_folder = '".$local_folder_[$r['local_id']]."' WHERE local_id IN (".$r['local_id'].")");
            }
            if ($r['local_link'] != $local_link_[$r['local_id']]) {
                mysql_query("UPDATE tgt_nhac_local SET local_link = '".$local_link_[$r['local_id']]."' WHERE local_id IN (".$r['local_id'].")");

            }
            if ($r['local_user'] != $local_user_[$r['local_id']]) {
                mysql_query("UPDATE tgt_nhac_local SET local_user = '".$local_user_[$r['local_id']]."' WHERE local_id IN (".$r['local_id'].")");

            }
            if ($r['local_pass'] != $local_pass_[$r['local_id']]) {
                mysql_query("UPDATE tgt_nhac_local SET local_pass = '".$local_pass_[$r['local_id']]."' WHERE local_id IN (".$r['local_id'].")");

            }
            if ($r['local_ftp'] != $local_ftp_[$r['local_id']]) {
                mysql_query("UPDATE tgt_nhac_local SET local_ftp = '".$local_ftp_[$r['local_id']]."' WHERE local_id IN (".$r['local_id'].")");

            }
		}
        if ($local_total > $total) {
            for ($i=$total+1; $i<=$local_total; $i++) {
                mysql_query("INSERT INTO tgt_nhac_local (local_folder, local_link, local_user, local_pass, local_ftp) VALUES ('','','','','')");
            }
        }
        elseif ($local_total < $total) {
            for ($i=$local_total+1; $i<=$total; $i++) {
                natsort($id);
                mysql_query("DELETE FROM tgt_nhac_local WHERE local_id IN (".$id[$i].")");
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