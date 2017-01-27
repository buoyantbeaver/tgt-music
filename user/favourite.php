<?
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
$fav_song 	= get_data("fav","fav_text","fav_user = '".$_SESSION["tgt_user_id"]."' AND fav_type = 1");
?>
<form name="myform" method="post" action="cpanel/music/favourite.html">
<div class="user_">
<h3><span><? echo $_SESSION["tgt_user_name"];?></span> / <span>Mp3</span> / Quản lý bài hát yêu thích</h3>
<div id="ask_ok" style="display:none;"></div>
<? if(!$fav_song) {
	echo '<div style="padding-left: 10px;">Bạn chưa có bài hát yêu thích nào.</div>';	
}else { ?>
<div class="title"><p class="left check"><input type="checkbox" onClick="checkAllFields(1);" id="checkAll" name="checkAll" /></p><p class="left"><input class="delete" type="button" id="deleteBOX" value="Xóa" /></p><p class="right bold"><? echo SoBaiHat($fav_song);?> bài hát yêu thích</p><br class="clr" /></div>
<?
$s = explode(',',$fav_song);
foreach($s as $x=>$val) {
$arr[$x] 		= $tgtdb->databasetgt(" m_id, m_title, m_singer,	m_poster, m_cat, m_viewed ,m_time ","data"," m_id = '".$s[$x]."'");
$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$x][0][2]."'");
$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$nguoi_gui		= get_user($arr[$x][0][3]);
$user_url 		= url_link('user',$arr[$x][0][3],'user');
$song_url 		= url_link($arr[$x][0][1],$arr[$x][0][0],'nghe-bai-hat');
$download 		= 'down.php?id='.$arr[$x][0][0].'&key='.md5($arr[$x][0][0].'tgt_music');
?>
        <div class="list_song fav_song">
        <div class="left check"><input type="checkbox" value="<? echo $arr[$x][0][0];?>" name="delAnn[]" onClick="checkAllFields(2);" /></div>
            <div class="left">
            <p class="song"><a title="Nghe bài hát <? echo un_htmlchars($arr[$x][0][1]); ?>" href="<? echo $song_url; ?>"><? echo un_htmlchars($arr[$x][0][1]); ?></a></p>
            <p class="singer">Trình bày: <a title="Tìm kiếm bài hát của ca sĩ <? echo un_htmlchars($singer_name); ?>" href="<? echo $singer_url; ?>"><? echo un_htmlchars($singer_name); ?></a>| <? echo GetTheLoai($arr[$x][0][4]);?></p>
            <p class="time">Đăng bởi: <a href="<? echo $user_url;?>"><? echo $nguoi_gui;?></a> | Ngày đăng: <? echo GetTIMEDATE($arr[$x][0][6]); ?> | Lượt nghe : <? echo $arr[$x][0][5]; ?></p>
            </div>
            <div class="right list_icon">
                <div class="left"><a href="<? echo $download;?>" target="_blank" title="Tải bài hát <? echo $arr_song[$i][1];?> về máy"><img border="0" src="images/media/down.gif" /></a></div>
                <!-- Playlist ADD -->
                <div class="left" id="playlist_<? echo $arr[$x][0][0]; ?>"><a style="cursor:pointer;" onclick="_load_box(<? echo $arr[$x][0][0]; ?>);"><img src="images/media/add.gif" /></a></div>
                <div class="_PL_BOX" id="_load_box_<? echo $arr[$x][0][0]; ?>" style="display:none;"><span class="_PL_LOAD" id="_load_box_pl_<? echo $arr[$x][0][0]; ?>"></span></div>
                <!-- End playlist ADD -->
                <div class="clr"></div>
            </div>
        
        <div class="clr"></div>
        </div>
<? } ?>
<div class="clr"></div>
<? } ?>
</div>
</form>
<?
if (isset($_POST['deleteAll'])) {
	$all 	= $_POST['checkAll'];
	if($all)	{
		mysql_query("DELETE FROM tgt_nhac_fav WHERE fav_user = '".$_SESSION["tgt_user_id"]."'  AND fav_type = 1");
		mssBOX("Đã xóa xong !","cpanel/music/favourite.html");
	}else {
	$arr 	= $_POST['delAnn'];
	$in_sql = implode(',',$arr);
	$p = explode(',',$in_sql);
	$song_id = split(',',$fav_song);
	foreach($p as $y=>$ichphienpro) {
		if (in_array($p[$y],$song_id)) {
			unset($song_id[array_search($p[$y],$song_id)]);
			$fav_upload = implode(',',$song_id);
			mysql_query("UPDATE tgt_nhac_fav SET fav_text = '".$fav_upload."' WHERE fav_user = '".$_SESSION["tgt_user_id"]."'  AND fav_type = 1");
			mssBOX("Đã xóa xong !","cpanel/music/favourite.html");
		}
	
	}
	}
}
?>