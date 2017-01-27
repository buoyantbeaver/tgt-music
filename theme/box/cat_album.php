            <div class="box w_1">
                <h1>Album List</h1>
                <div class="padding">
                    <ul class="singer_">
                        <li><a href="Album/Viet-Nam.html" title="Danh Sách Album Việt Nam">Album Việt Nam</a></li>
                        <li><a href="Album/Au-My.html" title="Danh Sách Album Âu Mỹ">Album Âu Mỹ</a></li>
                        <li><a href="Album/Chau-A.html" title="Danh Sách Album Châu Á">Album Châu Á</a></li>
                    </ul>
                </div>
            </div>
<?php 
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !"); 
$cat = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = 0 ORDER BY cat_order ASC");
for($z=0;$z<count($cat);$z++) {
	$cat_url = url_link($cat[$z][1],$cat[$z][0],'album-cat');
?>
<div class="box w_1">
	<h1><?=$cat[$z][1];?></h1>
    <div class="padding">
    	<ul>
        <?
        $cats1 = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = '".$cat[$z][0]."' ORDER BY cat_order ASC");
        for($i=0;$i<count($cats1);$i++) {
            $cats1_url = url_link($cats1[$i][1],$cats1[$i][0],'album-cat');
        ?>
        	<li><a href="<?=$cats1_url;?>"><?=$cats1[$i][1];?></a></li>
        <? } ?>
		</ul>
	</div>
</div>
<? } ?>