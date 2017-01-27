<?php
define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../../tgt/class.inputfilter.php");
include("../../tgt/securesession.class.php");
include("../../tgt/class.upload.php");
include("../fckeditor/fckeditor.php");
include("../functions.php");
$myFilter = new InputFilter();
$upload = new UPLOAD_FILES();
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
$ss->Open();
include("../auth.php");

if(isset($_GET["mode"])) $mode=$myFilter->process($_GET["mode"]);
if(isset($_GET["del_id"])) $del_id=$myFilter->process($_GET["del_id"]);
if(isset($_GET["id"])) $id=$myFilter->process($_GET["id"]);

if ($del_id) {
	if ($_POST['submit']) {
		$del_id	= del_id($del_id);
		$arr_img = $tgtdb->databasetgt(" m_img ","data"," m_id = '".$del_id."'");
		delFile($arr_img[0][0]);
		mysql_query("DELETE FROM tgt_nhac_data WHERE m_id = '".$del_id."'");
		mss ("Đã xóa xong ","library.php");
	}
	?>
    <table align="center" width="100%" style="border: 1px solid red;">
    <form method="post">Bạn có muốn xóa media này không ? <input class="sutm" value="Có" name=submit type=submit class=submit></form>
    </table><?
}


// ADD SONGS
if($mode == 'add') {
	if(isset($_POST['submit'])) {
		if($_POST['song'] == "" || $_POST['url'] == "") {
			mss ("Chưa nhập đầy đủ thông tin ");
		}
		if($_POST['song'] && $_POST['url']) { 	
			$song		 = htmlchars(stripslashes(trim(urldecode($_POST['song']))));
			$song_ascii  = strtolower(get_ascii($song));
				if($_POST['new_singer'] && $_POST['singer_type']) {
					$new_singer 	 = htmlchars(stripslashes(trim(urldecode($_POST['new_singer']))));
					$singer_type = $_POST['singer_type'];
					$singer = them_moi_singer($new_singer,$singer_type);
				}
			else {
			$singer 	 = $_POST['singer'];
			}
			$sangtac	 = htmlchars(stripslashes(trim(urldecode($_POST['sangtac']))));	
			$cat		 = implode(',',$_POST['cat']);
			$cat		 = ",".$cat.",";
			$url		 = htmlchars(stripslashes(trim(urldecode($_POST['url']))));			
			$local		 = $_POST['server'];
			$lyric		 = htmlchars(stripslashes(trim(urldecode($_POST['lyric']))));
			$user_id	 = $_SESSION['admin_id'];
			$type		 = $_POST['type'];
			if(move_uploaded_file ($_FILES['img']['tmp_name'],FOLDER_VIDEO."/[PHUMY-US]-".time()."-".$_FILES['img']['name'])) {
					$img = LINK_VIDEO."/[PHUMY-US]-".time()."-".$_FILES['img']['name'];
			}
			elseif($_POST['grab_img']) $img = grab_img($url);
			else $img = $_POST['img'];
			
			$action		 = "media.php?mode=add";
			mysql_query("INSERT INTO tgt_nhac_data (m_title,m_title_ascii,m_singer,m_cat,m_poster,m_sang_tac,m_lyric,m_type,m_url,m_img,m_is_local,m_time) 
						 VALUES ('".$song."','".$song_ascii."','".$singer."','".$cat."','".$user_id."','".$sangtac."','".$lyric."','".$type."','".$url."','".$img."','".$local."','".NOW."')");
			mss ("Thêm media mới thành công ","media.php?mode=add");
		}
	}
include("media_act.php"); }
if($mode == 'edit') {
		$id	= del_id($id);
		$arrz = $tgtdb->databasetgt(" m_id, m_title, m_singer,m_cat,m_url,m_img, m_is_local, m_lyric, m_type, m_sang_tac ","data"," m_id = '$id'");
		$action			= "media.php?mode=edit&id=".en_id($id);
		if(isset($_POST['submit'])) {
			if($_POST['song'] == "" || $_POST['url'] == "") {
				mss ("Chưa nhập đầy đủ thông tin ");
			}
			else { 	
				$song		 = htmlchars(stripslashes(trim(urldecode($_POST['song']))));
				$song_ascii  = strtolower(get_ascii($song));
				if($_POST['new_singer'] && $_POST['singer_type']) {
					$new_singer 	 = htmlchars(stripslashes(trim(urldecode($_POST['new_singer']))));
					$singer_type 	 = $_POST['singer_type'];
					$singer = them_moi_singer($new_singer,$singer_type);
				}
				else {
				$singer 	 = htmlchars(stripslashes(trim(urldecode($_POST['singer']))));
				}
				$sangtac	 = htmlchars(stripslashes(trim(urldecode($_POST['sangtac']))));	
				$cat		 = implode(',',$_POST['cat']);
				$cat		 = ",".$cat.",";
				$url		 = htmlchars(stripslashes(trim(urldecode($_POST['url']))));
				$local		 = htmlchars(stripslashes(trim(urldecode($_POST['server']))));
				$lyric		 = htmlchars(stripslashes(trim(urldecode($_POST['lyric']))));
				$type		 = $_POST['type'];
				if(move_uploaded_file($_FILES['img']['tmp_name'],FOLDER_VIDEO."/[PHUMY-US]-".time()."-".$_FILES['img']['name'])) {
					delFile($arrz[0][5]);
					$img = LINK_VIDEO."/[PHUMY-US]-".time()."-".$_FILES['img']['name'];
				}
				elseif($_POST['grab_img']) $img = grab_img($url);
				else $img = $arrz[0][5];
				
				mysql_query("UPDATE tgt_nhac_data SET
					m_title			=  	'".$song."',
					m_title_ascii 	= 	'".$song_ascii."',
					m_singer		= 	'".$singer."',
					m_sang_tac		= 	'".$sangtac."',
					m_cat			=	'".$cat."',
					m_url			=	'".$url."',
					m_img			=	'".$img."',
					m_is_local		=	'".$local."',
					m_type			=	'".$type."',
					m_lyric			=	'".$lyric."'
			  WHERE m_id 			= 	'$id'
				");
				mss ("sửa media thành công ","library.php");
			}
		}
	include("media_act.php");

}
if($mode == 'multi_add_song') {
	include("multi_song.php");
}
if($mode == 'multi_zing') {
	include("multi_zing.php");
}
if($mode == 'multi_zingz') {
	include("multi_zingz.php");
}
if($mode == 'multi_you_playlist') {
include("multi_you_playlist.php");
}
if($mode == 'multi_zing_tl') {
	include("multi_zing_tl.php");
}
if($mode == 'multi_singer_zing') {
	include("multi_singer_zing.php");
}
if($mode == 'multi_video_singer_zing') {
	include("multi_video_singer_zing.php");
}
if($mode == 'multi_video_bxh') {
	include("mutil_bxhvd.php");
}
if($mode == 'multi_zing_bxh') {
	include("multi_zing_bxh.php");
}
//if($mode == 'multi_mv_nct') {
//	include("multi_mv_nct.php");
//}
//if($mode == 'multi_cat_nct') {
//	include("multi_cat_nct.php");
//}
//if($mode == 'multi_nct_album') {
//	include("multi_nct_album.php");
//}
if($mode == 'multi_nct_song_cat') {
	include("multi_nct_song_cat.php");
}
if($mode == 'multi_nctz') {
	include("multi_nctz.php");
}
if($mode == 'multi_nct') {
	include("multi_nct.php");
}
if($mode == 'multi_nhac_vui') {
	include("multi_nhac_vui.php");
}
if($mode == 'multi_yume') {
	include("multi_yume.php");
}
if($mode == 'multi_tuoigi') {
	include("multi_tuoigi.php");
}
?>
