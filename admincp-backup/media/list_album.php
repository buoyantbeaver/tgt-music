<?php
define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../../tgt/class.inputfilter.php");
include("../../tgt/securesession.class.php");
include("../fckeditor/fckeditor.php");
include("../functions.php");
$myFilter = new InputFilter();
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
$ss->Open();
include("../auth.php");
// phan trang

if(isset($_GET["mode"])) $mode=$myFilter->process($_GET["mode"]);
if(isset($_GET["act"])) $act=$myFilter->process($_GET["act"]);
if(isset($_GET["search"])) $search=$myFilter->process($_GET["search"]);
if(isset($_GET["id"])) $id_del=$myFilter->process($_GET["id"]);
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}
if($search) {

	$search 	=  get_ascii($search);

	$sql_where 	= "album_name_ascii LIKE '%".$search."%'";

	$link_pages = "list_album.php?search=".$search."&";

}

elseif($mode == 'hot') {

	$sql_where = "album_hot = 1";

	$sql_order = "ORDER BY album_id DESC";

	$link_pages = "list_album.php?mode=hot&";

}

elseif($mode == 'tv') {

	$sql_where = "album_type = 1";

	$sql_order = "ORDER BY album_id DESC";

	$link_pages = "list_album.php?mode=tv&";

}

else {

	$sql_order = "album_id ORDER BY album_id DESC";

	$link_pages = "list_album.php?";

}

	$sql_tt = "SELECT album_id  FROM tgt_nhac_album WHERE $sql_where $sql_order LIMIT 660";

	$phan_trang = linkPage($sql_tt,HOME_PER_PAGE,$page,$link_pages."p=#page#","");

	$rStar = HOME_PER_PAGE * ($page -1 );

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

                    <td class="title_c">Danh sách &gt; album</td>

                    <td align="right" valign="middle" class="title_c">

                   ID album cần sửa: 

                   <input id=m_id size=10 value="" class="input">

                      <input type="image" src="../images/b_search.gif" onclick='window.location.href = "album.php?mode=edit&id="+document.getElementById("m_id").value;'>

                    

                    ID album cần xóa: 

                    <input id=m_del_id size=10 value="" class="input">

                      <input type="image" src="../images/b_search.gif" onclick='window.location.href = "album.php?del_id="+document.getElementById("m_del_id").value;'>

                    

                    Tìm theo tên album: <input id=search size=40 value="<? echo $search;?>" class="input">

                      <input type="image" src="../images/b_search.gif" onclick='window.location.href = "list_album.php?search="+document.getElementById("search").value;'>&nbsp;&nbsp;&nbsp; </td>

                  </tr>

                </table>               </td>

              </tr>

            </table>

			

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

			</table>

				

		    <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td nowrap class="menu"><? echo $phan_trang;?></td>

              </tr>

              <tr>

                <td colspan="">

                <form name=media_list method=post action='list_album.php' onSubmit="return check_checkbox();">

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr >

                    <td width="1%" align="center" nowrap class="menu"><input class=checkbox type=checkbox name=chkall id=chkall onclick=docheck(document.media_list.chkall.checked,0) value=checkall></td>

                    <td nowrap class="menu">hình ảnh </td>

                      <td nowrap class="menu" width="60%">Tên album </td>

                      <td width="20%" align="center" nowrap class="menu">Ca sĩ</td>

                      <td width="10%" align="center" nowrap class="menu">Chức năng</td>					  

                    </tr>

<?

	$arr_album = $tgtdb->databasetgt("  album_id, album_name, album_singer, album_img, album_cat, album_poster  ","album"," $sql_where $sql_order LIMIT ".$rStar .",". HOME_PER_PAGE,"");

	for($i=0;$i<count($arr_album);$i++) {

	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_album[$i][2]."'");
	if (!@ereg("http://",$arr_album[$i][3])) {
		if($arr_album[$i][3]!="")
			$img_src = "../".str_replace(" ","%20",$arr_album[$i][3]);
		else
			$img_src = check_img2($arr_album[$i][3]);
	}
	else
		$img_src = $arr_album[$i][3];
?>

<tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'">

						  <td nowrap align="center"><input class=checkbox type=checkbox id=checkbox onclick=docheckone() name=checkbox[] value=<? echo $arr_album[$i][0];?>></td>

                       <td align="center" nowrap ><img class=IMG_S src="<?=$img_src;?>"></td>	

					  <td class="song_name" align="left" style="padding-left: 10px;" nowrap  ><a href="album.php?mode=edit&id=<? echo en_id($arr_album[$i][0]);?>" title="Edit this industry"><? echo $arr_album[$i][1];?></a><br> Người gửi : <? echo get_user($arr_album[$i][5]);?></td>						  

					  <td align="center" nowrap  style="padding-left:7px" class="singer_name"><a href="singer.php?mode=edit&id=<? echo en_id($arr_album[$i][2]);?>" title="Edit this industry"><? echo $singer_name;?></a></td>

				    <td align="center" nowrap  style="padding-left:7px"><a href="album.php?mode=edit&id=<? echo en_id($arr_album[$i][0]);?>" title="Edit this industry"><img src="../images/edit.png" width="16" height="16" border="0"></a> 

						  <a href="album.php?del_id=<? echo en_id($arr_album[$i][0]);?>" title="Xóa danh mục này" ><img src="../images/b_delete.png" width="11" height="14" border="0"></a></td>

						</tr>

						<tr><td colspan="7" height="1" bgcolor="#CCCCCC"></td></tr>

<? } ?>

		<tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'"><td colspan=7 align="center" style="padding: 5px;" >Với những Media đã chọn : 

        <select name="selected_option">

        <option value="del">Xóa</option>

        <option value="duyet">Duyệt Album Thành Viên</option>

        <option value="set-top">Đưa vào Top Hot</option>

        <option value="bo-top">Bỏ khỏi Top HOt</option>

        </select>

        <input type="submit" name="do" class=submit value="Thực hiện"></td></tr>

		</form>

        <tr><td colspan="7" height="1" bgcolor="#CCCCCC"></td></tr>

                </table></td>

              </tr>

            </table></td>

        </tr>

      </table></td>

  </tr>

</table>

</body>

</html>

<?

if ($_POST['do']) {

	$arr = $_POST['checkbox'];

	if (!count($arr)) die('Lỗi');

	if ($_POST['selected_option'] == 'del') {

		$in_sql = implode(',',$arr);

		mysql_query("DELETE FROM tgt_nhac_album WHERE album_id IN (".$in_sql.")");

		mss ("Xóa thành công ","list_album.php");

	}		

	elseif ($_POST['selected_option'] == 'set-top') {

		$in_sql = implode(',',$arr);

		mysql_query("UPDATE tgt_nhac_album  SET album_hot = 1 WHERE album_id IN (".$in_sql.")");

		mss ("Update thành công ","list_album.php");

	}

	elseif ($_POST['selected_option'] == 'bo-top') {

		$in_sql = implode(',',$arr);

		mysql_query("UPDATE tgt_nhac_album SET album_hot = 0 WHERE album_id IN (".$in_sql.")");

		mss ("Update thành công ","list_album.php");

	}

	elseif ($_POST['selected_option'] == 'duyet') {

		$in_sql = implode(',',$arr);

		mysql_query("UPDATE tgt_nhac_album SET album_type = 0 WHERE album_id IN (".$in_sql.")");

		mss ("Update thành công ","list_album.php");

	}

	exit();

}

?>