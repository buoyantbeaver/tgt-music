<?
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
$arrAlbum = $tgtdb->databasetgt(" album_id, album_name, album_singer,album_viewed,album_time ","album"," album_poster = '".$_SESSION["tgt_user_id"]."' AND album_type = 1 ORDER BY album_name ASC");
?>
<form name="myform" method="post" action="cpanel/music/playlist.html">
<div class="user_">
<h3><span><? echo $_SESSION["tgt_user_name"];?></span> / <span>Mp3</span> / Quản lý playlist</h3>
<div id="ask_ok" style="display:none;"></div>
<? if(!$arrAlbum) {
	echo '<div style="padding-left: 10px;">Hiện tại bạn chưa có playlist nào.</div>';	
}else { ?>
<div class="title"><p class="left check"><input type="checkbox" onClick="checkAllFields(1);" id="checkAll" name="checkAll" /></p><p class="left"><input class="delete" type="button" id="deleteBOX" value="Xóa" /></p><p class="right bold"><? echo count($arrAlbum);?> playlist yêu thích</p><br class="clr" /></div>
<?
for($i=0;$i<count($arrAlbum);$i++) {
$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arrAlbum[$i][2]."'");
$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$album_url		= url_link($arrAlbum[$i][1],$arrAlbum[$i][0],'nghe-album');
?>
        <div class="top_video fav_song">
        	<div class="x_4_4"><input type="checkbox"  value="<? echo $arrAlbum[$i][0];?>" name="delAnn[]" onClick="checkAllFields(2);" /></div>
        	<div class="x_2">
            <a title="Nghe Album  <? echo un_htmlchars($arr[$x][0][1]); ?>" href="<? echo $album_url; ?>">
            <img class="img_album" src="<? echo check_img($arr[$x][0][3]); ?>" title="Nghe Album <? echo $arrAlbum[$i][1]; ?>" /></a>
            </div>
            <div class="x_s1">
            <p class="song"><a title="<? echo un_htmlchars($arrAlbum[$i][1]); ?>" href="<? echo $album_url; ?>"><strong><? echo un_htmlchars($arrAlbum[$i][1]); ?></strong></a></p>
            <p class="singer">Trình bày: <a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo un_htmlchars($singer_name); ?>" href="<? echo $singer_url; ?>"><? echo $singer_name; ?></a></p>
            <p class="cat">Lượt nghe: <? echo $arrAlbum[$i][3]; ?> | Ngày tạo: <? echo $arrAlbum[$i][4]; ?></p>
            </div>
        	<div class="x_s2" align="right"><a href="cpanel/music/edit-playlist/<? echo en_id($arrAlbum[$i][0]);?>.html"><img src="images/media/edit.png" border="0" /></a></div>       
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
		mysql_query("DELETE FROM tgt_nhac_album WHERE album_poster = '".$_SESSION["tgt_user_id"]."'  AND album_type = 1");
		mssBOX("Đã xóa xong !","cpanel/music/playlist.html");
	}else {
	$arr 	= $_POST['delAnn'];
	$in_sql = implode(',',$arr);
	mysql_query("DELETE FROM tgt_nhac_album WHERE album_poster = '".$_SESSION["tgt_user_id"]."'  AND album_id IN (".$in_sql.")");
	mssBOX("Đã xóa xong !","cpanel/music/playlist.html");
	}
}
?>