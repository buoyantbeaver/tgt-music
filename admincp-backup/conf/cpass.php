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
// bien trong trang
if(isset($_GET["act"])) $act=$myFilter->process($_GET["act"]);
$password = "";
$re_password = "";
$email = "";
$error = "";
// Sua
if($act =="change"){
	$password = mysql_real_escape_string($myFilter->process($_POST["password"]));
	if($password == "") $error .= "Enter new password please";
		
	$re_password = mysql_real_escape_string($myFilter->process($_POST["re_password"]));
	if($password != $re_password) $error .= "You have enterd wrong password ";
	
	if($error !=""){
		mss($error);
	}else{
		$password = md5(md5($password));
		$sql = " UPDATE admin SET password ='". $password ."' WHERE username='". $_SESSION["username"] ."'";
		mysql_query($sql);
		mss("Changed password successful !","cpass.php");
		exit();
	}
}

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
                      <td class="title_c">Administration &gt; User management &gt; Change password </td>
                      <td align="right" valign="middle" class="title_c"><input type="text" value="Từ khóa tìm" name="mahoso" class="input">
                        <input type="image" src="../images/b_search.gif">
                        &nbsp;&nbsp;&nbsp; </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <form action="cpass.php?act=change" name="add" method="post">
                <tr >
                  <td nowrap class="menu" width="25%">Change password </td>
                </tr>
                <tr >
                  <td  ><table width="100%" border="0" cellspacing="2" cellpadding="0">
                      <tr>
                        <td width="25%">&nbsp;&nbsp;New password  </td>
                        <td width="25%"><input type="password" name="password" value="<?php echo $username?>" class="input" >
                          <span class="must">*</span> </td>
                        <td width="25%">Re- type Password</td>
                        <td width="25%"><input type="password" name="re_password" value="<?php echo $re_password?>" class="input">
                          <span class="must">*</span></td>
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
           </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
