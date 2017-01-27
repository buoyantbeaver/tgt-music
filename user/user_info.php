<?php
$arr = $tgtdb->databasetgt(" * ","user"," userid = '".$id."' ");
?>
<div class="box w_2">
<h1><?=$arr[0][1];?></h1>
	<div style="padding: 10px;">

<p style="float:left; width: 100px; margin-right: 20px;">
<img src="<? echo check_img($arr[0][7]);?>" width="100" style="border: 1px solid #cfcfcf; padding: 4px;"  />
</p>
<p style="float:left;">

            <table width="340" cellpadding="4" cellspacing="4">

            <tr><td align="right" width="100">Tên tài khoản:</td><td><? echo $arr[0][1];?></td></tr>

            <td align="right">Ngày tham gia:</td><td><? echo date('d-m-Y',$arr[0][9]);?></td></tr>

            <tr><td align="right">Email:</td><td><? echo $arr[0][3];?></td></tr>

            <tr><td align="right">Yahoo:</td><td><? echo $arr[0][6];?></td></tr><tr>

            <tr><td align="right" valign="top">Thông tin thêm:</td><td><? echo $arr[0][8];?></td></tr>

			</table>

</p>

<br class="clr" />
</div>
</div>