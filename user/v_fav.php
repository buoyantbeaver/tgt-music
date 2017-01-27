<?
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
$fav_video 	= get_data("fav","fav_text","fav_user = '".$_SESSION["tgt_user_id"]."' AND fav_type = 3");
?>
<form name="myform" method="post" action="cpanel/video/favourite.html">
<div class="user_">
<h3><span><? echo $_SESSION["tgt_user_name"];?></span> / <span>Mp3</span> / Quản lý video yêu thích</h3>
<div id="ask_ok" style="display:none;"></div>
<? if(!$fav_video) {
	echo '<div style="padding-left: 10px;">Bạn chưa có video yêu thích nào.</div>';	
}else { ?>
<div class="title"><p class="left check"><input type="checkbox" onClick="checkAllFields(1);" id="checkAll" name="checkAll" /></p><p class="left"><input class="delete" type="button" id="deleteBOX" value="Xóa" /></p><p class="right bold"><? echo SoBaiHat($fav_video);?> video yêu thích</p><br class="clr" /></div>
<?
$s = explode(',',$fav_video);
foreach($s as $x=>$val) {
$arr[$x] 		= $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img ","data"," m_id = '".$s[$x]."'");
$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$x][0][2]."'");
$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$nguoi_gui		= get_user($arr[$x][0][3]);
$user_url 		= url_link('user',$arr[$x][0][3],'user');
$song_url 		= url_link($arr[$x][0][1],$arr[$x][0][0],'xem-video');
$download 		= 'down.php?id='.$arr[$x][0][0].'&key='.md5($arr[$x][0][0].'tgt_music');

?>
        <div class="top_video fav_song">
        <div class="x_4_4"><input type="checkbox"  id="pl_<? echo $arr[$x][0][0];?>" value="<? echo $arr[$x][0][0];?>" name="delAnn[]" onClick="checkAllFields(2);" /></div>
        <div class="x_2">
            <a title="Xem Video  <? echo un_htmlchars($arr[$x][0][1]); ?>" href="<? echo $song_url; ?>">
            <img class="img_album" src="<? echo check_img($arr[$x][0][3]); ?>" title="Xem Video <? echo $arr[$x][0][1]; ?>" /></a>
        </div>
        <div class="x_s1">
            <p class="song"><a title="<? echo un_htmlchars($arr[$x][0][1]); ?>" href="<? echo $song_url; ?>"><strong><? echo un_htmlchars($arr[$x][0][1]); ?></strong></a></p>
            <p>Trình bày: <a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo un_htmlchars($singer_name); ?>" href="<? echo $singer_url; ?>"><? echo $singer_name; ?></a></p>
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
		mysql_query("DELETE FROM tgt_nhac_fav WHERE fav_user = '".$_SESSION["tgt_user_id"]."'  AND fav_type = 3");
		mssBOX("Đã xóa xong !","cpanel/video/favourite.html");
	}else {
	$arr 	= $_POST['delAnn'];
	$in_sql = implode(',',$arr);
	$p = explode(',',$in_sql);
	$song_id = split(',',$fav_video);
	foreach($p as $y=>$ichphienpro) {
		if (in_array($p[$y],$song_id)) {
			unset($song_id[array_search($p[$y],$song_id)]);
			$fav_upload = implode(',',$song_id);
			mysql_query("UPDATE tgt_nhac_fav SET fav_text = '".$fav_upload."' WHERE fav_user = '".$_SESSION["tgt_user_id"]."'  AND fav_type = 3");
			mssBOX("Đã xóa xong !","cpanel/video/favourite.html");
		}
	
	}
	}
}
?>