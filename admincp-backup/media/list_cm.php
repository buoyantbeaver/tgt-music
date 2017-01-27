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

if ($del_id) {
	mysql_query("DELETE FROM tgt_nhac_comment WHERE comment_id = '".$del_id."'");
		mss ("Đã xóa xong ","list_cm.php");
}

if(isset($_GET["mode"])) $mode=$myFilter->process($_GET["mode"]);
if(isset($_GET["act"])) $act=$myFilter->process($_GET["act"]);
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}


	$sql_order = "comment_id ORDER BY comment_id DESC";

	$link_pages = "list_cm.php?";


	$sql_tt = "SELECT comment_id  FROM tgt_nhac_comment WHERE $sql_where $sql_order LIMIT 660";

	$phan_trang = linkPage($sql_tt,HOME_PER_PAGE,$page,"list_cm.php?p=#page#","");

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

                    <td class="title_c">Danh sách &gt; bình luận</td>

                    <td align="right" valign="middle" class="title_c">
 </td>

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

                <form name=media_list method=post action='list_cm.php' onSubmit="return check_checkbox();">

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr >

                    <td width="1%" align="center" nowrap class="menu"><input class=checkbox type=checkbox name=chkall id=chkall onclick=docheck(document.media_list.chkall.checked,0) value=checkall></td>

                    <td nowrap class="menu" width="100">Avatar </td>

                      <td nowrap class="menu" width="80%">Thành viên / bình luận</td>

                      <td width="10%" align="center" nowrap class="menu">Chức năng</td>					  

                    </tr>

<?

	$arr_album = $tgtdb->databasetgt("  *  ","comment"," $sql_where $sql_order LIMIT ".$rStar .",". HOME_PER_PAGE,"");

	for($i=0;$i<count($arr_album);$i++) {
		$avatarcm	=	get_data("user","avatar","userid = '".$arr_album[$i][2]."'");
?>

<tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'">

						  <td nowrap align="center"><input class=checkbox type=checkbox id=checkbox onclick=docheckone() name=checkbox[] value=<? echo $arr_album[$i][0];?>></td>

                       <td align="center" nowrap ><img class=IMG_S src="<?=check_avt($avatarcm);?>"></td>	

					  <td class="song_name" align="left" style="padding-left: 10px;" nowrap  ><a href="#"><?=get_user($arr_album[$i][2]);?></a><br> 
                      <?=text_tidy($arr_album[$i][3]);?>
                      </td>						  


				    <td align="center" nowrap  style="padding-left:7px">

						  <a href="list_cm.php?del_id=<?=$arr_album[$i][0];?>" title="Xóa bình luận này" ><img src="../images/b_delete.png" width="11" height="14" border="0"></a></td>

						</tr>

						<tr><td colspan="7" height="1" bgcolor="#CCCCCC"></td></tr>

<? } ?>

		<tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'"><td colspan=7 align="center" style="padding: 5px;" >Với những bình luận đã chọn : 
        <select name="selected_option">
        <option value="del">Xóa</option>
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

		mysql_query("DELETE FROM tgt_nhac_comment WHERE comment_id IN (".$in_sql.")");

		mss ("Xóa thành công ","list_cm.php");

	}		

	exit();

}

?>