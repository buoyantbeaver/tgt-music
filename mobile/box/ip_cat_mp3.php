<div class="navbox">
<?php 
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !"); 
$cat = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = 0 ORDER BY cat_order ASC");
for($z=0;$z<count($cat);$z++) {
	$cat_url = url_link($cat[$z][1],$cat[$z][0],'the-loai');
?>
    <h3><a href="<?=$cat_url;?>"><?=$cat[$z][1];?></a></h3>
    <p>
        <?
        $cats1 = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = '".$cat[$z][0]."' ORDER BY cat_order ASC");
        for($i=0;$i<count($cats1);$i++) {
            $cats1_url = url_link($cats1[$i][1],$cats1[$i][0],'the-loai');
        ?>
            <a href="<?=$cats1_url;?>"><?=$cats1[$i][1];?></a>
        <? } ?>
        <br class="clr" />
    </p>
<? } ?>
</div>