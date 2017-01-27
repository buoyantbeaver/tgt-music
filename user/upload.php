<div class="user_">
<h3><span><? echo $_SESSION["tgt_user_name"];?></span> / <span>Mp3</span> / Bài hát của tôi</h3>
<?php
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);

if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}

	// phan trang
	$sql_tt = "SELECT m_id  FROM tgt_nhac_data WHERE  m_poster = '".$_SESSION["tgt_user_id"]."' AND m_mempost = 1 AND m_type = 1 ORDER BY m_id DESC LIMIT ".LIMITSONG;

	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_song = $tgtdb->databasetgt(" m_id, m_title, m_singer  ","data"," m_poster = '".$_SESSION["tgt_user_id"]."' AND m_mempost = 1 AND m_type = 1 ORDER BY m_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"cpanel/music/upload/#page#","");

if($page <= 20) { ?>
<div class="title"><p class="right bold"><? echo count($arr_song);?> bài hát</p><br class="clr" /></div>
<?
for($i=0;$i<count($arr_song);$i++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_song[$i][2]."'");
	$type = check_type($arr_song[$i][5],$arr_song[$i][0]);
	$song_url = check_url_song($arr_song[$i][1],$arr_song[$i][0],$arr_song[$i][5]);
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$download = 'down.php?id='.$arr_song[$i][0].'&key='.md5($arr_song[$i][0].'tgt_music');
?>
        <div class="list_song  fav_song"">
            <div class="left">
            <p class="song_"><a title="Nghe bài hát <? echo un_htmlchars($arr_song[$i][1]); ?>" href="<? echo $song_url; ?>"><? echo un_htmlchars($arr_song[$i][1]); ?></a></p>
            <p class="singer_">Trình bày: <a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo un_htmlchars($singer_name); ?>" href="<? echo $singer_url; ?>"><? echo un_htmlchars($singer_name); ?></a></p>
            </div>
            <div class="right list_icon">
                <div class="left"><a href="<? echo $download;?>" target="_blank" title="Tải bài hát <? echo $arr_song[$i][1];?> về máy"><img border="0" src="images/media/down.gif" border="0" class="hover_img" /></a></div>
                <!-- Playlist ADD -->
                <div class="left" id="playlist_<? echo $arr_song[$i][0]; ?>"><a style="cursor:pointer;" onclick="_load_box(<? echo $arr_song[$i][0]; ?>);"><img src="images/media/add.gif" class="hover_img"  /></a></div>
                <div class="_PL_BOX" id="_load_box_<? echo $arr_song[$i][0]; ?>" style="display:none;"><span class="_PL_LOAD" id="_load_box_pl_<? echo $arr_song[$i][0]; ?>"></span></div>
                <!-- End playlist ADD -->
                <div class="clr"></div>
            </div>
        
        <div class="clr"></div></div>
<?	} ?>
        <div class="pages_tgt"><? echo $phantrang; ?></div>
        <? } if($page >= 20) { ?>
			<div class="error_yeu_thich"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
		<? } ?>
</div>