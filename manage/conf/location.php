<?php
include("../../includes/config.php");
include("../../includes/class.inputfilter.php");
include("../../includes/securesession.class.php");
include("../../includes/class.upload.php");
include("../fckeditor/fckeditor.php");
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
if(isset($_GET["act"])) $act=$myFilter->process($_GET["act"]);
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
if($page > 0 && $page!= "")
	$start=($page-1) * ROW_PER_PAGE;
else{
	$page = 1;
	$start=0;
}

// bien trong trang
$thanhpho = "";
$sapxep = "";
$trangthai = "";
$city_intro = "";
$action = "add";

// Them moi
if($act =="add"){
	$thanhpho = mysql_real_escape_string($myFilter->process($_POST["thanhpho"]));
	if($thanhpho == "") mss("Enter location/city name please","#");
	$sapxep = mysql_real_escape_string($myFilter->process($_POST["sapxep"]));
	$trangthai = mysql_real_escape_string($myFilter->process($_POST["trangthai"]));
	$city_intro = mysql_real_escape_string($_POST["city_intro"]);	
	
	$sql = " INSERT INTO city VALUES('','". $thanhpho ."','". $trangthai ."','". $sapxep ."','','". $city_intro ."')"	;
	mysql_query($sql);
	
	$city_id = mysql_insert_id();
		
		$file_name = $city_id.  rand(100,999) . "_s"; 
		if((!empty($_FILES["city_photo"])) && ($_FILES['city_photo']['error'] == 0)) {
			$arrfile=explode('.',$_FILES["city_photo"]["name"]);
			$file_name=$file_name.".".$arrfile[count($arrfile)-1];
			$upload->set("name",$_FILES["city_photo"]["name"]); // Uploaded file name.
			$upload->set("type",$_FILES["city_photo"]["type"]); // Uploaded file type.
			$upload->set("tmp_name",$_FILES["city_photo"]["tmp_name"]); // Uploaded tmp file name.
			$upload->set("error",$_FILES["city_photo"]["error"]); // Uploaded file error.
			$upload->set("size",$_FILES["city_photo"]["size"]); // Uploaded file size.
			$upload->set("fld_name",$file_name); // Uploaded file field name.
			$upload->set("max_file_size",FILE_SIZE); // Max size allowed for uploaded file in bytes = 40 KB.
			$upload->set("supported_extensions",FILE_TYPE); // Allowed extensions and types for uploaded file.
			$upload->set("randon_name",FALSE); // Generate a unique name for uploaded file? bool(true/false).
			$upload->set("new_name",$file_name); // Generate a unique name for uploaded file? bool(true/false).
			$upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
			$upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).
			$upload->set("dst_dir",ARTICLE_FOLDER_ABSOLUTE); // Destination directory for uploaded files.
			$result = $upload->moveFileToDestination(); // $result = error_type (true/false). Succeed or not.
			switch ($result){
				case 1:
					mss("Định dạng file không hợp lệ");
					break;
				case 2:
					mss("Dung lượng file quá lớn(chấp nhận file < 1MB)");
					break;
				case 3:
					mss("Bị lỗi 3");
					break;
				case 4:
					mss("Bị lỗi 4");
					break;
				case 5:
					mss("Bị lỗi 5");
					break;
				case 6:
					mss("Bị lỗi 6");
					break;
				case 7:
					mss("Bị lỗi 7");
					break;
			}
			$sql = " UPDATE city   SET city_photo='".ARTICLE_FOLDER ."/" . $file_name."'  WHERE city_id ='". $city_id ."'";;
	//			echo $sql;
			mysql_query($sql);
		}
		
	mss("Add successful !","location.php");
	exit();
}

// Sua
if($act =="update"){
	$id = mysql_real_escape_string($myFilter->process($_GET["id"]));
	$thanhpho = mysql_real_escape_string($myFilter->process($_POST["thanhpho"]));
	$sapxep = mysql_real_escape_string($myFilter->process($_POST["sapxep"]));
	$trangthai = mysql_real_escape_string($myFilter->process($_POST["trangthai"]));
	$city_intro = mysql_real_escape_string($_POST["city_intro"]);	
	$sql = " UPDATE city SET city_name='". $thanhpho ."',city_status='". $trangthai ."',city_order='". $sapxep ."' ,city_intro='". $city_intro ."' WHERE city_id='".$id."'"	;
	mysql_query($sql);
	
		
		$file_name = $id.  rand(100,999) . "_s"; 
		if((!empty($_FILES["city_photo"])) && ($_FILES['city_photo']['error'] == 0)) {
			$arrfile=explode('.',$_FILES["city_photo"]["name"]);
			$file_name=$file_name.".".$arrfile[count($arrfile)-1];
			$upload->set("name",$_FILES["city_photo"]["name"]); // Uploaded file name.
			$upload->set("type",$_FILES["city_photo"]["type"]); // Uploaded file type.
			$upload->set("tmp_name",$_FILES["city_photo"]["tmp_name"]); // Uploaded tmp file name.
			$upload->set("error",$_FILES["city_photo"]["error"]); // Uploaded file error.
			$upload->set("size",$_FILES["city_photo"]["size"]); // Uploaded file size.
			$upload->set("fld_name",$file_name); // Uploaded file field name.
			$upload->set("max_file_size",FILE_SIZE); // Max size allowed for uploaded file in bytes = 40 KB.
			$upload->set("supported_extensions",FILE_TYPE); // Allowed extensions and types for uploaded file.
			$upload->set("randon_name",FALSE); // Generate a unique name for uploaded file? bool(true/false).
			$upload->set("new_name",$file_name); // Generate a unique name for uploaded file? bool(true/false).
			$upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
			$upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).
			$upload->set("dst_dir",ARTICLE_FOLDER_ABSOLUTE); // Destination directory for uploaded files.
			$result = $upload->moveFileToDestination(); // $result = error_type (true/false). Succeed or not.
			switch ($result){
				case 1:
					mss("Định dạng file không hợp lệ");
					break;
				case 2:
					mss("Dung lượng file quá lớn(chấp nhận file < 1MB)");
					break;
				case 3:
					mss("Bị lỗi 3");
					break;
				case 4:
					mss("Bị lỗi 4");
					break;
				case 5:
					mss("Bị lỗi 5");
					break;
				case 6:
					mss("Bị lỗi 6");
					break;
				case 7:
					mss("Bị lỗi 7");
					break;
			}
			$sql = " UPDATE city   SET city_photo='". ARTICLE_FOLDER."/" . $file_name."'  WHERE city_id ='". $id ."'";;
	//			echo $sql;
			mysql_query($sql);
		}
	
	mss("Update successful !","location.php");
	exit();
}


// Edit
if($act =="edit"){
	$id = mysql_real_escape_string($myFilter->process($_GET["id"]));
	$arr = selectDB(" * "," city "," city_id = '". $id ."'");
	$thanhpho = $arr[0][1];
	$sapxep = $arr[0][3];
	$city_intro = $arr[0][5];	
	$trangthai = $arr[0][2];
	$action = "update";
}

// xoa
if($act =="del"){
	$id = mysql_real_escape_string($myFilter->process($_GET["id"]));
	dbdelete("city"," city_id=".$id);
	mss("Delete successful !","location.php");
	exit();
}

// phan trang
$sql = "SELECT city_id  FROM city ";
$phantrang = linkPage($sql,ROW_PER_PAGE,$page,"location.php?p=#page#","");

// du lieu
$rStar = ROW_PER_PAGE * ($page -1 );
$arrCity = selectDB(" * "," city ORDER BY city_order LIMIT ".$rStar .",". ROW_PER_PAGE,"");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
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
                    <td class="title_c">Quản trị &gt; Thành phố / địa danh </td>
                    <td align="right" valign="middle" class="title_c"><input type="text" value="Search" name="mahoso" class="input">
                      <input type="image" src="../images/b_search.gif">&nbsp;&nbsp;&nbsp; </td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<form action="location.php?act=<?php echo $action?>&id=<?php echo $id?>" name="add" method="post" enctype="multipart/form-data">
				<tr >
                      <td nowrap class="menu" width="25%">Add new location (city) </td>
                    </tr>
					<tr >
					  <td  ><table width="100%" border="0" cellspacing="2" cellpadding="0">
                        <tr>
                          <td width="25%">&nbsp;&nbsp;Tên thành phố/địa danh </td>
                          <td width="25%"><input type="text" name="thanhpho" value="<?php echo $thanhpho?>" class="input" >
                          <span class="must">*</span></td>
                          <td width="25%">Sắp xếp</td>
                          <td width="25%"><input type="text" name="sapxep" value="<?php echo $sapxep?>" class="input"></td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;Trạng thái (Hiện / ẩn) </td>
                          <td><? status("trangthai", $trangthai)?></td>
                          <td>Hình ảnh </td>
                          <td><input type="file" name="city_photo" class="input"></td>
                        </tr>
						<tr>
                          <td colspan="4"  class="menu">&nbsp;&nbsp;Giới thiệu</td>
                          </tr>
                        <tr>
                          <td colspan="4" valign="top"><?php
						$oFCKeditor = new FCKeditor('city_intro') ;
						$oFCKeditor->Height = '200' ; 
						$oFCKeditor->BasePath = '../fckeditor/' ;
						$oFCKeditor->Value = $city_intro ;
						$oFCKeditor->Create() ;
						?></td>
                          </tr>
                      </table></td>
				    </tr>
					<tr >
					  <td align="right" class="menu" ><input type="submit" class="button" name="add" value="  Submit  "></td>
				    </tr></form>
                </table>
				
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td nowrap class="menu"><?php echo $phantrang;?></td>
              </tr>
              <tr>
                <td colspan="<?php echo $colspan?>"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr >
                      <td nowrap class="menu" width="80%">Thành phố / địa danh </td>
                      
                      
                      
                      <td width="10%" align="center" nowrap class="menu">Trạng thái</td>
                      <td width="10%" align="center" nowrap class="menu">Chức năng</td>
                    </tr>
					<?php
					for($i=0;$i<count($arrCity);$i++){
					?>
                    <tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'">
                      <td nowrap style="padding-left:7px" ><?php echo $arrCity[$i][1]?></td>
                      <td align="center" nowrap  style="padding-left:7px"><?php echo iif($arrCity[$i][2]=="Y","Show","Hide")?></td>
                      <td align="center" nowrap  style="padding-left:7px"><a href="location.php?act=edit&id=<?php echo $arrCity[$i][0]?>" title="Sửa thông tin thành phố"><img src="../images/edit.png" width="16" height="16" border="0"></a> <a href="location.php?act=del&id=<?php echo $arrCity[$i][0]?>" title="Xóa thành phố này"><img src="../images/b_delete.png" width="11" height="14" border="0"></a></td>
                    </tr>
					<tr><td colspan="3" height="1" bgcolor="#CCCCCC"></td></tr>
				 <?php
				 } // for
				 ?>
                </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
