<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

                    <td class="title_c">Thêm nhiều Media</td>

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

<tr><td class=title align=center>Số lượng Media được thêm</td></tr>

<tr>

	<td class=fr width=10% align=center>

	<input name="total_songs" size=10 value="" style="text-align:center">

    <br><font color="#FF0000"><i>Vui lòng nhập số lượng Media được thêm</i></font>

</td>

</tr>

<tr><td class=fr align=center><input type="submit" name="ok" class="sutm" value="ĐỒNG Ý"></td></tr>

</table>

</form>

<?php

}

else

{

$total_links = $_POST['total_songs'];

$total_sv = mysql_num_rows(mysql_query("SELECT local_id  FROM tgt_nhac_local"));



if (!$_POST['submit']) {

?>

<script>

var total = <?=$total_links?>;

<? for ($z=1; $z<=$total_sv; $z++) { ?>

    function check_local_<?=$z?>(status){

        for(i=1;i<=total;i++)

            document.getElementById("local_url_<?=$z?>_"+i).checked=status;

    }

<? } ?>

</script>

<form enctype="multipart/form-data" method=post>

<table cellpadding=2 cellspacing=2 width=100% >

<tr>

	<td class=fr width=30%><b>Ca sĩ</b></td>

	<td class=fr_2><?=acp_singer()?></td>

</tr>

<tr>

	<td class=fr width=30%>

		<b>Nhập tên mới</b>


	<td class=fr_2>

		<input name=new_singer size=50> &nbsp;
		<select name=singer_type>
       		<option value=1>Ca sĩ VN</option>
        	<option value=2>Ca sĩ AM</option>
       		<option value=3>Ca sĩ CA</option>
		</select>

	</td>

</tr>

<tr>

	<td class=fr width=30%>

		<b>Tên Album</b>

		</td>

	<td class=fr_2>

		<input name=new_album size=50>

	</td>

</tr>

<tr>

	<td class=fr width=30%>

		<b>IMG Album</b></td>

	<td class=fr_2><input name=album_img type=file size=50><br /></td>
</tr>
<tr>
	<td class=fr width=30%>
		<b>Thông tin Album</b></td>
	<td class=fr_2>
						<?php
						$oFCKeditor = new FCKeditor('album_info') ;
						$oFCKeditor->ToolbarSet = 'Basic';
						$oFCKeditor->Height = '200' ; 
						$oFCKeditor->BasePath = '../fckeditor/' ;
						$oFCKeditor->Value = '';
						$oFCKeditor->Create() ;
						?>
	</td>
</tr>
</tr>

	<td class=fr width=30%><b>Thể loại</b></td>

	<td class=fr_2><?=acp_cat()?></td>

</tr>



<? for ($z=1; $z<=$total_sv; $z++) { 

$local = 'Server '.$z;

?>

<tr>

    <td class=fr width=30%><b>Server <?=$z?></b></td>

    <td class=fr_2><input value="Chọn tất cả" type="button" onClick="check_local_<?=$z?>(true)"> <input value="Xóa tất cả" type="button" onClick="check_local_<?=$z?>(false)"><?=$local?></td>

</tr>

<? } ?>

<tr><td class=fr width=100px><strong>Định dạng </strong></td><td class=fr_2><?=acp_type(1);?></td></tr>

<?php

for ($i=1;$i<=$total_links;$i++) {

?>

<tr>

<td class=fr width='30%'>Tên Media <?=$i?><br>Link Media</td>

<td class='fr_2'><input type=text name=title[<?=$i?>] size=50 value=""><br /><input type=text name=url[<?=$i?>] size=50 value=""><br />

<? $brz=0; for ($z=1; $z<=$total_sv; $z++) { 

?>

<input type=checkbox class=checkbox id=local_url_<?=$z?>_<?=$i?> name=local_url_<?=$z?>[<?=$i?>]><b>  <?=$z?></b> |

<?

$brz = $brz+1;

if ($brz == 5) {

echo '';

$brz=0;

}

 } ?>





</td>

</tr>

<?php

}

?>

<tr><td class=fr colspan=2 align=center><input type=hidden name=total_songs value=<?=$total_links?>><input type=hidden name=ok value=Submit><input type=submit name=submit class="sutm" value="ĐỒNG Ý"></td></tr>

</table>

</form>

<?php
}
else {
	if ($_POST['new_singer'] && $_POST['singer_type']) {
		$singer = them_moi_singer($_POST['new_singer'],$_POST['singer_type']);
	}
	else $singer = $_POST['singer'];
	$cat		 = implode(',',$_POST['cat']);
	$cat		 = ",".$cat.",";
	$type 		 = $_POST['type'];
	$new_album   = $_POST['new_album'];
	$t_singer    = $singer;
	$t_cat 		 = $cat;
	for ($i=0;$i<=$total_links;$i++) {
		$t_url 			= stripslashes($_POST['url'][$i]);
		$t_title 		= htmlchars(stripslashes($_POST['title'][$i]));
		$t_img	 		= $_POST['img_video'][$i];
		$t_title_ascii 	= strtolower(get_ascii($t_title));
		for ($z=1; $z<=$total_sv; $z++) {
        if ($_POST['local_url_'.$z][$i])
        $t_local = $z;
        }
		if ($t_url && $t_title) {
			mysql_query("INSERT INTO tgt_nhac_data (m_singer,m_cat,m_url,m_type,m_title,m_title_ascii,m_is_local,m_poster,m_img,m_time) VALUES ('".$t_singer."','".$t_cat."','".$t_url."','".$type."','".$t_title."','".$t_title_ascii."','".$t_local."','".$_SESSION['admin_id']."','".$t_img."','".NOW."')");
		}
	}
	$arr = $tgtdb->databasetgt("m_id","data"," m_id ORDER BY m_id DESC LIMIT ".$total_links);
	for($x=0;$x<$total_links;$x++) {
	$list .=  $arr[$x][0].',';
	}
	$album_song = substr($list,0,-1);
	if ($new_album) {
			if(move_uploaded_file ($_FILES['album_img']['tmp_name'],FOLDER_ALBUM."/[TLDi-music]-".time()."-".$_FILES['album_img']['name']))
			$album_img = LINK_ALBUM."/[TLDi-music]-".time()."-".$_FILES['album_img']['name'];
			else $album_img = $_POST['album_img'];
			$album = them_moi_album($new_album,$singer,$album_img,$cat,$album_song,$album_info);
			}
	mss ("oki! ","media.php?mode=multi_add_song");

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