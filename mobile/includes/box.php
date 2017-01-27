<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !");
include("temp.php");
include("themes.php");
function grab($url) {

if (preg_match("#http://mp3.zing.vn/bai-hat/(.*?).html#s",$url,$id_sr)){
    	$id 	= 	$id_sr[1];
		$url	=	SITE_LINK.'stream/data/z/2013/'.$id.'.mp3';		
	}
elseif (preg_match("#http://mp3.zing.vn/video-clip/(.*?).html#s",$url,$id_video)){
    	$id 	= 	$id_video[1];
		$url	=	SITE_LINK.'stream/data/cz/2013/'.$id.'.mp4';		
    }
elseif (preg_match("#http://mp3.zing.vn/tv/media/(.*?).html#s",$url,$id_video_media)){
    	$id 	= 	$id_video_media[1];
		$url	=	SITE_LINK.'tvz/'.$id.'.mp4';		
    }
elseif (preg_match("#http://tv.zing.vn/video/(.*?).html#s",$url,$id_zingtv)){
    	$id 	= 	$id_zingtv[1];
		$url	=	SITE_LINK.'stream/data/ztv/2013/'.$id.'.mp4';		
    }	
	
elseif (preg_match("#http://nhacso.net/nghe-nhac/(.*?).html#s",$url,$id_ns)){
    	$id 	= 	$id_ns[1];
		$url	=	SITE_LINK.'stream/data/ns/2013/'.$id.'.mp3';		
    }
	
elseif (preg_match("#http://music.vnn.vn/nhac/detail/(.*?).htm#s",$url,$id_musicvnn)){
    	$id 	= 	$id_musicvnn[1];
		$url	=	SITE_LINK.'stream/data/vnn/2013/'.$id.'.mp3';		
    }	
elseif (preg_match("#http://nhacso.net/xem-video/(.*?).html#s",$url,$id_video_ns)){
    	$id 	= 	$id_video_ns[1];
		$url	=	SITE_LINK.'stream/data/nsv/2013/'.$id.'.mp4';		
    }

	// NCT
elseif (preg_match("#http://www.nhaccuatui.com/mv/(.*?).html#i",$url, $id_video_nct)){
    	$id 	= 	$id_video_nct[1];
        $url = SITE_LINK.'stream/data/nctv/2013/'.$id.'.mp4';		
	}
elseif (preg_match("#http://www.nhaccuatui.com/bai-hat/(.*?).html#i",$url, $id_nct2)){
    	$id 	= 	$id_nct2[1];
        $url = SITE_LINK.'stream/data/nct2/2013/'.$id.'.mp3';		
	}	
elseif (preg_match("#http://www.nhaccuatui.com/nghe\?M=(.*?)#i",$url, $id_nct)){
        $song = explode('http://www.nhaccuatui.com/', $url);
        $song = explode('nghe?M=', $song[1]);
        $url = SITE_LINK.'stream/data/nct/2013/'.$song[1].'.mp3';		
	}
	
	// Zippeshare
elseif (preg_match("#zippyshare.com/v/(.*?)/file.html#s",$url,$id_sr)){
    	$id 	= 	$id_sr[1];
		$www = explode("http://www",$url);
		$www = explode(".zip",$www[1]);
		$id	 = $id_sr[1];
		$url = SITE_LINK.'stream/data/zip/2013/'.$www[0].'/'.$id.'.flv';		
    }
	
	// NV
elseif (preg_match("#http://hn.nhac.vui.vn/(.*?).html#s",$url,$id_nv)){
       // $id     =     $id_nv[1];
        $id     = substr(preg_replace('([^0-9])', '', $id_nv[1]),0,6);
        $url    =    SITE_LINK.'nhac-server-nv/'.$id;
    }  
	
    // NV VIDEO ALL LINK
elseif (preg_match("#nhac.vui.vn/(.*?).html#s",$url,$id_nv)){
       // $id     = 	$id_nv[1];
        $id     = substr(preg_replace('([^0-9])', '', $id_nv[1]),0,6);
    	$url	=	SITE_LINK.'stream/data/nv/2013/'.$id.'.mp4';
    } 	

	// *.mp3
elseif (preg_match("#http://(.*?).mp3#s",$url)){
        $url    =    $url;
    }
	// Youtube
elseif (preg_match("#http(.*?)://www.youtube.com/(.*?)#s",$url)){
		$url	=	$url;
    }
	
return $url;
}

function BANNER($vitri,$width='auto',$height='auto') {
	global $tgtdb;
	$adv = $tgtdb->databasetgt("adv_name, adv_img, adv_url, adv_phanloai  ","adv"," adv_vitri = '".$vitri."' AND adv_status = 0 ORDER by adv_id ASC");
	if($adv) {
		for($i=0;$i<count($adv);$i++){
				if($adv[$i][3] == 1) {
					echo '<div class="adv_padding"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="'.$width.'" height="'.$height.'" id="adv_top" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="wmode" value="transparent" /><param name="movie" value="'.$adv[$i][1].'" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="'.$adv[$i][1].'" quality="high" bgcolor="#ffffff" wmode="transparent" width="'.$width.'" height="'.$height.'" name="adv_top" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object></div>';
				}
				else {
					echo '<div class="adv_padding"><a href="'.$adv[$i][2].'" target="_bank"><img alt="'.$adv[$i][0].'" src="'.$adv[$i][1].'" border="0" width="'.$width.'" ></a></div>';
				}
		}

	}
}


function linkPage($sql,$perPage,$curPage,$url,$all){
	global $tgtdb;
	$result = mysql_query($sql);
	$totalRecord = mysql_num_rows($result);
	$re_write_mod = false;
	$strlink = "";
	if( strpos($url,"#page#") > 0 ){
		$re_write_mod = true;
	}
	$pages =  $totalRecord/$perPage;	
	if($pages > 1){
		// Previous page
		if($curPage > 1){
			$prePage = $curPage - 1;
				$tempurl = str_replace("#page#",$prePage, $url);
				$strlink .= "<a href=\"".$tempurl.".html\" class=\"pagelink\"><</a>";
		}

		// Print pages
		if($curPage > 4)
			$i = $curPage - 4;
		else
			$i = 1;
		if($pages - $curPage > 3)
			$ubound = $curPage + 3;
		else
			$ubound = $pages;

			
		for($i=$i; $i<=$ubound;$i++){
			if($i == $curPage)
				$strlink .= "<a class=\"pagecurrent\">".$i . "</a>";
			else{
					$tempurl = str_replace("#page#",$i, $url);
					$strlink .= "<a href=\"".$tempurl.".html\" class=\"pagelink\">".$i."</a>";
			}
		}// for

		if($totalRecord%$perPage != 0)
			if($i == $curPage)
				$strlink .= "<a class=\"pagecurrent\">".$i . "</a>";
			else{
					$tempurl = str_replace("#page#",$i, $url);
					$strlink .= "<a href=\"".$tempurl.".html\" class=\"pagelink\">".$i."</a>";
			}
			
		if($all != "") {
				$tempurl = str_replace("#page#","all", $url);
				$strlink .= "<a href=\"".$tempurl.".html\" class=\"pagelink\"'>view all</a>";
			}

		// Next page
		if($curPage < $pages){
				$nextPage = $curPage + 1;
				$tempurl = str_replace("#page#",$nextPage, $url);
				$strlink .=  "<a href=\"".$tempurl.".html\" class=\"pagelink\">></a>";
		}
	}
	return $strlink;

}
function pages_ajax($type,$ttrow,$limit,$page,$ext='',$apr='',$cat_id=''){
	global $tgtdb;
	$total = ceil($ttrow/$limit);
	if ($total <= 1) return '';
	$style_1 = 'class="pagelink" onfocus="this.blur()"';
	$style_2 = 'class="pagecurrent" onfocus="this.blur()"';
    if ($page<>1){
		if($type=='cam_nhan') 
		$main .= "<a $style_1 href='javascript:void(0)' onClick='return showComment(".$ext.",".$apr.",1); return false;'>Đầu</a>";
    }
	for($num = 1; $num <= $total; $num++){
		if ($num < $page - 1 || $num > $page + 4) 
		continue;
		if($num==$page) 
		$main .= "<a $style_2>$num</a>"; 
        else { 
		   if($type=='cam_nhan') 
		   $main .= "<a $style_1 href='javascript:void(0)' onClick='return showComment(".$ext.",".$num.",".$apr."); return false;'>$num</a>";
       } 		
    }
    if ($page<>$total){
		if($type=='cam_nhan') 
		$main .= "<a $style_1 href='javascript:void(0)' onClick='return showComment(".$ext.",".$total.",".$apr."); return false;'>Cuối</a>"; 
    }
  return $main;
}
function check_str($a){
	$n=intval(strlen($a)/21);
		if($n>0){
			for($i=1;$i<=$n;$i++){
				$b=$b.substr($a,0,21)." ";
				$a=substr($a,21,strlen($a));
				}
			}
		else{ $b=$a; }
	return $b;
}

function text_s($text) {
	$text = str_replace (' ', '+', $text );
	return $text;
}

function isFloodPost(){
	$_SESSION['current_message_post'] = time();
	global $wait_post;
	$timeDiff_post = $_SESSION['current_message_post'] - $_SESSION['prev_message_post'];
	$floodInterval_post	= 45;
	$wait_post = $floodInterval_post - $timeDiff_post ;	
	if($timeDiff_post <= $floodInterval_post)
	return true;
	else 
	return false;
}

function un_htmlchars($str) {
	return str_replace(array('&lt;', '&gt;', '&quot;', '&amp;', '&#92;', '&#39','&#039;'), array('<', '>', '"', '&', chr(92), chr(39), chr(39)), $str);
}
function htmlchars($str) {
	return str_replace(
		array('&', '<', '>', '"', chr(92), chr(39)),
		array('&amp;', '&lt;', '&gt;', '&quot;', '&#92;', '&#39'),
		$str
	);
}

function get_ascii($st){
		$vietChar 	= 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
		$engChar	= 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|i|i|i|i|i|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|I|I|I|I|I|Y|Y|Y|Y|Y|D';
		$arrVietChar 	= explode("|", $vietChar);
		$arrEngChar		= explode("|", $engChar);
		return str_replace($arrVietChar, $arrEngChar, $st);
	}
function replace($string) {
	$string = get_ascii($string);
    $string = preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
        array('', '-', ''), htmlspecialchars_decode($string));
    return $string;
} 

function en_id($id) {
    $id = dechex($id + 241104185);
    $id = str_replace(1,'I',$id);
    $id = str_replace(2,'W',$id);
    $id = str_replace(3,'O',$id);
    $id = str_replace(4,'U',$id);
    $id = str_replace(5,'Z',$id); 
    return strtoupper($id);
}
function del_id($id) {
    $id = str_replace('Z',5,$id);
    $id = str_replace('U',4,$id);
    $id = str_replace('O',3,$id);
    $id = str_replace('W',2,$id);
	$id = str_replace('I',1,$id);
    $id = hexdec($id);
	$id = $id - 241104185;
    return strtoupper($id);
}

function url_link($name,$id,$type,$x=0) {
	$id 	= en_id($id);
	$name 	= replace($name);
		switch($type) {
			case 'the-loai'			: $url = SITE_LINK.'the-loai-bai-hat/'.$name.'/'.$id.".html"; break;
			case 'video-cat'		: $url = SITE_LINK.'the-loai-video/'.$name.'/'.$id.".html"; break;
			case 'album-cat'		: $url = SITE_LINK.'the-loai-album/'.$name.'/'.$id.".html"; break;
			case 'nghe-bai-hat'		: $url = SITE_LINK.'bai-hat/'.$name.'/'.$id.".html"; break;
			case 'xem-video'		: $url = SITE_LINK.'video/'.$name.'/'.$id.".html"; break;
			case 'nghe-album'		: $url = SITE_LINK.'playlist/'.$name.'/'.$id.'-'.$x.".html"; break;
			case 'user'				: $url = SITE_LINK.'Member/Z/'.$name.'/'.del_id($id).".html"; break;
			case 'content'		: $url = SITE_LINK.'content/'.$name.'/'.$id.".html"; break;
		}
return $url;
}
function url_link_mobile($name,$id,$type,$x=0) {
	$id 	= en_id($id);
	$name 	= replace($name);
		switch($type) {
			case 'the-loai'			: $url = SITE_LINK.'mobile/the-loai-bai-hat/'.$name.'/'.$id.".html"; break;
			case 'video-cat'		: $url = SITE_LINK.'the-loai-video/'.$name.'/'.$id.".html"; break;
			case 'album-cat'		: $url = SITE_LINK.'the-loai-album/'.$name.'/'.$id.".html"; break;
			case 'nghe-bai-hat'		: $url = SITE_LINK.'mobile/bai-hat/'.$name.'/'.$id.".html"; break;
			case 'xem-video'		: $url = SITE_LINK.'mobile/video/'.$name.'/'.$id.".html"; break;
			case 'nghe-album'		: $url = SITE_LINK.'mobile/playlist/'.$name.'/'.$id.'-'.$x.".html"; break;
			case 'user'				: $url = SITE_LINK.'Member/Z/'.$name.'/'.del_id($id).".html"; break;
			case 'content'		: $url = SITE_LINK.'content/'.$name.'/'.$id.".html"; break;
		}
return $url;
}

function check_url_song($name,$id,$type) {
	$id 	= replace($id);
	$name 	= replace($name);
	if($type == 2) $url = SITE_LINK.'video/'.$name.'/'.en_id($id).".html";
	else $url = SITE_LINK.'bai-hat/'.$name.'/'.en_id($id).".html";
	return $url;
}

function check_url_song_mobile($name,$id,$type) {
	$id 	= replace($id);
	$name 	= replace($name);
	if($type == 2) $url = SITE_LINK.'mobile/video/'.$name.'/'.en_id($id).".html";
	else $url = SITE_LINK.'mobile/bai-hat/'.$name.'/'.en_id($id).".html";
	return $url;
}


function check_url_news($name,$id) { $id = replace($id);
$name = replace($name);


$url = SITE_LINK.'content/'.$name.'/'.en_id($id).".html";


return $url;


}

function check_img($img) {
global $web_link;
	if ($img == '') $img =SITE_LINK."temp/img/no-img.jpg";
	return $img;
}
function check_img2($img) {
global $web_link;
	if ($img == '') $img =SITE_LINK."temp/img/no-img.jpg";
	else $img = SITE_LINK.$img;
	return $img;
}

function mss($str, $return=""){
	echo "<script>alert('".$str."');";
	if($return != ""){
		echo "window.location='".$return."';";
	}
	echo "</script>";
}
function mssBOX($str, $return=""){
	echo "<script>Boxy.alert(\"".$str."\", null, {title: 'Thông báo'});";
	if($return != ""){
		echo "window.location='".$return."';";
	}
	echo "</script>";
}
function rut_ngan($str,$num) {
	$limit = $num - 1 ;
	$str_tmp = '';
	$arrstr = explode(" ", $str);
	if ( count($arrstr) <= $num ) { return $str; }
	if (!empty($arrstr))
	{
	for ( $j=0; $j< count($arrstr) ; $j++)
	{
	$str_tmp .= " " . $arrstr[$j];
	if ($j == $limit)
	{
	break;
	}
	}
	}
	return $str_tmp.'...';
} 
function check_type($type,$id_img){
	if($type == 2 || $type == 3 || $type == 5) {
	//$arr = $tgtdb->databasetgt(" video_img ","data"," m_id = '$id_img'");
	//$media_type = "<img class=\"img_video\" src=\"".check_img($arr[0][0])."\">";
	$media_type = "<img src=".SITE_LINK."images/media/type/video.png>";
	}
	else {
	$media_type = "<img src=".SITE_LINK."images/media/type/mp3.png>";
	}
	return $media_type;
}
function check_data($name) {
	if ($name == '') $name = "Đang cập nhật";
	return $name;
}
function check_info($name,$title) {
	$name	=	un_htmlchars($name);
	if ($name == '' || $name == '<p>&#160;</p>') $name = "Nghe nhạc online ".$title." tại website . Download album nhạc số chất lượng cao, thưởng thức video clip, chèn nhạc vào blog tại mạng giải trí số một Việt Nam ! ";
	return $name;
}

function check_hot($id) {
	if ($id == '1') $img = "<img src=\"".SITE_LINK."images/media/hot.png\">";
	else $img = "";
	return $img;
}
function check_hq($id) {
	if ($id == '1') $img = "<img src=\"".SITE_LINK."images/media/hq.png\">";
	else $img = "";
	return $img;
}

function check_avt($img) {
	if ($img == "") $img = SITE_LINK.'images/media/no_avatar.jpg';
	return $img;
}

function check_kbs($name) {
	if ($name == "") $name = "320kb/s";
	else $name = $name;
	return $name;
}

function ucBr($data)
{
	$data=str_replace("http://","***",$data);
	$data=str_replace(".net","***",$data);
	$data=str_replace(".com","***",$data);
	$data=str_replace(".vn","***",$data);
	$data=str_replace(".info","***",$data);
	$data=str_replace(".biz","***",$data);
	$data=str_replace(".tv","***",$data);
	//1
	$data=str_replace("lồn","***",$data);
	$data=str_replace("lồN","***",$data);
	$data=str_replace("lỒn","***",$data);
	$data=str_replace("lỒN","***",$data);
	$data=str_replace("LỒN","***",$data);
	$data=str_replace("LỒn","***",$data);
	$data=str_replace("LồN","***",$data);
	$data=str_replace("Lồn","***",$data);
	//1
	$data=str_replace("cặc","***",$data);
	$data=str_replace("cẶc","***",$data);
	$data=str_replace("cặC","***",$data);
	$data=str_replace("cẶC","***",$data);
	$data=str_replace("Cặc","***",$data);
	$data=str_replace("CặC","***",$data);
	$data=str_replace("CẶc","***",$data);
	$data=str_replace("CẶC","***",$data);
	//1
	$data=str_replace("đụ","***",$data);
	$data=str_replace("đỤ","***",$data);
	$data=str_replace("ĐỤ","***",$data);
	$data=str_replace("Đụ","***",$data);
	//1
	$data=str_replace("địt","***",$data);
	$data=str_replace("đỊt","***",$data);
	$data=str_replace("địT","***",$data);
	$data=str_replace("đỊT","***",$data);
	$data=str_replace("ĐỊT","***",$data);
	$data=str_replace("ĐỊt","***",$data);
	$data=str_replace("ĐịT","***",$data);
	$data=str_replace("Địt","***",$data);
	return $data;
}
function text_tidy($txt = "", $htmlchars = false) {
	if ($htmlchars) $txt = htmlspecialchars($txt);
	$txt = str_replace("\n","<br>",$txt);
	return $txt;
}

function xem_web($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
}
function get_str($source,$start,$end){
		if($start == ''){
			$str = explode($end,$source);
			return $str[0];
				}elseif($end == ''){
					return str_replace($start,"",strstr($source,$start));
				}else{
				$str = explode($start,$source);
				$str = explode($end,$str[1]);
				return $str[0];
				}
		}
function check_song($t1,$t2) {
	if ($t1 == 1) $img .= "<img src=\"images/media/hit.gif\">";
	if ($t2 == 1) $img .= "<img src=\"images/media/hq.gif\">";
	return $img;
}
function m_counter() {
	$time = time();
	$sid = session_id();
	$seconds = 60 * 60;
	mysql_query("DELETE FROM tgt_nhac_counter WHERE time < ".$time." OR sid = ''");
	$q = mysql_query("SELECT ip FROM tgt_nhac_counter WHERE ip='".IP."' AND sid='".$sid."' AND time > ".$time);
	$CountFile = "counter.log";
    $CF = fopen ($CountFile, "r");
    $luot_tc = fread ($CF, filesize ($CountFile) );
    fclose ($CF);
	if (!mysql_num_rows($q)) {
		$luot_tc +=1;
		$CF = fopen ($CountFile, "w");
      	fwrite ($CF, $luot_tc);
      	fclose ($CF);
		mysql_query("INSERT INTO tgt_nhac_counter VALUES ('".IP."','".$sid."','".($time+$seconds)."')");
	}
	else {mysql_query("UPDATE tgt_nhac_counter SET time = '".($time+$seconds)."' WHERE ip = '".IP."' AND sid = '".$sid."'");
	}
	return $luot_tc;
}
function box_online() {
	$sid = session_id();
    $CurrentTime = time();
    $TimeOut = $CurrentTime - 3000;
    
    mysql_query("DELETE FROM tgt_nhac_online WHERE time < $TimeOut");
    
    $UserName = $_SESSION["username"];
    mysql_query("DELETE FROM tgt_nhac_online WHERE name='' and sid=\"$sid\"");
    $check_sid_exist = mysql_num_rows(mysql_query("SELECT * FROM tgt_nhac_online WHERE sid = \"$sid\""));
    
    if ($check_sid_exist!=0)
    {
        mysql_query("UPDATE tgt_nhac_online SET time = \"$CurrentTime\" WHERE sid = \"$sid\"");
    }
    else
    {
        mysql_query("INSERT INTO tgt_nhac_online(name, sid, time)
                                            VALUES (\"$UserName\", \"$sid\", \"$CurrentTime\")");
    }
    //Tổng số Guest đang online
    $totalguest_qr = mysql_query("SELECT count(*) AS gnum FROM tgt_nhac_online WHERE name = ''");
    while ($gnum = mysql_fetch_array($totalguest_qr))
    { $ttg = $gnum['gnum']+1; } // +100 bằng them 100 nguoi
    //Tổng số User đang online
    $totaluser_qr = mysql_query("SELECT count(DISTINCT name) AS unum FROM tgt_nhac_online WHERE name != ''");
    while ($unum = mysql_fetch_array($totaluser_qr))
    { $ttu = $unum['unum']; }
	$total = $ttg + $ttu;
    //Danh sách user đang truy cập
    $userlist_qr = mysql_query("SELECT name FROM tgt_nhac_online WHERE name != ''");
    while ($ulist = mysql_fetch_array($userlist_qr))
    { $userlist .= $ulist['name'].", "; }	
  	// Tong thanh vien
	$thanhvien=mysql_query("Select * from tgt_nhac_user") or die(mysql_error());
	$tong_thanh_vien = mysql_num_rows($thanhvien);
	// thanh viên mới đăng ký
	$thanhvienmoi=mysql_query("select * from tgt_nhac_user order by userid desc limit 1") or die(mysql_error());
			while($memmoi=mysql_fetch_array($thanhvienmoi)){
			$userid=$memmoi[userid];
			$username=$memmoi[username];
			}	
	// Tong bai hat
	$tong_so_bai_hat=mysql_query("Select m_id from tgt_nhac_data") or die(mysql_error());
	$bai_hat = mysql_num_rows($tong_so_bai_hat);
		// Tong album
	$tong_so_album=mysql_query("Select album_id from tgt_nhac_album") or die(mysql_error());
	$album = mysql_num_rows($tong_so_album);
			// Tong ca sy
	$tong_so_ca_sy=mysql_query("Select singer_id from tgt_nhac_singer") or die(mysql_error());
	$casy = mysql_num_rows($tong_so_ca_sy);	
    
?>
                  <div class="box w_3">
                  	<h1>♪ Thống Kê Website</h1>
                        <div class="border_h2">
                            <div class="thong_ke" style="height: 25px; width: auto; border-bottom: 1px solid #DCDCDC;">
							<p class="top_song1" style=" padding-top: 5px;">&nbsp; - Tổng lượt truy cập: <strong> <? echo m_counter();?> </strong></p></div>
			<!---- <div class="thong_ke" style="height: 45px; width: auto; border-bottom: 1px solid #DCDCDC;">
							<p class="top_song1">&nbsp;Tổng số người đang online <strong><? echo $total;?></strong></p>
                            <p class="top_song1" style="padding-left: 30px;">+ <strong><? echo $ttg;?></strong> khách<br />+ <strong><? echo $ttu;?></strong> thành viên</p></div>--->
                            <div class="thong_ke" style="height: 22px; width: auto; padding-top: 5px; border-bottom: 1px solid #DCDCDC;">
                            <p class="top_song1">&nbsp; - Tổng số bài nhạc : <strong><? echo $bai_hat;?></strong></p></div>
                            <div class="thong_ke" style="height: 22px; width: auto; padding-top: 5px; border-bottom: 1px solid #DCDCDC;">

                            <p class="top_song1">&nbsp; - Tổng số album : <strong><? echo $album;?></strong></p></div>
                            <div class="thong_ke" style="height: 22px; width: auto; padding-top: 5px; border-bottom: 1px solid #DCDCDC;">

                            <p class="top_song1">&nbsp; - Tổng số ca sỹ : <strong><? echo $casy;?></strong></p> </div>
                            <div class="thong_ke" style="height: 40px; width: auto; padding-top: 5px;">
                            <p class="top_song1">&nbsp; - Tổng số thành viên : <strong><? echo $tong_thanh_vien;?></strong></p>
                            <p class="top_song1" style=" padding-top: 5px;">&nbsp;  Thành viên mới : <strong><a href="Member/Z/user/<? echo $userid;?>.html" title="Xem thông tin thành viên <? echo $username;?>"><? echo $username;?> </strong></a></p></a></div>
                         </div>
                         </div>
<?
}
?>