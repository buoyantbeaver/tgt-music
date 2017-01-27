<div class="title-main"><img src="./nct/ico-mv.gif" width="14" height="12" align="baseline"> Video Mới Nhất</div>
<!--List Video -->
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_img, m_singer, m_type, m_viewed, m_downloaded ","data"," m_type = 2 ORDER BY m_id DESC LIMIT 8");

for($i=0;$i<count($arr);$i++) {
	$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$i][3]."'");
	$song_title		= un_htmlchars($arr[$i][1]);
	$video_img		= check_img($arr[$i][2]);
	$song_url 		= url_link($arr[$i][1],$arr[$i][0],'nghe-bai-hat');
	$video_url 		= url_link_mobile($arr[$i][1],$arr[$i][0],'xem-video');
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$checkhq		= check_song($arr[$i][5],$arr[$i][6]);
	$download 		= 'down.php?id='.$arr[$i][0].'&key='.md5($arr[$i][0].'tgt_music');
	$stt			= $i+1;
	// 1
	if($num == 1 || $num == 2 || $num == 3) { 
		if($stt	< 4)	$classb[$i]	=	"fjx";

			
	}
?>			
			<div class="row">
    <div class="img-80">
	<span class="icon"></span><a  href="<? echo $video_url; ?>"><img src="<? echo check_img($arr[$i][2]);?>" width="80" height="45" border="0"></a></div>
    <div class="txt-80">
        <h3><a href="<? echo $video_url; ?>">	<? echo $song_title; ?></a></h3> 
        <p><img src="./nct/ico-singer.gif" width="12" height="11" border="0"> <? echo $singer_name; ?><span><img src="./nct/ico-head.gif" width="11" height="11" border="0"> <? echo number_format($arr[$i][4]); ?></span></p>
    </div>
	    </div>
<? } ?>
</div><div class="more"><a href="the-loai-video/Nhac-Viet-Nam/EZEFZOA.html">Xem thêm <img src="./nct/ico-more.gif" width="10" height="10" border="0" align="absmiddle"></a></div>