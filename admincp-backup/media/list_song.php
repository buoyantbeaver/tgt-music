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

if($mode == 'broken') {
	$sql_where = "m_is_broken = 1";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?mode=broken&";
}
elseif($mode == 'top_hot') {
	$sql_where = "m_hot = 1";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?mode=top_hot&";
}
elseif($mode == 'hq') {
	$sql_where = "m_hq = 1";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?mode=hq&";
}
elseif($mode == 'mem_upload') {
	$sql_where = "m_mempost = 1";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?mode=mem_upload&";
}
elseif($mode == 'lyric') {
	$sql_where = "m_lyric_user = 1";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?mode=lyric&";
}
elseif($mode == 'clip_music') {
	$sql_where = "m_type = 2";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?mode=clip_music&";
}
elseif($mode == 'songs') {
	$sql_where = "m_type = 1";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?mode=songs&";
}
elseif($search) {
	$sql_where = "m_title_ascii LIKE '%".$search."%'";
	$sql_order = "ORDER BY m_id DESC";
	$link_pages = "library.php?search=".$search."&";
}
else {
	$sql_order = "m_id ORDER BY m_id DESC";
	$link_pages = "library.php?";
}
	$sql_tt = "SELECT m_id  FROM tgt_nhac_data WHERE $sql_where $sql_order LIMIT 660";
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
                    <td class="title_c">Danh sách &gt; media</td>
                    <td align="right" valign="middle" class="title_c">
                   ID media cần sửa: 
                   <input id=m_id size=10 value="" class="input">
                      <input type="image" src="../images/b_search.gif" onclick='window.location.href = "media.php?mode=edit&id="+document.getElementById("m_id").value;'>
                    
                    ID media cần xóa: 
                    <input id=m_del_id size=10 value="" class="input">
                      <input type="image" src="../images/b_search.gif" onclick='window.location.href = "media.php?del_id="+document.getElementById("m_del_id").value;'>
                    
                    Tìm theo tên bài hát: <input id=search size=40 value="<? echo $search;?>" class="input">
                      <input type="image" src="../images/b_search.gif" onclick='window.location.href = "library.php?search="+document.getElementById("search").value;'>&nbsp;&nbsp;&nbsp; </td>
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
                <form name=media_list method=post action='library.php' onSubmit="return check_checkbox();">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr >
                    <td width="1%" align="center" nowrap class="menu"><input class=checkbox type=checkbox name=chkall id=chkall onclick=docheck(document.media_list.chkall.checked,0) value=checkall></td>
                    <td nowrap class="menu" width="15">IMG</td>
                      <td nowrap class="menu" width="55%">Tên bài hát </td>
                      <td width="5%" align="center" nowrap class="menu">Ca sĩ</td>
                      <td width="10%" align="center" nowrap class="menu">Server</td>
					   <td width="10%" align="center" nowrap class="menu">trạng thái</td>
                      <td width="10%" align="center" nowrap class="menu">Chức năng</td>					  
                    </tr>
<?
	$arr_song = $tgtdb->databasetgt("  m_id, m_title, m_singer, m_type, m_cat, m_is_broken, m_is_local  ","data"," $sql_where $sql_order LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	for($i=0;$i<count($arr_song);$i++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_song[$i][2]."'");
	$song_broken 	= ($arr_song[$i][5] == 0)?'<img src="../images/check.png">':'<img src="../images/un_check.png">';
	$arrER	= $tgtdb->databasetgt("er_name, er_text","error"," er_id = '".$arr_song[$i][0]."'");
?>
<tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'">
						  <td nowrap align="center"><input class=checkbox type=checkbox id=checkbox onclick=docheckone() name=checkbox[] value=<? echo $arr_song[$i][0];?>></td>
                       <td align="center" nowrap ><? echo check_type($arr_song[$i][3],$arr_song[$i][0]);?></td>	
					  <td class="song_name" align="left" style="padding-left: 10px;" nowrap  ><a href="media.php?mode=edit&id=<? echo en_id($arr_song[$i][0]);?>" title="Edit this industry"><? echo un_htmlchars($arr_song[$i][1]);?></a><br>
                      <? if($mode == 'broken') { ?>
					  <strong>Nguyên Nhân lỗi : </strong><? echo un_htmlchars($arrER[0][1]);?><br>
                       <a href="<? echo SITE_LINK;?>/bai-hat/eror/<? echo en_id($arr_song[$i][0]);?>.html" target="_blank">[Kiểm tra bài hát]</a>
                      <? } ?>
                      </td>						  
					  <td align="center" nowrap  style="padding-left:7px" class="singer_name"><a href="singer.php?mode=edit&id=<? echo en_id($arr_song[$i][2]);?>" title="Edit this industry"><? echo $singer_name;?></a></td>
                      <td align="center" nowrap  style="padding-left:7px">Server <? echo $arr_song[$i][6];?></td>
					  <td nowrap  style="padding-left:7px" align="center"><? echo $song_broken;?></td>
				    <td align="center" nowrap  style="padding-left:7px"><a href="media.php?mode=edit&id=<? echo en_id($arr_song[$i][0]);?>" title="Edit this industry"><img src="../images/edit.png" width="16" height="16" border="0"></a> 
						  <a href="media.php?del_id=<? echo en_id($arr_song[$i][0]);?>" title="Xóa danh mục này" ><img src="../images/b_delete.png" width="11" height="14" border="0"></a></td>
						</tr>
						<tr><td colspan="9" height="1" bgcolor="#CCCCCC"></td></tr>
<? } ?>
		<tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'"><td colspan=9 align="center" style="padding: 5px;" >Với những Media đã chọn : 
        <select name="selected_option">
        <option value="add_album">Tạo Album Mới</option>
        <option value="add_song_album">Thếm Media Vào Album</option>
        <option value="del">Xóa</option>
        <option value="normal">Thôi báo Link hỏng</option>
        <option value="set-top">Đưa vào Top Hot</option>
        <option value="bo-top">Bỏ khỏi Top HOt</option>
        <option value="TV">Duyệt bài thành viên</option>
        <!--<option value="LYRIC">Duyệt lời nhạc TV up</option>-->
        <option value="hq">Nhạc 320kps</option>
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
<script>
function ask(){
	if (confirm("Cảnh báo \nTất cả nội dung và chủ đề thuộc chủ đề này sẽ mất hết \nBạn chắc chắn muốn xóa nội dung này ?")) return true;
	return false ;
}
</script>
<?
if ($_POST['do']) {
	$arr = $_POST['checkbox'];
	if (!count($arr)) die('Lỗi');
	if ($_POST['selected_option'] == 'del') {
		$in_sql = implode(',',$arr);
		mysql_query("DELETE FROM tgt_nhac_data WHERE m_id IN (".$in_sql.")");
		mss ("Xóa thành công ","library.php");
	}		
	elseif ($_POST['selected_option'] == 'add_album') {
		$arr = implode(',',$arr);
		header("Location: ./multi_add_album.php?id=".$arr);
	}
	elseif ($_POST['selected_option'] == 'add_song_album') {
		$arr = implode(',',$arr);
		header("Location: ./add_song_album.php?id=".$arr);
	}
	elseif ($_POST['selected_option'] == 'normal') {
		$in_sql = implode(',',$arr);
		mysql_query("UPDATE tgt_nhac_data SET m_is_broken = 0 WHERE m_id IN (".$in_sql.")");
		mysql_query("DELETE FROM tgt_nhac_error WHERE er_id IN (".$in_sql.")");
		mss ("Update thành công ","library.php");
	}
	elseif ($_POST['selected_option'] == 'LYRIC') {
		$in_sql = implode(',',$arr);
		mysql_query("UPDATE tgt_nhac_data SET SET m_lyric_user = 0 WHERE m_id IN (".$in_sql.")");
		mss ("Update thành công ","library.php");
	}
	elseif ($_POST['selected_option'] == 'TV') {
		$in_sql = implode(',',$arr);
		mysql_query("UPDATE tgt_nhac_data SET m_mempost = 0 WHERE m_id IN (".$in_sql.")");
		mss ("Update thành công ","library.php");
	}
	elseif ($_POST['selected_option'] == 'set-top') {
		$in_sql = implode(',',$arr);
		mysql_query("UPDATE tgt_nhac_data  SET m_hot = 1 WHERE m_id IN (".$in_sql.")");
		mss ("Update thành công ","library.php?mode=top_hot");
	}
	elseif ($_POST['selected_option'] == 'bo-top') {
		$in_sql = implode(',',$arr);
		mysql_query("UPDATE tgt_nhac_data SET m_hot = 0 WHERE m_id IN (".$in_sql.")");
		mss ("Update thành công ","library.php?mode=top_hot");
	}
	elseif ($_POST['selected_option'] == 'hq') {
		$in_sql = implode(',',$arr);
		mysql_query("UPDATE tgt_nhac_data SET m_hq = 1 WHERE m_id IN (".$in_sql.")");
		mss ("Update thành công ","library.php?mode=hq");
	}
	exit();
}
?>