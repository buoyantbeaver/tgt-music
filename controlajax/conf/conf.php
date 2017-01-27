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
$act=$myFilter->process(@$_GET["act"]);

// Sua
if($act =="update"){
	$i = 0;
	foreach ($HTTP_POST_VARS['conf_value'] as $key=>$value ){  
		$arrConf_value[$i] = $value;
		$i ++;		
	}
	$i =0;
	foreach ($HTTP_POST_VARS['conf_id'] as $key=>$value ){  
		$arrConf_id[$i] = $value;	
				
		$sql = " UPDATE config SET config_value ='". $arrConf_value[$i] ."' WHERE confg_id ='".$arrConf_id[$i]."'"	;
//		echo $sql . "</br>";
		mysql_query($sql);
		$i ++;
	}

	mss("Đã sửa thành công","conf.php");
	exit();
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
                    <td class="title_c">Hệ thống &gt; Cấu hình thông số </td>
                    <td align="right" valign="middle" class="title_c"><input type="text" value="Từ khóa tìm" name="mahoso" class="input">
                      <input type="image" src="../images/b_search.gif">&nbsp;&nbsp;&nbsp; </td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<form action="conf.php?act=update" name="add" method="post">
				<tr >
                      <td nowrap class="menu" width="25%">Cấu hình thông số website </td>
                </tr>
					<tr >
					  <td ><table width="100%" border="0" cellspacing="2" cellpadding="0">
                        <tr>
						<?
						$arr = selectDB(" * "," config  ","username ='website' ORDER BY config_key ");
						for($i=0;$i<count($arr);$i++){
						?>
                          <td width="25%">&nbsp;&nbsp;<?php echo $arr[$i][2]?> </td>
                          <td width="25%"><input type="text" name="conf_value[<?php echo $arr[$i][0]?>]" value="<?php echo $arr[$i][3]?>" class="input" > 
						 <input type="hidden" name="conf_id[<?php echo $arr[$i][0]?>]" value="<?php echo $arr[$i][0]?>" class="input" >
                            <span class="must">*</span> </td>
						<?
							if(($i+1) % 2==0)
								echo "</tr><tr>";
						} // for
						?>
                        </tr>
                      </table></td>
				    </tr>
					<tr >
					  <td align="right" class="menu" ><input type="submit" class="button" name="add" value="  Nhập  "></td>
				    </tr></form>
            </table>
				
	      </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
