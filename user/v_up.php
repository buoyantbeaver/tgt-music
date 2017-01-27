<div class="user_">
<h3><span><? echo $_SESSION["tgt_user_name"];?></span> / <span>Mp3</span> / Video của tôi</h3>
<?php
if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);

if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}

	// phan trang
	$sql_tt = "SELECT m_id  FROM tgt_nhac_data WHERE  m_poster = '".$_SESSION["tgt_user_id"]."' AND m_mempost = 1 AND m_type = 2 ORDER BY m_id DESC LIMIT ".LIMITSONG;
	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img  ","data"," m_poster = '".$_SESSION["tgt_user_id"]."' AND m_mempost = 1 AND m_type = 2 ORDER BY m_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"cpanel/video/upload/#page#","");

if($page <= 20) { ?>
<div class="title"><p class="right bold"><? echo count($arr_song);?> Video</p><br class="clr" /></div>
<?
for($i=0;$i<count($arr);$i++) {
$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$i][2]."'");
$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
$nguoi_gui		= get_user($arr[$i][3]);
$user_url 		= url_link('user',$arr[$i][3],'user');
$song_url 		= url_link($arr[$i][1],$arr[$i][0],'xem-video');
$download 		= 'down.php?id='.$arr[$i][0].'&key='.md5($arr[$i][0].'tgt_music');
?>
        <div class="top_video fav_song">
            <div class="x_2">
            <a title="Xem Video  <? echo un_htmlchars($arr[$i][1]); ?>" href="<? echo $song_url; ?>">
            <img class="img_album" src="<? echo check_img($arr[$i][3]); ?>" title="Xem Video <? echo $arr[$i][1]; ?>" /></a>
            </div>
            <div class="x_s1">
            <p class="song"><a title="<? echo un_htmlchars($arr[$i][1]); ?>" href="<? echo $song_url; ?>"><? echo un_htmlchars($arr[$i][1]); ?></a></p>
            <p class="singer">Trình bày: <a class="singer" title="Tìm kiếm bài hát của ca sĩ <? echo un_htmlchars($singer_name); ?>" href="<? echo $singer_url; ?>"><? echo $singer_name; ?></a></p>
            </div>
        <div class="clr"></div>
        </div>
<?	} ?>
        <div class="pages"><? echo $phantrang; ?></div>
        <? } if($page >= 20) { ?>
			<div class="error_yeu_thich"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
		<? } ?>
</div>