<?php if (!defined('TGT-MUSIC')) die("Mọi chi tiết về website xin vui lòng liên hệ yahoo: minhthanh_qnv !"); ?>
    	 <div class="box w_3">
        <h1 class="bxh_icon">Nhạc yêu thích</h1>
		<div class="album" id="load_bxh">
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer,m_url, m_type ","data"," m_hot = 1 ORDER BY m_id DESC LIMIT 8");
for($i=0;$i<count($arr);$i++) {
$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$i][2]."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$song_url = check_url_song($arr[$i][1],$arr[$i][0],$arr[$i][3]);
$stt			= $i+1;
if($i<2){
$class = "fjx";
} elseif ($i>2){
$class = "";
}
?>
			<div class="top_mp3"> 
						<div class="x_1 <? echo $class; ?>"><? echo $stt ; ?></div> 
						<div class="x_2"> 
						<p class="song"><a class="song_a" title="Nghe bài hát <? echo $arr[$i][1]; ?>" href="<? echo $song_url; ?>"><strong><? echo rut_ngan($arr[$i][1],6); ?></strong></a></p> 
							<p class="singer"> 
							<a title="Tìm kiếm bài hát của ca sĩ <? echo $singer_name; ?>" href="<? echo $singer_url; ?>"><? echo rut_ngan($singer_name,5); ?></a></p> 
						</div> 
						
						<div class="clr"></div> 
			</div> 
			
<? } ?>
<div class="read_"><a class="read-more" href="top-de-cu.html">Xem thêm</a></div>
</div>
</div>

