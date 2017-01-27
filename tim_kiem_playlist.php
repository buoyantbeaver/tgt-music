<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["key"])) $key = $myFilter->process($_GET['key']);
if(isset($_GET["type"])) $type = $myFilter->process($_GET['type']);
if(isset($_GET["ks"])) $ks = $myFilter->process($_GET['ks']);
if(isset($_GET["fx"])) $fx = $myFilter->process($_GET['fx']);
if(isset($_GET["ft"])) $ft = $myFilter->process($_GET['ft']);

if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);
$ky	 = $key;
$_SESSION['text_seach'] = $key;
$key_text	= str_replace (' ', '+', $key );
$key 		= replace($key);
$key		= str_replace ('-', ' ', $key );
$key		= htmlchars($key);


if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}


	$arr_singer = $tgtdb->databasetgt(" singer_id ","singer"," singer_name_ascii LIKE '%".$key."%'");
	for($s=0;$s<count($arr_singer);$s++) {
		$list_singer .= $arr_singer[$s][0].',';
		$singer_list = substr($list_singer,0,-1);
	}
	if($ks == 'title') {
			$sql_where = " album_name_ascii LIKE '%".$key."%' ";
			$link_s = 'tim-kiem/playlist.html?key='.$key_text.'&ks=title';
	}
	elseif($ks == 'singer') {
			$sql_where = " album_singer IN (".$singer_list.") ";
			$link_s = 'tim-kiem/playlist.html?key='.$key_text.'&ks=singer';
	}
	else {
		if($singer_list != "") 
			$sql_where = " album_name_ascii LIKE '%".$key."%' OR album_singer IN (".$singer_list.") ";
		else
			$sql_where = " album_name_ascii LIKE '%".$key."%' ";
			$link_s = 'tim-kiem/playlist.html?key='.$key_text;
	}
	if($ft == 'play') $sql_order = " ORDER BY album_viewed ";
	elseif($ft == 'time') $sql_order = " ORDER BY album_time ";
	else $sql_order = " ORDER BY album_id ";

	// phan trang
	
	$sql_tt = "SELECT album_id  FROM tgt_nhac_album WHERE $sql_where $sql_order DESC LIMIT ".LIMITSONG;
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,$link_s."&p=#page#","");
	$result = mysql_query($sql_tt);
	$totalRecord = mysql_num_rows($result);
	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_album = $tgtdb->databasetgt("album_id, album_name, album_singer, album_viewed, album_img, album_type, album_cat, album_poster, album_time, album_song","album"," $sql_where $sql_order DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	
	//if (count($arr_album)<1) header("Location: ".SITE_LINK."tim-kiem/404.html");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title><? echo $ky;?> | playlist <? echo $ky;?> | playlist <? echo $ky;?> | Trang <? echo $page;?></title>
<meta name="title" content="tìm kiếm playlist <? echo $ky;?> mọi lúc mọi nơi" />
<meta name="keywords" content="<? echo $ky;?>, playlist <? echo $ky;?>, clip <? echo $ky;?>, tìm kiếm, nhạc số, mp3, download nhạc" />
<meta name="description" content="<? echo $ky;?>, playlist <? echo $ky;?>, clip <? echo $ky;?>, tìm kiếm, nhạc số, mp3, download nhạc" />
<link rel="image_src" href="http://nhac.topgiaitri.com/images/tgt_mp3.jpg" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_search','1006');?></div>
    <div id="contents"  class="contents_bg box">
		<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
                <td width="120" valign="top">
                <ul class="searchmenu singer_">
					<li class="bottom"><a href="tim-kiem/bai-hat.html?key=<? echo $key_text;?>">Bài hát</a></li>
        			<li class="bottom"><a href="tim-kiem/video.html?key=<? echo $key_text;?>">Video</a></li>
                    <li class="bt_s09"><a href="tim-kiem/playlist.html?key=<? echo $key_text;?>">Playlist</a></li>
				</ul>
        		<ul class="searchmenu singer_">
                	<li class="isearch">Tìm theo</li>
                    <li class="bottom"><a href="tim-kiem/playlist.html?key=<? echo $key_text;?>">Tất cả</a></li>
					<li class="bottom"><a href="tim-kiem/playlist.html?key=<? echo $key_text;?>&ks=title">Tên playlist</a></li>
        			<li class="bottom"><a href="tim-kiem/playlist.html?key=<? echo $key_text;?>&ks=singer">Ca sĩ</a></li>
				</ul>
        		<ul class="searchmenu singer_">
					<li class="isearch">Lọc theo</li>
					<li class="bottom"><a href="tim-kiem/playlist.html?key=<? echo $key_text;?>">Tất cả</a></li>
					<li class="bottom"><a name="_seaBonFil" href="<? echo $link_s;?>&fx=hit">Hit</a></li>
				</ul>
        		<ul class="searchmenu singer_">
					<li class="isearch">Xếp theo</li>
					<li class="bottom"><a name="_seaBonFil" href="<? echo $link_s;?>">Mặc định</a></li>
					<li class="bottom"><a name="_seaBonFil" href="<? echo $link_s;?>&ft=play">Lượt nghe</a></li>
                    <li class="bottom"><a name="_seaBonFil" href="<? echo $link_s;?>&ft=time">Thời gian</a></li>
				</ul>
                </td>
                <td width="580" style="padding:0px 5px; border-left: 1px solid #cfcfcf;" valign="top">
        <div class="border_h2">
        <div class="list_album_s090">
       <div class="title_u">kết quả tìm được <strong><? echo $totalRecord; ?> playlist </strong>với từ khóa <strong>"<? echo $ky; ?>"</strong></div>

<? if($page <= 20) {
for($i=0;$i<count($arr_album);$i++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_album[$i][2]."'");
	$user_name = get_user($arr_album[$i][7]);
	$album_url = url_link($arr_album[$i][1],$arr_album[$i][0],'nghe-album');
	$user_url = url_link('user',$arr_album[$i][7],'user');
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
?>
                    <div class="album_list border_bottom">
                    <table width="100%" border="0" cellpadding="2" cellspacing="2">
                        <tr>
                            <td width="135" valign="top"><div class="img_"><a title="Nghe Album <? echo $arr_album[$i][1]; ?>" href="<? echo $album_url; ?>"><img class="img" src="<? echo check_img($arr_album[$i][4]);?>" /></a></div></td>
                            <td valign="top" align="left" class="fjx_padding">
                                <table width="100%"  border="0" cellpadding="2" cellspacing="2">
                                    <tr><td colspan="2" class="album_title"><h4><span class="singer_"><a title="Nghe Album <? echo $arr_album[$i][1]; ?>" href="<? echo $album_url; ?>"><? echo un_htmlchars($arr_album[$i][1]);?></a></span>- <span class="singer_"><a href="<? echo $singer_url;?>" title="Bài hát của ca sĩ <? echo un_htmlchars($singer_name);?>"><? echo un_htmlchars($singer_name);?></a></span></h4></td></tr>
                                    <tr><td width="100">Lượt nghe: </td><td><? echo number_format($arr_album[$i][3]);?></td></tr>
                                    <tr><td>Số bài hát: </td><td><? echo SoBaiHat($arr_album[$i][9]);?></td></tr>
                                    <tr><td>Ngày upload: </td><td><? echo check_data($arr_album[$i][8]);?></td></tr>
                                    <tr><td>Thể loại: </td><td><? echo GetTheLoai($arr_album[0][6],'album');?></td></tr>
                                    <tr><td colspan="2" id="Load_Album_<? echo $arr_album[$i][0];?>"><a class="Alike" onclick="AddFAV(<? echo $arr_album[$i][0];?>,2);">Yêu Thích</a></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    </div>
<?	} ?>
        <div class="pages"><? echo $phantrang; ?></div>
        <? } if($page >= 20) { ?>
			<div class="error_yeu_thich"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
		<? } ?>
        </div>
                </td>
                <td width="300" valign="top">
                <div class="box">
                    	<h1>Mẹo tìm kiếm</h1>
                        <div style="padding: 10px;">
		<p>Nếu chỉ nhớ một đoạn trong lời bài hát, hãy nhập:<br /> <strong><span class="f14" style="color:#18538C !important">Lyrics:</span></strong> <span class="f14">Lời Bài Hát</span> để tìm kiếm.</p>

		<p>Nếu muốn tìm kiếm bài hát của ca sĩ hoặc nhạc sĩ nào đó. Chỉ cần nhập <span class="f14">Tên Ca Sĩ</span> hoặc <span class="f14">Tên Nhạc Sĩ</span> để tìm kiếm.</p>
		<p>Nếu muốn tìm bài hát do 2 ca sĩ cùng thể hiện, hãy nhập:<br /> <span class="f14">Tên Ca Sĩ 1</span> <span class="f14" style="color:#18538C !important" ><strong>ft.</strong></span> <span class="f14">Tên Ca sĩ 2</span> để tìm kiếm.</p>
                        </div>
                </div>
                <?=BANNER('tim_kiem','300');?>
                </td>
            </tr>
        </table> 
     </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>