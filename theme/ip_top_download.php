<?php if (!defined('TGT-MUSIC')) die("Mọi chi tiết về website xin vui lòng liên hệ yahoo: minhthanh_qnv !"); ?>
    	 <div class="box w_2">
        <h1>♪ TOP Download</h1>
		<div class="album" id="load_bxh">
<?php
$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_cat, m_type, m_viewed, m_downloaded ","data"," m_type = 1 ORDER BY m_downloaded_month DESC LIMIT 5");
for($i=0;$i<count($arr);$i++) {
$id_media = $arr[$i][0];
$id_singer = $arr[$i][2];
$type = $arr[$i][3];
$song_name = htmlchars($arr[$i][1]);
$singer_name = get_data("singer","singer_name"," singer_id = '".$id_singer."'");
$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$song_url = check_url_song($song_name,$id_media,$type);
$downloaded = number_format($arr[$i][5]);
$download 		= 'down.php?id='.$arr[$i][0].'&key='.md5($arr[$i][0].'tgt_music');
$viewed = number_format($arr[$i][4]);
$checkhq		= check_song($arr[$i][5],$arr[$i][6]);
//add the loai
$song 		= $tgtdb->databasetgt(" m_title, m_singer, m_cat, m_img, m_poster, m_viewed, m_lyric, m_kbs, m_sang_tac ","data"," m_id = '".$id_media."' ORDER BY m_id DESC ");
$title 		= get_data("singer","singer_name"," singer_id = '".$song[0][1]."'");
// ket thuc
$stt			= $i+1;
if($i<2){
$class = "fjx";
} elseif ($i>2){
$class = "";
}
?>
                    <div class="list_song">
                        <div class="left">	
						
            <p class="song"><a title="<? echo $song_name; ?>" class="vtip" href="<? echo $song_url; ?>"><? echo $song_name; ?></a><? echo $checkhq; ?></p>
            <p class="singer_">Trình bày : <a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo $singer_name; ?>" href="<? echo $singer_url; ?>"><? echo $singer_name; ?></a></p>
			<p class="cat_">Thể loại: <? echo GetTheLoai($song[0][2]);?></p>
			<p class="cat_">Download : <? echo $downloaded; ?> | Nghe: <? echo $viewed; ?> </p>
			<p class="kbs_">Chất lượng: <? echo check_kbs($song[0][7]);?></p>			

</div>
			<div class="right list_icon">
                <div class="left"><a href="<?echo $download; ?>" target="_blank" title="Tải bài hát <? echo $song_name; ?> về máy"><img border="0" src="images/media/down.gif" border="0" class="hover_img" /></a></div>
                <!-- Playlist ADD -->
                <div class="left" id="playlist_<? echo $id_media; ?>" ><a style="cursor:pointer;" onclick="_load_box(<? echo $id_media; ?>);"><img src="images/media/add.gif" class="hover_img"  /></a></div>
                <div class="_PL_BOX" id="_load_box_<? echo $id_media; ?>" style="display:none;"><span class="_PL_LOAD" id="_load_box_pl_<? echo $id_media; ?>" ></span></div>
                <!-- End playlist ADD -->
                <div class="clr"></div>
            </div>

			
       <div class="clr"></div>   
        </div>
			
<? } ?>
                    </div>
                    </div>
