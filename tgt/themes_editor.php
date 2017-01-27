<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !");

function album_new($singer_type,$album_type) {
	global $tgtdb;
	if($singer_type == 1) 		$link_pages	=	'Album/Viet-Nam.html';
	elseif($singer_type == 2) 	$link_pages	=	'Album/Au-My.html';
	elseif($singer_type == 3) 	$link_pages	=	'Album/Chau-A.html';
?>
<div class="album_s02">
<?
$arr = $tgtdb->databasetgt(" album_id,album_name,album_singer,album_img ","album  LEFT JOIN tgt_nhac_singer ON (tgt_nhac_album.album_singer = tgt_nhac_singer.singer_id)"," tgt_nhac_singer.singer_type = '$singer_type' AND album_type = '$album_type' ORDER BY album_id DESC LIMIT 12");
for($z=0;$z<count($arr);$z++) {
    $id_album  = $arr[$z][0];
	$id_singer = $arr[$z][2];
	$singer_name 	= htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$album_name		= htmlchars($arr[$z][1]);
	$album_img		= check_img($arr[$z][3]);
	$album_url 		= url_link($album_name,$id_album,'nghe-album');
	if($z == 2 || $z == 5)	{
		$class[$z]	=	"fjx";
		$hang[$z]	=	"<div class=\"clr\"></div>";
	}	
	echo	"<div class=\"album_ ".$class[$z]."\">
    <p class=\"images\">
	<a title=\"$album_name - $singer_name\" href=\"$album_url\"><img src=\"$album_img\" alt=\"$album_name - $singer_name\" /></a></p>
    <h2><a title=\"$album_name - $singer_name\" href=\"$album_url\">$album_name</a></h2>
    <p><a href=\"$singer_url\" title=\"Tìm bài hát của $singer_name\">$singer_name</a></p>
</div>".$hang[$z];
}
	echo "<div class=\"read_\"><a class=\"read-more\" href=\"$link_pages\">Xem thêm</a></div>";
} 

function video_new($singer_type) {
	global $tgtdb;
if($singer_type == 1) 		$link_pages	=	'Video/Viet-Nam.html';
elseif($singer_type == 2) 	$link_pages	=	'Video/Au-My.html';
elseif($singer_type == 3) 	$link_pages	=	'Video/Chau-A.html';


$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img ","data  LEFT JOIN tgt_nhac_singer ON (tgt_nhac_data.m_singer = tgt_nhac_singer.singer_id)"," tgt_nhac_singer.singer_type = '$singer_type' AND m_type = '2' ORDER BY m_id DESC LIMIT 12");
for($z=0;$z<count($arr);$z++) {
    $id_media       = $arr[$z][0];
	$id_singer      = $arr[$z][2];
	$singer_name 	= htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$video_name		= htmlchars($arr[$z][1]);
	$video_img		= check_img($arr[$z][3]);
	$video_url 		= url_link($video_name,$id_media,'xem-video');
	if($z == 2 || $z == 5)	{
		$class[$z]	=	"fjx";
		$hang[$z]	=	"<div class=\"clr\"></div>";
	}
	echo	"<div class=\"video_ ".$class[$z]."\">
    <p class=\"images\">
	<a title=\"$video_name - $singer_name\" href=\"$video_url\"><img src=\"$video_img\" alt=\"$video_name - $singer_name\" /></a></p>
    <h2><a title=\"$video_name - $singer_name\" href=\"$video_url\">$video_name</a></h2>
    <p><a href=\"$singer_url\" title=\"Tìm bài hát của $singer_name\">$singer_name</a></p>
</div>".$hang[$z];
}
	echo "<div class=\"read_\"><a class=\"read-more\" href=\"$link_pages\">Xem thêm</a></div>";
} 

function song_new($singer_type) {

}

function top_song($type, $number = 10) {
	global $tgtdb;
// tao cache
$type_ichphienpro	=	$type;
$file = PATH."ichphienpro_".$type.".xxx"; // lấy tên file cache theo type để tránh trùng lập
$expire = 86400; // 24h
if (file_exists($file) &&
    filemtime($file) > (time() - $expire)) {
    include(PATH."ichphienpro_".$type_ichphienpro.".xxx");
} else {  
    // XH SONG
	if($type == 'bxh_vn') {
	$where 		= "m_cat LIKE '%,".IDCATVN.",%' AND m_type = 1 ORDER BY m_viewed_month DESC";
	$num		= 1;
	$link_pages	= "BXH/bai-hat/Viet-Nam.html";
	}
	elseif($type == 'bxh_am') {
	$where 		= "m_cat LIKE '%,".IDCATAM.",%' AND m_type = 1 ORDER BY m_viewed_month DESC";
	$num		= 2;
	$link_pages	= "BXH/bai-hat/Au-My.html";
	}
	elseif($type == 'bxh_ca') {
	$where 		= "m_cat LIKE '%,".IDCATHQ.",%' AND m_type = 1 ORDER BY m_viewed_month DESC";
	$num		= 3;
	$link_pages	= "BXH/bai-hat/Han-Quoc.html";
	}
	// XH VIDEO
	if($type == 'bxhv_vn') {
	$where 		= "m_cat LIKE '%,".IDCATVN.",%' AND m_type = 2 ORDER BY m_viewed_month DESC";
	$num		= 4;
	$link_pages	= "BXH/Video/Viet-Nam.html";
	}
	elseif($type == 'bxhv_am') {
	$where 		= "m_cat LIKE '%,".IDCATAM.",%' AND m_type = 2 ORDER BY m_viewed_month DESC";
	$num		= 5;
	$link_pages	= "BXH/Video/Au-My.html";
	}
	elseif($type == 'bxhv_ca') {
	$where 		= "m_cat LIKE '%,".IDCATHQ.",%' AND m_type = 2 ORDER BY m_viewed_month DESC";
	$num		= 6;
	$link_pages	= "BXH/Video/Han-Quoc.html";
	}
	if($type == 'bxh_dj') {
	$where 		= "m_cat LIKE '%,".IDCATDJ.",%' AND m_type = 1 ORDER BY m_viewed_month DESC";
	$num		= 11;
	$link_pages	= "BXH/bai-hat/DJ.html";
	}
	// NEW SONG
	elseif($type == 'new_vn') {
	$where 		= "m_type = 1 AND m_cat LIKE '%,".IDCATVN.",%' ORDER BY m_id DESC";
	$num		= 7;
	$link_pages	= "Song/Viet-Nam.html";
	}
	elseif($type == 'new_ca') {
	$where 		= "m_type = 1 AND m_cat LIKE '%,".IDCATHQ.",%' ORDER BY m_id DESC";
	$num		= 8;
	$link_pages	= "Song/Chau-A.html";
	}
	elseif($type == 'new_am') {
	$where 		= "m_type = 1 AND m_cat LIKE '%,".IDCATAM.",%' ORDER BY m_id DESC";
	$num		= 9;
	$link_pages	= "Song/Au-My.html";
	}
	elseif($type == 'new_dj') {
	$where 		= "m_type = 1 AND m_cat LIKE '%,".IDCATDJ.",%' ORDER BY m_id DESC";
	$num		= 10;
	$link_pages	= "Song/DJ.html";
	}
// XH ALBUM	
	if($type == 'bxhpl_vn') {
	$where 		= "album_cat LIKE '%,".IDCATVN.",%' AND album_type = 0 ORDER BY album_viewed_month DESC";
	$num		= 12;
	$link_pages	= "BXH/Album/Viet-Nam.html";
	}
	elseif($type == 'bxhpl_am') {
	$where 		= "album_cat LIKE '%,".IDCATAM.",%' AND album_type = 0 ORDER BY album_viewed_month DESC";
	$num		= 13;
	$link_pages	= "BXH/Album/Au-My.html";
	}
	elseif($type == 'bxhpl_ca') {
	$where 		= "album_cat LIKE '%,".IDCATHQ.",%' AND album_type = 0 ORDER BY album_viewed_month DESC";
	$num		= 14;
	$link_pages	= "BXH/Album/Han-Quoc.html";
	}
// ALBUM	
	$arr_album = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat, album_viewed ","album",$where." LIMIT ".$number);
				for($i=0;$i<count($arr_album);$i++) {
				$id_album  =  $arr_album[$i][0];
				$id_singer = $arr_album[$i][2];
				$album_title = htmlchars($arr_album[$i][1]);
				$singer_name = htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));
				$album_url = url_link($album_name,$id_album,'nghe-album');
				$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
				$album_img = check_img($arr_album[$i][3]);
				$viewed = number_format($arr_album[$i][5]);
				$stt	=	$i+1;
 // 1				
	if($num == 12 || $num == 13 || $num == 14) { 
		$HTML_BOX	.= "<div class=\"top_video\">
						<div class=\"x_2\">
						<a href=\"$album_url\" class=\"zing-video-img\" title=\"$album_title - $singer_name\"><img src=\"$album_img\" alt=\"$album_title - $singer_name\" />
						<div class=\"stt ".$classb[$i]."\">$stt</div>
						</div>
						<div class=\"x_3\">
							<p class=\"song\"><a href=\"$album_url\" title=\"$album_title - $singer_name\">$album_title</a></p>
							<p class=\"singer\">
							<a href=\"$singer_url\" title=\"Tìm bài hát của $singer_name\" class=\"\">$singer_name</a></p>
						</div>
						<div class=\"clr\"></div>
						</div>";
	}
}	
// SONG, VIDEO
	$arr = $tgtdb->databasetgt("m_id, m_title, m_img, m_singer, m_cat, m_hot, m_hq, m_viewed, m_downloaded ","data",$where." LIMIT ".$number);

for($i=0;$i<count($arr);$i++) {
	$id_media       = $arr[$i][0];
	$id_singer      = $arr[$i][3];
	$singer_name 	= htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));
	$song_title		= htmlchars($arr[$i][1]);
	$video_img		= check_img($arr[$i][2]);
	$song_url 		= url_link($arr[$i][1],$id_media,'nghe-bai-hat');
	$video_url 		= url_link($arr[$i][1],$id_media,'xem-video');
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$checkhq		= check_song($arr[$i][5],$arr[$i][6]);
	$viewed         = number_format($arr[$i][7]);
	$downloaded     = number_format($arr[$i][8]);
	$download 		= 'down.php?id='.$id_media.'&key='.md5($id_media.'tgt_music');
	$stt			= $i+1;
	// 2
	if($num == 1 || $num == 2 || $num == 3 || $num == 11) { 
		$HTML_BOX	.= "
<!-- bxh song -->		
		<div class=\"top_song\">
        	<div class=\"left num_$stt\"><img src=\"images/spc.gif\" width=\"16\" /></div>
            <div class=\"left top_z\">
            <p class=\"song_\"><a class=\"vtip\" title=\"Nghe bài hát $song_title\" href=\"$song_url\">".rut_ngan($song_title,4)."</a></p>
            <p class=\"singer_\"><a class=\"singer\" title=\"Tìm kiếm bài hát của ca sĩ $singer_name\" href=\"$singer_url\">".rut_ngan($singer_name,4)."</a></p>
			<p class=\"cat_\">Nghe: $viewed | Download: $downloaded</p>
            </div>
        <div class=\"clr\"></div>   
        </div> 
<!-- end bxh song -->		        ";
			
	}
	// 3
	elseif($num == 4 || $num == 5 || $num == 6) { 
		$HTML_BOX	.= "
<!-- bxh video -->		
             <div class=\"top_song\"> 
        	<div class=\"left\"> 
            <div class=\"s_1\"> 
                <div><a href=\"$video_url\"><img class=\"img_album\" src=\"$video_img\" title=\"Xem video $song_title\" /></a></div> 
                <div class=\"num_video_2\"><span class=\"num_left num_$stt\"><img src=\"images/spc.gif\" width=\"16\" /></span></div> 
            </div> 
            </div> 
            <div class=\"left right_09\"> 
            <p class=\"song_\"><a title=\"Xem video $song_title\" href=\"$video_url\">".rut_ngan($song_title,4)."</a></p> 
            <p class=\"singer_\"><a class=\"singer\" title=\"Tìm kiếm bài hát của ca sĩ $singer_name\" href=\"$singer_url\">".rut_ngan($singer_name,4)."</a></p> 
			<p class=\"cat_\">Xem: $viewed</p>
            </div> 
        <div class=\"clr\"></div> 
        </div>
<!-- end bxh video -->        ";
			
	}
	//4
	elseif($num == 7 || $num == 8 || $num == 9 || $num == 10) { 
		$HTML_BOX	.= "
                <!-- new song -->
<div class=\"list_song_new\">
                <div class=\"left left_top_song\">
                <p class=\"song_\"><a class=\"vtip\" title=\"Nghe bài hát $song_title\" href=\"$song_url\">".rut_ngan($song_title,6)."</a></p>
                <p class=\"singer_\"><a class=\"singer\" title=\"Tìm kiếm bài hát của ca sĩ $singer_name\" href=\"$singer_url\">".rut_ngan($singer_name,6)."</a></p>
				<p class=\"cat_\">Nghe: $viewed | Download: $downloaded</p>
                </div>
            <div class=\"right list_icon_new\">
                <!-- Playlist ADD -->
                <div class=\"right add_pl_tldi\" id=\"playlist_$id_media\"><a style=\"cursor:pointer;\" onclick=\"_load_box($id_media);\"><img src=\"images/media/add.png\"></a></div>
                <div class=\"_PL_BOX\" id=\"_load_box_$id_media\" style=\"display:none;\"><span class=\"_PL_LOAD\" id=\"_load_box_pl_$id_media\"></span></div>
                <!-- End playlist ADD -->
                <div class=\"clr\"></div>
            </div>
            <div class=\"clr\"></div>
            </div>				
                <!-- end new song--->        ";
	}
}
	$HTML_BOX	.= "<div class=\"clr\"></div><div align=\"right\" class=\"list_all_a_ fix_border_top\"><a title=\"Xem tất cả\" href=\"$link_pages\" class=\"chitiet\" >Xem tất cả</a></div>";
    $fp = fopen($file,"w");
    fputs($fp, $HTML_BOX);
    fclose($fp);
	include(PATH."ichphienpro_".$type_ichphienpro.".xxx");
	}  
}			
?>