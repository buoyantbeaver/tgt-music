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
			$lyric		 	= htmlchars(stripslashes(trim(urldecode($_POST['lyric']))));
			$lyricLRCNCT		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricLRCNCT']))));
			$lyricLRC		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricLRC']))));
			$lyricSRT		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricSRT']))));
			$lyricKAR		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricKAR']))));
                        $lyricZSTAR		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricZSTAR']))));
			$lyricCaption		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricCaption']))));
			$image  	 = htmlchars(stripslashes(trim(urldecode($_POST['image']))));
			$user_id	 = $_SESSION['admin_id'];
			$type		 = $_POST['type'];
			if(move_uploaded_file ($_FILES['img']['tmp_name'],FOLDER_VIDEO."/".time()."-".$_FILES['img']['name'])) {
					$img = LINK_VIDEO."/".time()."-".$_FILES['img']['name'];
			}
			elseif($_POST['grab_img']) $img = grab_img($url);
			else $img = $_POST['img'];
			
			$action		 = "media.php?mode=add";
			mysql_query("INSERT INTO tgt_nhac_data (m_title,m_title_ascii,m_singer,m_cat,m_poster,m_sang_tac,m_lyric,m_lyricLRCNCT,m_lyricCaption,m_lyricSRT,m_lyricLRC,m_lyricKAR,m_lyricZSTAR,m_type,m_url,m_img,m_is_local,m_time) 
						 VALUES ('".$song."','".$song_ascii."','".$singer."','".$cat."','".$user_id."','".$sangtac."','".$lyric."','".$lyricLRCNCT."','".$lyricCaption."','".$lyricSRT."','".$lyricLRC."','".$lyricKAR."','".$lyricZSTAR."','".$type."','".$url."','".$image."','".$local."','".NOW."')");
			mss ("Thêm media mới thành công ","media.php?mode=add");
		}
	}
include("media_act.php"); }
if($mode == 'edit') {
		$id	= del_id($id);
		$arrz = $tgtdb->databasetgt(" m_id, m_title, m_singer,m_cat,m_url,m_img, m_is_local, m_lyric, m_type, m_sang_tac, m_lyricLRCNCT, m_lyricCaption, m_lyricSRT, m_lyricLRC, m_lyricKAR, m_lyricZSTAR ","data"," m_id = '$id'");
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
				$lyricLRCNCT		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricLRCNCT']))));
				$lyricLRC		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricLRC']))));
				$lyricSRT		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricSRT']))));
				$lyricKAR		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricKAR']))));
                                $lyricZSTAR		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricZSTAR']))));
				$lyricCaption		 = htmlchars(stripslashes(trim(urldecode($_POST['lyricCaption']))));
				$image  	 = htmlchars(stripslashes(trim(urldecode($_POST['image']))));
				$type		 = $_POST['type'];
				if(move_uploaded_file($_FILES['img']['tmp_name'],FOLDER_VIDEO."/".time()."-".$_FILES['img']['name'])) {
					delFile($arrz[0][5]);
					$img = LINK_VIDEO."/".time()."-".$_FILES['img']['name'];
				}
				elseif($_POST['grab_img']) $img = grab_img($url);
				else $img = $arrz[0][5];
				//ALTER TABLE `tgt_nhac_data` add m_lyricSRT varchar(255) default null
				mysql_query("UPDATE tgt_nhac_data SET
					m_title			=  	'".$song."',
					m_title_ascii 	= 	'".$song_ascii."',
					m_singer		= 	'".$singer."',
					m_sang_tac		= 	'".$sangtac."',
					m_cat			=	'".$cat."',
					m_url			=	'".$url."',
					m_img			=	'".$image."',
					m_is_local		=	'".$local."',
					m_type			=	'".$type."',
					m_lyric			=	'".$lyric."',
					m_lyricCaption	=	'".$lyricCaption."',
					m_lyricSRT		=	'".$lyricSRT."',
					m_lyricLRCNCT	=	'".$lyricLRCNCT."',
					m_lyricKAR		=	'".$lyricKAR."',
                                        m_lyricZSTAR   	=	'".$lyricZSTAR."',
					m_lyricLRC		=	'".$lyricLRC."'
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
if($mode == 'multi_nhac_vui') {
	include("multi_nhac_vui.php");
}
if($mode == 'multi_yume') {
	include("multi_yume.php");
}
if($mode == 'multi_you') {
	include("multi_you.php");
}
if($mode == 'multi_ns') {
	include("multi_ns.php");
}
if($mode == 'multi_you_playlist') {
	include("multi_you_playlist.php");
}
if($mode == 'multi_kenh74') {
	include("multi_kenh74.php");
	
}
if($mode == 'multi_nct') {
	include("multi_nct.php");
	
}
?>