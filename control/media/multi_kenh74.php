<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../temp/js/jquery.js"></script>
<script type="text/javascript" src="../styles/admin.js"></script>
<style>
.left { float: left;}.right { float: right; }.clr { clear: both;}
</style>
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
                    <td class="title_c">THÊM DJ TỪ TRANG DJ.TUOIGI.COM BY KM MUSIC 26/12/2012</td>
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

if ((!$_POST['ok']) AND (!$_POST['submit'])) {
?>
<form method=post>
<table class=border cellpadding=2 cellspacing=0 width=30%>
<tr><td class=title align=center>THÊM DJ TỪ TRANG DJ.TUOIGI.COM BY KM MUSIC 26/12/2012</td></tr>
<tr>
	<td class=fr width=10% align=center>
	<input name="total_songs" size=100 value="" style="text-align:center">
	<br><br>
+ DẠNG LINK POST : http://dj.tuoigi.com/bay/the-loai/5/Viet-Remix.html#dj<br>
</td>
</tr>
<tr><td class=fr align=center><input type="submit" name="ok" class="sutm" value="Submit"></td></tr>
</table>
</form>
<?php
}
else
{
$total_links = $_POST['total_songs'];
if (!$_POST['submit']) {
    $url = file_get_contents($total_links);
	$url_song = explode('<div class="song-bit">', $url);
	$total_linksx = count($url_song);
    $total_links = $total_linksx-1;
?>

<script>
var total = <?=$total_links?>;
function check_local(status){
	for(i=1;i<=total;i++)
		document.getElementById("local_url_"+i).checked=status;
}
function new_stype(id){
    for(i=1;i<=total;i++)
   	    document.getElementById("singer_type_["+i+"]").value=id;
}
</script>
<form method=post enctype="multipart/form-data">
<table class=border cellpadding=2 cellspacing=0 width=95%>
<tr>
	<td class=fr width=30% align="right">
		<font color=red><strong>CA SĨ</strong></font></td>
	<td class=fr_2>
		<!--<input size=50 onkeyup="new_singer(this.value)"><br />-->
		<select onChange="new_stype(this.value)">
       		<option value=1>CA SĨ VN</option>
        	<option value=2>CA SĨ AM</option>
       		<option value=3>CA SĨ CA</option>
       		<option value=4>CA SĨ DJ</option>
		</select>
	</td>
</tr>
	<td class=fr width=30% align="right"><b>THỂ LOẠI</b></td>
	<td class=fr_2><?=acp_cat()?></td>
</tr>
<?
for ($i=1;$i<=$total_links;$i++) {
	$play_url = explode('href="http://dj.tuoigi.com/bay/', $url_song[$i]);
	$play_url = explode('"', $play_url[1]);
    $txt2='http://dj.tuoigi.com/bay/'.$play_url[0];
	
	$link_goc = file_get_contents($txt2);
	$aArray=explode('file=http://play.tuoigi.com/mp3/z.php?id=',$link_goc);
	$A=explode('.flv&',$aArray[1]);
	$link=$A[0];
    $song = explode('content="', $url_song[$i]);
    $song = explode('">', $song[1]);
    $song = $song[0];
//	$singer = explode(' - ', $url_song[$i]);
 //   $singer = explode('">', $singer[1]);
    $singer = $singer[0];

?>
<tr>
<td class=fr width='30%' align="right">TÊN BẢN MIX <?=$i?></td>
<td class='fr_2'><input type=text name=title[<?=$i?>] size=50 value="<?=$song?>">
</td></tr>
<tr>
<tr>
<td class=fr width='30%' align="right">LINK <?=$i?></td>
<td class='fr_2'><input type=text name=url[<?=$i?>] size=50 value="<?=$link?>">
</td></tr>
<tr>

<td class=fr align="right">CA SĨ</td>
<td class=fr_2><input name="new_singer[<?=$i?>]" id="new_singer_[<?=$i?>]" value="<?=$singer?>" size="50"> &nbsp;
		<select name="singer_type[<?=$i?>]" id="singer_type_[<?=$i?>]">
       		<option value=1>CA SĨ VN</option>
        	<option value=2>CA SĨ AM</option>
       		<option value=3>CA SĨ CA</option>
       		<option value=4>CA SĨ DJ</option>
		</select>
</td>
</tr>
<tr>
<td colspan="2" style="background: #DCF0F8;"></td>
</td></tr>
<?php
}
?>
<tr><td class=fr colspan=2 align=center><input type=hidden name=total_songs value=<?=$total_links?>><input type=hidden name=ok value=Submit><input type=submit name=submit class="sutm" value=Submit></td></tr>
</table>
</form>
<?php
}
else {
	if ($_POST['new_singer'] && $_POST['singer_type']) {
		$singer = them_moi_singer($_POST['new_singer'],$_POST['singer_type']);
	}
	$cat = implode(',',$_POST['cat']);
	$cat = ",".$cat.",";
	$t_cat = $cat;
	for ($i=0;$i<=$total_links;$i++) {
		
		$t_title = htmlchars(stripslashes($_POST['title'][$i]));
		$t_url = stripslashes($_POST['url'][$i]);
		$t_img = stripslashes($_POST['img'][$i]);
		$t_title_ascii = strtolower(get_ascii($t_title));
		if ($t_url && $t_title) {
		$t_singer = them_moi_singer($_POST['new_singer'][$i], $_POST['singer_type'][$i]);
		mysql_query("INSERT INTO tgt_nhac_data (m_singer,m_cat,m_url,m_type,m_title,m_title_ascii,m_is_local,m_poster,m_img,m_time) VALUES ('".$t_singer."','".$t_cat."','".$t_url."','1','".$t_title."','".$t_title_ascii."','0','".$_SESSION['admin_id']."','".$t_img."','".NOW."')");
		}
	}
	echo "Ok<meta http-equiv='refresh' content='0;url=$link'>";
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