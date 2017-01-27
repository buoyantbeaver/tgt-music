<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
// ket noi database
$link_music 	= 	mysql_connect(SERVER_HOST,DATABASE_USER,DATABASE_PASS, true);
$dataconnect	=	mysql_select_db(DATABASE_NAME, $link_music);
if(!$dataconnect)	die("Error: ".mysql_error());	

// class mysql database 
class	dbmysql {
function databasetgt($item,$table,$con){
	global $link_music;
	$table	=	trim($table);
	$arr=null;
	$i=(float) 0;
	$sql="SELECT $item FROM ".DATABASE_NAME.'.tgt_nhac_'.$table;
	if($con!="")
		$sql.=" WHERE $con";
	$result= mysql_query($sql,$link_music);
	if ($result){
		while($myrow = mysql_fetch_row($result)){
			$count = mysql_num_fields($result);
			for($j=(float)0;$j<$count;$j++)
				$arr[$i][$j]=$myrow[$j];
			$i++;
		}
		mysql_free_result($result);
		return $arr;
   }
   else
	return false;
}
}

function get_data($table, $field, $con){
	global $tgtdb;
	$arr = $tgtdb->databasetgt($field , $table , $con);
	if(count($arr) > 0)
		return $arr[0][0];
	else
		return false;
}
function GetTheLoai($cat_id,$type='song') {
	 $cat_list	=	substr($cat_id, 1);
	 $cat_list	=	substr($cat_list,0,-1);
	 $s = explode(',',$cat_list);
     foreach($s as $x=>$val) {
		$name_cat	=	get_data("theloai","cat_name"," cat_id = '".$s[$x]."'");
		if($type	==	'album')
			$url_cat	=	url_link($name_cat,$s[$x],'album-cat');
		elseif($type	==	'video')
			$url_cat	=	url_link($name_cat,$s[$x],'video-cat');
		else
			$url_cat	=	url_link($name_cat,$s[$x],'the-loai');
		$html_cat  .=	"<span class=\"singer_\"><a href=\"".$url_cat."\" title=\"".$name_cat."\">".$name_cat."</a></span>, ";
	 }
	 $html_cat 		= substr($html_cat,0,-2);
	 return $html_cat;
}


function GetCAT($cat_id) {
	 $cat_list	=	substr($cat_id, 1);
	 $cat_list	=	substr($cat_list,0,-1);
	 $s = explode(',',$cat_list);
     foreach($s as $x=>$val) {
		$name_cat	=	get_data("theloai","cat_name"," cat_id = '".$s[$x]."'");
		$html_cat  .=	$name_cat.", ";
	 }
	 $html_cat 		= substr($html_cat,0,-2);
	 return $html_cat;
}

function _getCurrentTime() { 
                      return new Date().getTime();
}
function SoBaiHat($chuoi) {
	$count = substr_count($chuoi, ',')+1;
	return $count;
}
function GetTIMEDATE($date) {
	$date = date("d/m/Y g:i A",$date);
	return $date;
}
function CheckSingerInfo($value,$singer_id,$type) {
	global $tgtdb;
	if($type == 1) {
		if($value == "") $value = 'Chưa có thông tin về ca sĩ này.!';
		else $value = $value.'<br><a class="_viewMore" onclick="LoadInfoSinger(\''.$singer_id.'\',1,'.$type.');">Xem toàn bộ</a>';
	} else { 
		if($value == "") $value = 'Bài hát này chưa có lời.!';
		else $value = $value.'<p><a onclick="LoadInfoSinger(\''.$singer_id.'\',1,'.$type.');">Xem toàn bộ</a></p>';
	}
	return $value;
}
function get_user($user_id){
	global $tgtdb;
	$arr = $tgtdb->databasetgt("username " , "user" , "userid = '".$user_id."'");
	if(count($arr) > 0) {
		$user_name = $arr[0][0];
		return $user_name;
		}
	else
		return false;
}
function get_url($id, $url){
	global $tgtdb;
	$arr = $tgtdb->databasetgt(" local_link " , "local" , "local_id = '$id'");
	if(count($arr) > 0) 
	$link = $arr[0][0].'/'.$url;
	else $link = $url;
	
	return $link;
}


function getConfig($key){
	global $tgtdb;
	$arr = $tgtdb->databasetgt(" cf_value ","config"," cf_name ='".$key."'");
	if(count($arr) > 0)
		return $arr[0][0];
	else
		return false;
}

function tinh_tuan($a)
{
	$hours = $a * 24;
	$added = ($hours * 3600)+time();
	$month = date("m", $added);
	$day = date("j", $added);
	$year = date("Y", $added);
	$result = "$day/$month/$year";
	return ($result);
}
function DeleteCache($dir,$rf = "") {
    $mydir = opendir($dir);
          while(false !== ($file = readdir($mydir))) {
              if($file != "." && $file != "..") {
                  if(!is_dir($dir.$file)) {
                          unlink($dir.$file) or DIE("Không thể xóa $dir$file<br />");
                  }

              }
          }
	closedir($mydir);
	if($rf != "") {
		header ("Location: ../index.php");
	}
	exit();
}
function delFile($path){
	$path	=	$_SERVER["DOCUMENT_ROOT"].$path;
	if(file_exists($path)){
		@unlink($path);
		return true;
	}else
		return false;
}

// set cookie
function _SETCOOKIE($name, $value = ""){ 
	$expires = time() + 60*60*24*365; 
	setcookie($name, $value, $expires, "/");
} 
// lay cookie
function _GETCOOKIE($name){ 
	if (isset($_COOKIE[$name])) return urldecode($_COOKIE[$name]); 
	else return FALSE; 
} 
?>