<?php

function acp_type($i) {
	$html = "<select name=\"type\">".
		"<option value=1".(($i==1)?' selected':'').">MP3</option>".
		"<option value=2".(($i==2)?' selected':'').">VIDEO</option>".
	"</select>";
	return $html;
}


function acp_cat($id = 0, $add = false) {
	global $link_music,$tgtdb;
	//$arr = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id IS NULL OR sub_id = 0 ORDER BY cat_order ASC");
	echo '<div class="left_cat"><strong>Danh sách thể loại</strong><br><select class="select" multiple name="fromBoxCat" id="fromBoxCat">';
	//for($i=0;$i<count($arr);$i++) {
	$cat = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id = 0 ORDER BY cat_order ASC");
	// sub 1
		for($z=0;$z<count($cat);$z++) {

        echo "<option value=\"".$cat[$z][0]."\">".$cat[$z][1]."</option>";
			// sub 2
			$sub_2 = $tgtdb->databasetgt("cat_id, cat_name","theloai"," sub_id  = '".$cat[$z][0]."' ORDER BY cat_order ASC");
			for($x=0;$x<count($sub_2);$x++) {
			echo "<option value=\"".$sub_2[$x][0]."\">&nbsp;&nbsp;|----".$sub_2[$x][1]."</option>";
			}
		}
		
	//} 
	echo "</select><span><a href=\"#\" id=\"add\">Thêm thể loại»</a></span></div>";
	echo "<div class=\"left_cat\"><strong>Thể loại đã chọn</strong><br><select class=\"select\" multiple name=\"cat[]\" id=\"cat\">";
	$cat_all	=	substr($id, 1);
	$cat_all	=	substr($cat_all,0,-1);
	$cat_list = $tgtdb->databasetgt("cat_id, cat_name","theloai"," cat_id IN (".$cat_all.")");
	if($cat_all != "") {
		for($y=0;$y<count($cat_list);$y++) {
		echo "<option value=\"".$cat_list[$y][0]."\" selected >".$cat_list[$y][1]."</option>";
		}
	}
	echo "</select>";
	echo "<span><a href=\"#\" id=\"remove\">« Xóa thể loại</a></span></div>";
}
function acp_add_cat($id,$su) {
	global $link_music,$tgtdb;
	if($su == 'sub_id') {
	$arr = $tgtdb->databasetgt(" * ","theloai"," sub_id = 0 ORDER BY cat_order ASC");
	$html = "<select name=\"sub\">";
	$html .= "<option value=0>  Mục chính  </option>";
	for($z=0;$z<count($arr);$z++) {
		$html .= "<option value=".$arr[$z][0].(($arr[$z][0] == $id)?" selected":"").">".$arr[$z][2]."</option>";
	}
	$html .= "</select>";
	}else {
	$arr = $tgtdb->databasetgt(" * ","theloai"," sub_id != 0 AND cat_type = 'mp3' ORDER BY cat_order ASC");
	$html = "<select name=\"sub_2\">";
	$html .= "<option value=0>Không Chọn</option>";
	for($z=0;$z<count($arr);$z++) {
		$html .= "<option value=".$arr[$z][0].(($arr[$z][0] == $id)?" selected":"").">|--".$arr[$z][2]."</option>";
	}
	$html .= "</select>";
	}
	return $html;
}

function acp_server($id) {
	global $link_music,$tgtdb;
	$arr = $tgtdb->databasetgt(" * ","local"," local_id ORDER BY local_id ASC");
	$html = "<select name=\"server\">";
	$html .= "<option value=0>---Không chọn---</option>";
	for($z=0;$z<count($arr);$z++) {
		$html .= "<option value=".$arr[$z][0].(($arr[$z][0] == $id)?" selected":"").">Server ".$arr[$z][0]."</option>";
	}
	$html .= "</select>";
	return $html;
}
function acp_singer($id = 0, $add = false) {
	global $link_music,$tgtdb;
	$id = (int)$id;
	$arr = $tgtdb->databasetgt(" singer_id, singer_name ","singer"," singer_id = '".$id."'");
	$html = "<select name=singer>";
	$html .= "<option value=dont_edit".(($id == 0)?" selected":'').">Không sửa</option>";
	$html .= "<option value=1".((($id == 1) && !$add)?" selected":'').">V.a (Việt Nam)</option>";
	$html .= "<option value=2".(($id == 2 && !$add)?" selected":'').">V.a (Âu Mỹ)</option>";
	$html .= "<option value=3".(($id == 2 && !$add)?" selected":'').">V.a (Châu Á)</option>";
	if($arr) {
	$html .= "<option value=".$arr[0][0].(($id == $arr[0][0])?" selected":'').">".$arr[0][1]."</option>";
	}
	$html .= "</select>";
	return $html;
}

function acp_singer_type($i) {
	$html = "<select name=\"singer_type\">".
		"<option value=1".(($i==1)?' selected':'').">CA SĨ VIỆT</option>".
		"<option value=2".(($i==2)?' selected':'').">CA SĨ ÂU MỸ</option>".
		"<option value=3".(($i==3)?' selected':'').">CA SĨ CHÂU Á</option>".
	"</select>";
	return $html;
}
function acp_album_list($id = 0, $add = false) {
	global $link_music,$tgtdb;
	$arr = $tgtdb->databasetgt(" * ","album"," album_id ORDER BY album_name ASC");
	$html = "<select name=album>";
	if ($add) $html .= "<option value=dont_edit".(($id == 0)?" selected":'').">Không sửa</option>";
	$html .= "<option value=0".(($id == 0 && !$add)?" selected":'').">Chưa biết</option>";
	for($i=0;$i<count($arr);$i++) {
		$html .= "<option value=".$arr[$i][0].(($id == $arr[$i][0])?" selected":'').">".$arr[$i][1]."</option>";
	}
	$html .= "</select>";
	return $html;
}
function them_moi_singer_form() {
	$html = "<input name=new_singer class=singer_1 size=35>  <select class=singer_2 name=singer_type>".
		"<option value=1".(($i==1)?' selected':'').">Ca Sĩ Việt Nam</option>".
		"<option value=2".(($i==2)?' selected':'').">Ca Sĩ Âu Mỹ</option>".
		"<option value=3".(($i==3)?' selected':'').">Ca Sĩ Châu Á</option>".
	"</select>";
	return $html;
}
function them_moi_singer($new_singer,$singer_type) {
	global $link_music,$tgtdb;
	$new_singer =  htmlchars(stripslashes($new_singer));
	$arr = $tgtdb->databasetgt(" singer_id ","singer"," singer_name = '".$new_singer."'");
	if (count($arr)>0) {
		$singer = $arr[0][0];
	}
	else {
		mysql_query("INSERT INTO tgt_nhac_singer (singer_name,singer_name_ascii,singer_type) VALUES ('".$new_singer."','".strtolower(get_ascii($new_singer))."','".$singer_type."')");
		$singer = mysql_insert_id();
	}
	return $singer;
}

function them_moi_album_form() {

	$html = "Tên : <input name=new_album size=50><br>Hình : <input name=album_img type=file size=50>";

	return $html;

}



function them_moi_album($new_album,$album_singer,$album_img,$album_cat,$album_song,$album_info,$album_poster) {

	global $link_music,$tgtdb;

	$new_album  =  htmlchars(stripslashes($new_album));
	$album_info =  htmlchars(stripslashes($album_info));
	$arr = $tgtdb->databasetgt(" album_id ","album"," album_name = '".$new_album."'");

	if (count($arr)>0) {

		$album = $arr[0][0];

	}

	else {
		$album_poster = $_SESSION['admin_id'];
		mysql_query("INSERT INTO tgt_nhac_album (album_name,album_name_ascii,album_singer,album_img,album_info,album_poster,album_cat,album_song,album_type,album_time) VALUES ('".$new_album."','".strtolower(get_ascii($new_album))."','".$album_singer."','".$album_img."','".$album_info."','".$album_poster."','".$album_cat."','".$album_song."','0','".GetTIMEDATE(NOW)."')");

		$album = mysql_insert_id();

	}

	return $album;

}



function grab_img($url) {
if (preg_match("#youtube.com/v/([^/-]+)#s",$url,$id_yt)){
		$img = 'http://img.youtube.com/vi/'.$id_yt[1].'/mqdefault.jpg';
	}
elseif (preg_match("#youtube.com/watch\?v=([^/]+)#s",$url, $id_sr)){
		$img = 'http://img.youtube.com/vi/'.$id_sr[1].'/mqdefault.jpg';
	}
elseif (preg_match("#http://mp3.zing.vn/video-clip/(.*?).html#s",$url,$id_sr)){
		$a=file_get_contents($url);
    	$aArray=explode('<meta property="og:image" content="',$a);
    	$A=explode('" />',$aArray[1]);
		$img=$A[0];	
    }
elseif (preg_match("#http://mp3.zing.vn/tv/media/(.*?).html#s",$url,$id_sr)){
		$a=file_get_contents($url);
    	$aArray=explode('<link rel="image_src" href="',$a);
    	$A=explode('" />',$aArray[1]);
		$img=$A[0];	
    }
	elseif (preg_match("#http://tv.zing.vn/video/(.*?).html#s",$url,$id_sr)){
		$a=file_get_contents($url);
    	$aArray=explode('<meta property="og:image" content="',$a);
    	$A=explode('" />',$aArray[1]);
		$img=$A[0];	
    }
elseif (preg_match("#http://nhacso.net/xem-video/(.*?).html#s",$url,$id_sr)){
		$a=file_get_contents($url);
    	$aArray=explode('<link href="',$a);
    	$A=explode('" rel="image_src" />',$aArray[1]);
		$img=$A[0];	
    }	
elseif (preg_match("#http://www.nhaccuatui.com/mv/(.*?).html#s",$url,$id_sr)){
		$a=file_get_contents($url);
    	$aArray=explode('<meta property="og:image" content="',$a);
    	$A=explode('"/>',$aArray[1]);
		$img=$A[0];	
    }	
return $img;

}

?>