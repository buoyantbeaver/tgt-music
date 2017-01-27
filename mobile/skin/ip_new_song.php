<div class="title-main"><img src="./nct/ico-m.gif" width="13" height="13" align="baseline"> Audio Mới Nhất</div>
<!--List song -->
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_viewed, m_downloaded ","data"," m_type = 1 ORDER BY m_id DESC LIMIT 8");
for($i=0;$i<count($arr);$i++) {
$id_media = $arr[$i][0];
$id_singer = $arr[$i][2];
$type = $arr[$i][3];
$song_name = htmlchars($arr[$i][1]);
$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$i][2]."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$song_url = check_url_song_mobile($arr[$i][1],$arr[$i][0],$arr[$i][3]);
$downloaded = number_format($arr[$i][5]);
$download 		= 'down.php?id='.$arr[$i][0].'&key='.md5($arr[$i][0].'tgt_music');
$viewed = number_format($arr[$i][4]);
$stt			= $i+1;
if($i<2){
$class = "fjx";
} elseif ($i>2){
$class = "";
}
?>			
<div class="row bgmusic ">
    <h3><a href="<? echo $song_url; ?>"><? echo $song_name; ?></a></h3> 
    <p><img src="./nct/ico-singer.gif" width="12" height="11" border="0"> <? echo $singer_name; ?><span><img src="./nct/ico-head.gif" width="11" height="11" border="0"> <? echo number_format($arr[$i][4]); ?></span></p>
</div>			
       <div class="clr"></div>   
        </div>			
<? } ?>
                <!-- end ---><div class="clr"></div><div class="read_" style="display: none"><a class="read-more" href="Song/Viet-Nam.html">Xem thêm</a></div><div class="more"><a href="the-loai-bai-hat/Nhac-Viet-Nam/EZEFZOA.html">Xem thêm <img src="./nct/ico-more.gif" width="10" height="10" border="0" align="absmiddle"></a></div>
<!--Account -->