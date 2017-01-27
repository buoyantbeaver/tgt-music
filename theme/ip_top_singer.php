<div class="box2 w_4">
            	<h1 class="album_icon_new">Ca sỹ HOT</h1>
					<div class="new_album_bg" id="load_album">
<?php
$arr = $tgtdb->databasetgt("singer_id, singer_name, singer_img, singer_info, singer_hot,singer_id","singer"," singer_hot = 1 ORDER BY RAND() DESC LIMIT 8");
for($i=0;$i<count($arr);$i++) {
$title = get_data("singer","singer_name"," singer_id = '".$arr[$i][0]."' ORDER BY singer_id DESC LIMIT 3");
$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr_song[$i][2]."'");
$singer_id = get_data("singer","singer_id"," singer_id = '".$arr[$i][5]."'");
$stt			= $i+1;
if($i==3 || $i==7){
$class = "fjx";
} elseif ($i>3){
$class = "";
}
?>
						<div class="album_ <? echo $class ; ?>">
    <p class="images">
	<a title="<? echo $arr[$i][1] ?>" href="tim-kiem/bai-hat.html?key=<? echo text_s($arr[$i][1]);?>&ks=singer"><img src="<? echo check_img($arr[$i][2]) ?>" alt="<? echo $arr[$i][1] ?>" /></a></p>
    <h2><a title="<? echo $arr[$i][1] ?>" href="tim-kiem/bai-hat.html?key=<? echo text_s($arr[$i][1]);?>&ks=singer"><? echo $arr[$i][1] ?></a></h2>

</div>
 <? } ?>               
<div class="clr"></div><div class="read_"></div>                    </div>
                </div>