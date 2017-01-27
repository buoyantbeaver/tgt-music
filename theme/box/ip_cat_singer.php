<div class="navbox">
<?php 
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !"); 
$cat = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = 0 ORDER BY cat_order ASC");
for($z=0;$z<count($cat);$z++) {
	$cat_url = url_link($cat[$z][1],$cat[$z][0],'singer-cat');
?>
    <h3><a href="<?=$cat_url;?>"><?=$cat[$z][1];?></a></h3>
    
<? } ?>
</div>