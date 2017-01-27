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


$arr = $tgtdb->databasetgt(" album_id,album_name,album_singer,album_img ","album  LEFT JOIN tgt_nhac_singer ON (tgt_nhac_album.album_singer = tgt_nhac_singer.singer_id)"," tgt_nhac_singer.singer_type = '$singer_type' AND album_type = '$album_type' ORDER BY album_id DESC LIMIT 9");
for($z=0;$z<count($arr);$z++) {
	$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$album_name		= $arr[$z][1];
	$album_img		= $arr[$z][3];
	$album_url 		= url_link($arr[$z][1],$arr[$z][0],'nghe-album');
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


$arr = $tgtdb->databasetgt(" m_id,m_title,m_singer,m_img ","data  LEFT JOIN tgt_nhac_singer ON (tgt_nhac_data.m_singer = tgt_nhac_singer.singer_id)"," tgt_nhac_singer.singer_type = '$singer_type' AND m_type = '2' ORDER BY m_id DESC LIMIT 9");
for($z=0;$z<count($arr);$z++) {
	$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$video_name		= $arr[$z][1];
	$video_img		= $arr[$z][3];
	$video_url 		= url_link($arr[$z][1],$arr[$z][0],'xem-video');
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

// Bai hat moi
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
	
	// NEW SONG
	elseif($type == 'new_vn') {
	$where 		= "m_type = 1 AND m_cat LIKE '%,".IDCATVN.",%' ORDER BY m_id DESC";
	$num		= 7;
	$link_pages	= "Song/Viet-Nam.html";
	}
	elseif($type == 'new_am') {
	$where 		= "m_type = 1 AND m_cat LIKE '%,".IDCATAM.",%' ORDER BY m_id DESC";
	$num		= 8;
	$link_pages	= "Song/Au-My.html";
	}
	elseif($type == 'new_ca') {
	$where 		= "m_type = 1 AND m_cat LIKE '%,".IDCATHQ.",%' ORDER BY m_id DESC";
	$num		= 9;
	$link_pages	= "Song/Chau-A.html";
	}
// XH ALBUM	
	if($type == 'bxhpl_vn') {
	$where 		= "album_cat LIKE '%,".IDCATVN.",%' AND album_type = 0 ORDER BY album_viewed_month DESC";
	$num		= 10;
	$link_pages	= "BXH/Album/Viet-Nam.html";
	}
	elseif($type == 'bxhpl_am') {
	$where 		= "album_cat LIKE '%,".IDCATAM.",%' AND album_type = 0 ORDER BY album_viewed_month DESC";
	$num		= 11;
	$link_pages	= "BXH/Album/Au-My.html";
	}
	elseif($type == 'bxhpl_ca') {
	$where 		= "album_cat LIKE '%,".IDCATHQ.",%' AND album_type = 0 ORDER BY album_viewed_month DESC";
	$num		= 12;
	$link_pages	= "BXH/Album/Han-Quoc.html";
	}
// ALBUM	
	$arr_album = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat, album_viewed ","album",$where." LIMIT ".$number);
				for($i=0;$i<count($arr_album);$i++) {
				$id_album  =  $arr_album[$i][0];
				$id_singer = $arr_album[$i][2];
				$album_name = htmlchars($arr_album[$i][1]);
				$singer_name = htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));
				$album_url = url_link($album_name,$id_album,'nghe-album');
				$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
				$album_img = check_img($arr_album[$i][3]);
				$viewed = number_format($arr_album[$i][5]);
				$stt	=	$i+1;
 // 1				
	if($num == 10 || $num == 11 || $num == 12) {
		if($stt	< 4)	$classb[$i]	=	"fjx";	
		$HTML_BOX	.= "<div class=\"top_album\">
						<div class=\"x_2\">
						<a title=\"Nghe album $album_name\" href=\"$album_url\" class=\"zing-video-img\" title=\"$album_name - $singer_name\"><img src=\"$album_img\" alt=\"$album_name - $singer_name\" />
						<div class=\"stt ".$classb[$i]."\">$stt</div>
						</div>
						<div class=\"x_3\">
							<p class=\"song_\"><a title=\"Nghe album $album_name\" href=\"$album_url\" title=\"$album_title - $singer_name\">$album_name</a></p>
							<p class=\"singer\">
							<a href=\"$singer_url\" title=\"Tìm bài hát của $singer_name\" class=\"\">$singer_name</a></p>
						</div>
						<div class=\"clr\"></div>
						</div>";
	}
}	

// SONG, VIDEO
	$arr = $tgtdb->databasetgt("m_id, m_title, m_img, m_singer, m_cat, m_hot, m_hq","data",$where." LIMIT ".$number);

for($i=0;$i<count($arr);$i++) {
	$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$i][3]."'");
	$song_title		= un_htmlchars($arr[$i][1]);
	$video_img		= check_img($arr[$i][2]);
	$song_url 		= url_link($arr[$i][1],$arr[$i][0],'nghe-bai-hat');
	$video_url 		= url_link($arr[$i][1],$arr[$i][0],'xem-video');
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$checkhq		= check_song($arr[$i][5],$arr[$i][6]);
	$download 		= 'down.php?id='.$arr[$i][0].'&key='.md5($arr[$i][0].'tgt_music');
	$stt			= $i+1;
	// 1
	if($num == 1 || $num == 2 || $num == 3) { 
		if($stt	< 4)	$classb[$i]	=	"fjx";
		$HTML_BOX	.= "<div class=\"top_mp3\">
						<div class=\"x_1 ".$classb[$i]."\">$stt</div>
						<div class=\"x_2\">
							<p class=\"song\"><a href=\"$song_url\" title=\"$song_title - $singer_name\">$song_title</a></p>
							<p class=\"singer\">
							<a href=\"$singer_url\" title=\"Tìm bài hát của $singer_name\" class=\"\">$singer_name</a></p>
						</div>
						<div class=\"clr\"></div>
						</div>";
			
	}
	// 2
	elseif($num == 4 || $num == 5 || $num == 6) { 
		if($stt	< 3)	$classb[$i]	=	"fjx";
		$HTML_BOX	.= "<div class=\"top_video\">
						<div class=\"x_2\">
						<a href=\"$video_url\" class=\"zing-video-img\" title=\"$song_title - $singer_name\"><img src=\"$video_img\" alt=\"$song_title - $singer_name\" />
						<div class=\"stt ".$classb[$i]."\">$stt</div>
						</div>
						<div class=\"x_3\">
							<p class=\"song\"><a href=\"$video_url\" title=\"$song_title - $singer_name\">$song_title</a></p>
							<p class=\"singer\">
							<a href=\"$singer_url\" title=\"Tìm bài hát của $singer_name\" class=\"\">$singer_name</a></p>
						</div>
						<div class=\"clr\"></div>
						</div>";
			
	}	
			

	// 3
	elseif($num == 7 || $num == 8 || $num == 9) { 
		$HTML_BOX	.= "
                <!--song-->
                    <div class=\"list_song\">
                        <div class=\"left\">						
                        <p class=\"song\"><a title=\"Nghe bài hát ".un_htmlchars($arr[$i][1])."\" href=\"".$song_url."\">".un_htmlchars($arr[$i][1])."</a> $checkhq</p>
                        <p class=\"singer\">Trình bày: <a title=\"Tìm kiếm bài hát của ca sĩ ".un_htmlchars($singer_name)."\" href=\"".$singer_url."\">".un_htmlchars($singer_name)."</a></p>
                        <p class=\"time\">Thể loại: ".GetTheLoai($arr[$i][4])."</p>
                        </div>
                        <div class=\"right list_icon\">
							<div class=\"left\"><a href=\"".$download."\" target=\"_blank\" title=\"Tải bài hát ".$arr[$i][1]." về máy\"><img border=\"0\" src=\"images/media/down.gif\"  class=\"hover_img\" /></a></div>
							<div class=\"left\"><a href=\"".$song_url."\" target=\"_blank\" title=\"Nghe bài hát ".$arr[$i][1]." \"><img border=\"0\" src=\"images/media/play.gif\"  class=\"hover_img\" /></a></div>

							<!-- Playlist ADD -->
							<div class=\"left\" id=\"playlist_".$arr[$i][0]."\"><a style=\"cursor:pointer;\" onclick=\"_load_box(".$arr[$i][0].");\"><img src=\"images/media/add.gif\" class=\"hover_img\"  /></a></div>
							<div class=\"_PL_BOX\" id=\"_load_box_".$arr[$i][0]."\" style=\"display:none;\"><span class=\"_PL_LOAD\" id=\"_load_box_pl_".$arr[$i][0]."\"></span></div>
							<!-- End playlist ADD -->
							<div class=\"clr\"></div>
                        </div>
                    
                        <div class=\"clr\"></div>
                    </div>
                <!-- end --->";
	}
}	
	$HTML_BOX	.= "<div class=\"clr\"></div><div class=\"read_\"><a class=\"read-more\" href=\"$link_pages\">Xem thêm</a></div>";
    $fp = fopen($file,"w");
    fputs($fp, $HTML_BOX);
    fclose($fp);
	include(PATH."ichphienpro_".$type_ichphienpro.".xxx");
	}  
}

?>