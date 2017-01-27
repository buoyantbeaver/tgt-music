<?php
include("../../includes/config.php");
include("../../includes/class.inputfilter.php");
include("../../includes/securesession.class.php");
$myFilter = new InputFilter();
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
$username = "";
$password = "";
$email = "";
$desc = "";
$rights = ",";
$status = "";
$action = "add";
$error = "";
// Them moi
if($act =="add"){
	$username = mysql_real_escape_string($myFilter->process($_POST["username"]));  if($username == "") $error .= "Enter username please";
	$password = mysql_real_escape_string($myFilter->process($_POST["password"])); 	if($password == "") $error .= "Enter password please";
	$password = md5(md5($password));
		
	$email = mysql_real_escape_string($myFilter->process($_POST["email"]));  if($email == "") $error .= "Enter email address please";
		
	$desc = mysql_real_escape_string($myFilter->process($_POST["desc"]));
	$status = mysql_real_escape_string($myFilter->process($_POST["status"]));	
	
	// right
/*	$r_can = $myFilter->process($_POST["r_can"]);
	$m_can = $myFilter->process($_POST["m_can"]);
	$r_cus = $myFilter->process($_POST["r_cus"]);			
	$m_cus = $myFilter->process($_POST["m_cus"]);		
	$right_industry = $myFilter->process($_POST["right_industry"]);
	$fullrights = $myFilter->process($_POST["fullrights"]);			
	if($r_can != "") $rights 	.= $r_can.",";
	if($m_can != "") $rights 	.= $m_can.",";
	if($r_cus != "") $rights 	.= $r_cus.",";
	if($m_cus != "") $rights 	.= $m_cus.",";			
	if(is_array($right_industry)){
		$rights .= "~";
		foreach ($right_industry as $w) $rights .= $w . ",";	
	}
	if($fullrights == "Full") $rights 	= "Full";
	
	if($rights ==",") $error .= "Choose some rights for this user please !";
*/
	$arr = selectDB(" username "," admin "," username='". $username ."'");
	if(count($arr) > 0) $error .= $username ." has existed in system, choose another name please";
	
	if($error !="")
		mss($error);
	else{
		$sql = " INSERT INTO admin  VALUES('". $username ."','". $password ."','". $email ."','". $desc ."','". $rights ."','". $status ."')";
		mysql_query($sql);
		mss("Create successful !","user.php");
		exit();
	}
}

// Sua
if($act =="update"){
	$id = mysql_real_escape_string($myFilter->process($_GET["id"]));
	$username = $id;
	
	$email = mysql_real_escape_string($myFilter->process($_POST["email"]));
	if($email == "") $error .= "Enter email address please";
		
	$desc = mysql_real_escape_string($myFilter->process($_POST["desc"]));
	$status = mysql_real_escape_string($myFilter->process($_POST["status"]));	
	
	// right
	$r_can = mysql_real_escape_string($myFilter->process($_POST["r_can"]));
	$m_can = mysql_real_escape_string($myFilter->process($_POST["m_can"]));
	$r_cus = mysql_real_escape_string($myFilter->process($_POST["r_cus"]));			
	$m_cus = mysql_real_escape_string($myFilter->process($_POST["m_cus"]));		
	$right_industry = mysql_real_escape_string($myFilter->process($_POST["right_industry"]));
	$fullrights = mysql_real_escape_string($myFilter->process($_POST["fullrights"]));			

	if($r_can != "") $rights 	.= $r_can.",";
	if($m_can != "") $rights 	.= $m_can.",";
	if($r_cus != "") $rights 	.= $r_cus.",";
	if($m_cus != "") $rights 	.= $m_cus.",";			
	if(is_array($right_industry)){
		$rights .= "~";
		foreach ($right_industry as $w) $rights .= $w . ",";	
	}
	if($fullrights == "Full") $rights 	= "Full";
	
	if($rights ==",") $error .= "Choose some rights for this user please !";

	if($error !=""){
		$action = "update";
		mss($error);
	}else{
		$sql = " UPDATE admin SET email='". $email ."', description='". $desc ."', rights='". $rights ."',status='". $status ."' WHERE username='". $id ."'";
		mysql_query($sql);
		mss("Updated successful !","user.php");
		exit();
	}
}


// Edit
if($act =="edit"){
	$id = mysql_real_escape_string($myFilter->process($_GET["id"]));
	$arr = selectDB(" * "," admin  "," username = '". $id ."'");
	$username = $arr[0][0];
//	$password = $arr[0][1];
	$email = $arr[0][2];
	$desc = $arr[0][3];
	$rights = $arr[0][4];
	$status = $arr[0][5]; 
	$action = "update";
}

// xoa
if($act =="del"){
	$id = mysql_real_escape_string($myFilter->process($_GET["id"]));
	dbdelete("admin"," username='".$id."'");
	mss("Delete successful !","user.php");
	exit();
}

// phan trang
$sql = "SELECT username FROM admin  ";
$phantrang = linkPage($sql,ROW_PER_PAGE,$page,"user.php?p=#page#","");

// du lieu
$arrUser = selectDB(" * "," admin  ORDER BY username ","");
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
                      <td class="title_c">Người dùng</td>
                      <td align="right" valign="middle" class="title_c"><input type="text" value="Từ khóa tìm" name="mahoso" class="input">
                        <input type="image" src="../images/b_search.gif">
                        &nbsp;&nbsp;&nbsp; </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <form action="user.php?act=<?php echo $action?>&id=<?php echo $id?>" name="add" method="post">
                <tr >
                  <td nowrap class="menu" width="25%">Thông tin người dùng</td>
                </tr>
                <tr >
                  <td  ><table width="100%" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td width="25%">&nbsp;&nbsp;Tên đăng nhập</td>
                        <td width="25%"><input type="text" name="username" value="<?php echo $username?>" class="input" >
                          <span class="must">*</span> </td>
                        <td width="25%">Mật khầu</td>
                        <td width="25%"><input type="text" name="password" value="<?php echo $password?>" class="input">
                          <span class="must">*</span></td>
                      </tr>
                      <tr>
                        <td>&nbsp;&nbsp;Email</td>
                        <td><input type="text" name="email" value="<?php echo $email?>" class="input">
                          <span class="must">*</span></td>
                        <td>Mô tả công việc</td>
                        <td><input type="text" name="desc" value="<?php echo $desc?>" class="input">                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;&nbsp;Trạng thái (Kích hoạt/ Khóa) </td>
                        <td><? status("status", $trangthai)?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr >
                  <td  >&nbsp;</td>
                </tr>
                <tr >
                  <td align="right" class="menu" ><input type="submit" class="button" name="add" value="  Submit  "></td>
                </tr>
              </form>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td nowrap class="menu"><?php echo $phantrang;?></td>
              </tr>
              <tr>
                <td colspan="<?php echo $colspan?>"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr >
                      <td nowrap class="menu" width="20%">Tên đăng nhập</td>
                      <td width="20%" nowrap class="menu">Email</td>
                      <td width="40%" nowrap class="menu">Phạm vi truy cập</td>
                      <td width="10%" align="center" nowrap class="menu">Trạng thái</td>
                      <td width="10%" align="center" nowrap class="menu">Chức năng</td>
                    </tr>
                    <?php
					for($i=0;$i<count($arrUser);$i++){
					?>
                    <tr onMouseOver="bgColor='#c9daf6'" onMouseOut="bgColor='#FFFFFF'">
                      <td nowrap style="padding-left:7px" ><?php echo $arrUser[$i][0]?></td>
                      <td nowrap  style="padding-left:7px"><?php echo $arrUser[$i][2]?></td>
                      <td nowrap  style="padding-left:7px"><?php echo $arrUser[$i][3]?></td>
                      <td align="center" nowrap  style="padding-left:7px"><?php echo iif($arrUser[$i][5]=="Y","Active","Inactive")?></td>
                      <td align="center" nowrap  style="padding-left:7px"><a href="user.php?act=edit&id=<?php echo $arrUser[$i][0]?>" title="Sửa thông tin quản trị"><img src="../images/edit.png" width="16" height="16" border="0"></a> <a href="user.php?act=del&id=<?php echo $arrUser[$i][0]?>" title="Xóa thành viên quản trị này"><img src="../images/b_delete.png" width="11" height="14" border="0"></a></td>
                    </tr>
                    <tr>
                      <td colspan="5" height="1" bgcolor="#CCCCCC"></td>
                    </tr>
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
