<?php
$album_id	=	del_id($id);
$arrz 		= 	$tgtdb->databasetgt(" album_id, album_name, album_info, album_song ","album"," album_poster = '".$_SESSION["tgt_user_id"]."' AND album_id = '".$album_id."'");
?>
<div class="user_">
<h3><span><? echo $_SESSION["tgt_user_name"];?></span> / <span>Mp3</span> / sửa playlist</h3>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" name="Save">
<div>
<table width="100%" cellpadding="0" cellspacing="4">
<tr><td width="100" align="right">Tên playlist</td><td><input type="text" name="PLNAME" value="<? echo $arrz[0][1];?>" size="50" /></td></tr>
<tr><td align="right" valign="top">Mô tả</td><td><textarea style="width:400px; height: 50px;" name="PLINFO"><? echo $arrz[0][2];?></textarea></td></tr>
</table>
</div>
<h3 class="bg"><span>Bài hát trong playlist: (<? echo SoBaiHat($arrz[0][3]);?>)<span></h3>
<div class="fav_song">
<div id="list"><div id="response"></div>
<div id="playlist_field"><ul id="LoadSongAlbum">
<?
	$s = explode(',',$arrz[0][3]);
	foreach($s as $x=>$val) {
		$arr[$x] = $tgtdb->databasetgt(" m_id, m_title, m_singer ","data"," m_id = '".$s[$x]."'");
		$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$x][0][2]."'");
		$stt	=	$x+1;
?>
<li id="arrayorder_<? echo $arr[$x][0][0];?>"><div class="left"><? echo $stt.". ".$arr[$x][0][1];?> - <? echo $singer_name;?></div><div class="right"><a onClick="xSongAlbum(<? echo $arrz[0][0];?>,<? echo $arr[$x][0][0];?>);" style="cursor: pointer;"><img src="images/media/delete.gif" border="0"></a></div><div class="clr"></div></li>
<? } ?>
</ul></div>
</div>
<div align="right" style="padding-top: 10px;"><input class="_add_" type="submit" name="Save" value="Lưu lại"></div>
</form>
</div>
<?
if($_POST['Save']) {
	$album_name 	= htmlchars(stripslashes($_POST['PLNAME']));
	$album_info 	= htmlchars(stripslashes($_POST['PLINFO']));
	if(!$album_name) mssBOX("Bạn chưa nhập tên album !",$_SERVER["REQUEST_URI"]);
	else {
	mysql_query("UPDATE tgt_nhac_album SET album_name = '".$album_name."',album_name_ascii = '".get_ascii($album_name)."', album_info = '".$album_info."' WHERE album_id = '".$album_id."'");
	mssBOX("Playlist của bạn đã được lưu lại !","cpanel/music/playlist.html");
	}
}
?>
<script type="text/javascript">
$(document).ready(function(){ 	
function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
});
}, 500);}
    $("#response").hide();
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {	
			var order = $(this).sortable("serialize") + '&update=update&id_album=<? echo $album_id;?>'; 
			$.post("update-album.php", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});
</script>