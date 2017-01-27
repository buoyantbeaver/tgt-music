<?php
#####################################
#		IPOS V1.2 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com
#   modify: tuannvbg@gmail.com
#   Date: 2016-11-24
#   Function: tao file thong tin de Zing Star Flash Player play
#####################################
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); 
$id = del_id($id);
header("Content-Type: text/xml; charset=utf-8");

$arr = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local, m_lyricZSTAR, m_img, m_sang_tac ","data"," m_id = '".$id."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'"));
$lyricCaption = str_replace("'", " ", un_htmlchars($arr[0][5]));
$image = un_htmlchars($arr[0][6]);
$title 		= get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'");
$song_url 	= url_link($arr[0][2].'-'.$title,$id,'nghe-bai-hat-nct');
$singer_url = SITE_LINK.'tim-kiem/bai-hat.html?key='.text_s($title).'&ks=singer';
$song_writer = str_replace("'", " ", un_htmlchars($arr[0][7]));

$xml .= '<data>'.

		'<title>'.str_replace("'", " ", un_htmlchars($arr[0][2])).'</title>'.
		
		'<author>'.$song_writer.'</author>'.
		
		'<singer>'.str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'")).'</singer>'.
		
		'<type></type>'.
		
		'<lyric>'.$lyricCaption.'</lyric>'.
		
		'<karaokelink>'.grab(get_url($arr[0][4],$arr[0][1])).'</karaokelink>'.
		
		'<sourcelink></sourcelink>'.
		
		'<serverkalink>rtmp://red5.star.zing.vn/test</serverkalink>'.
		
		'<reviewkalink>http://red5.star.zing.vn:5080/test/streams/</reviewkalink>'.
		
		'<skin>'.SITE_LINK.'includes/skins/</skin>'.
		
		'<help>http://star.zing.vn/star/huong-dan-chinh/huong-dan-cai-dat-micro.html</help>'.
		
		'<save>http://star.zing.vn/star/mypage/myrecordadd.html</save>'.
		
		'<login>http://star.zing.vn/star/login/index.html</login>'.

		'</data>';

echo $xml;
exit();
?>