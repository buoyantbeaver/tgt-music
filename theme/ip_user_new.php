<?php if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !"); ?>
<div class="main_bg">
                	<div class="tabs">

                        <div class="top_f member_padding">                        <div class="titles">Top thành viên</div>
                             <ul  class="idTabs">
                                 <li><a href="#_DaiGia">Đại gia</a></li>
                                 <li><a href="#_New">Thành viên mới</a></li>
                             </ul>
                             <div  class="clr"></div>
                        </div>
                    </div>
                </div>
                <div class="info_tab">
                	<div id="_DaiGia" class="user_list">
<?
$arr = $tgtdb->databasetgt(" * ","user"," userid ORDER BY userid  DESC LIMIT 12");
for($z=0;$z<count($arr);$z++) {

?>
<a href="Member/Z/user/<? echo $arr[$z][0]; ?>.html" target="_bank" title="<? echo $arr[$z][1]; ?>" class="vtip"><img src="<? echo check_img($arr[$z][7]); ?>" width="40" height="40" /></a>  
                  <? } ?>
                                        </div>	
                	<div id="_New" class="user_list">
<?
$arr = $tgtdb->databasetgt(" * ","user"," userid ORDER BY userid  DESC LIMIT 12");
for($z=0;$z<count($arr);$z++) {

?>
<a href="Member/Z/user/<? echo $arr[$z][0]; ?>.html" target="_bank" title="<? echo $arr[$z][1]; ?>" class="vtip"><img src="<? echo check_img($arr[$z][7]); ?>" width="40" height="40" /></a>  
                  <? } ?>
                                        </div>	
                                        </div>										
										
										
					