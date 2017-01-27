<?php
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/class.inputfilter.php");
include("./tgt/cache.php");
$myFilter = new InputFilter();

// phan trang

if(isset($_GET["p"])) $page=$myFilter->process($_GET["p"]);

if($page > 0 && $page!= "")
	$start=($page-1) * HOME_PER_PAGE;
else{
	$page = 1;
	$start=0;
}

if($search) {
	$search 	=  get_ascii($search);
	$sql_where 	= "news_title_ascii LIKE '%".$search."%'";
	$link_pages = "list_news.php?search=".$search."&";
}

else {
	$sql_order = "news_id ORDER BY news_id DESC";
	$link_pages = "tin-tuc-";
}
	$sql_tt = "SELECT news_id  FROM tgt_nhac_news WHERE $sql_where $sql_order";
	$phan_trang = linkPage($sql_tt,HOME_PER_PAGE,$page,$link_pages."#page#","");
	$rStar = HOME_PER_PAGE * ($page -1 );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Blog - Trang <?=$page;?> | Nghe BXH online - Tải nhạc HAY</title>
<meta name="title" content="Tin tức mới | <? echo $website; ?>" />
<meta name="keywords" content="Tin tức mới | Tin âm nhạc, tin thế giới, tin hình sự, tin nóng trong ngày, Trang <?=$page;?> <? echo WEB_NAME; ?>" />
<meta name="description" content="Tin tức mới cập nhật, Tin âm nhạc Trang <?=$page;?> - <? echo $website; ?>" />
<link rel="canonical" href="<? echo SITE_LINK ?>tin-tuc.html"/>
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
<? include("./theme/ip_header.php");?>
    <div class="top_banner"><?=BANNER('top_banner_home','980','110');?></div>
    <div class="content">


	</div>
        <!--4-->
    <div id="contents">
    	<div id="m_4">
			<div class="box w_4">
            <h1>News</h1>
            <div style="padding:10px;">
    <? 
	if($page <= 20) { 
$arr = $tgtdb->databasetgt(" news_id, news_title, news_title_ascii, news_img, news_viewed, news_time, news_info  ","news"," $sql_where $sql_order LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	for($z=0;$z<count($arr);$z++) {
$news_title		= un_htmlchars($arr[$z][1]);
$news_img		= check_img($arr[$z][3]);
$news_viewed		= $arr[$z][4];
$news_time		= GetTIMEDATE($arr[$z][5]);
$news_info		= rut_ngan(htmlspecialchars_decode($arr[$z][6]),40);
$news_url = check_url_news($arr[$z][1],$arr[$z][0]);
$stt2			= $z+1;
if($stt2	< 3)	$classb[$z]	=	"fjx";
		$HTML_BOX_HOME	.= "<div class=\"top_video\">
	<div class=\"x_2\">
						<a href=\"$news_url\" class=\"img_\" title=\"$news_title\"><img src=\"$news_img\" alt=\"$news_title\" width=\"140px\" height=\"100px\" />
						
						</div>
						<div class=\"x_8\">
						<a href=\"$news_url\" title=\"$news_title\">$news_title</a>
							<p class=\"singer\">Lượt xem: $news_viewed</a></p>
							<p class=\"singer\"><i>$news_info</a></i></p>
						</div>
						<div class=\"clr\"></div>
						</div>";
	}
	
?>
<? echo $HTML_BOX_HOME;?>
 </div>
 
       </div>
	   <div class="pages"><? echo $phan_trang; ?></div>
						<? } if($page >= 20) { ?>
                            <div class="error_yeu_thich"><? echo NAMEWEB;?> chỉ hiển thị 20 trang kết quả. Để có nhiều kết quả hơn, vui lòng sử dụng chức năng tìm kiếm</div>	
                        <? } ?>
        <div class="clr"></div>
	
    </div>


    <div id="m_3">
        	<div class="box w2">
            	<h1>Tin tức khác<br class="clr"></h1>
                <div class="padding">
			<? 
$arr = $tgtdb->databasetgt("news_id, news_title, news_cat, news_img, news_info, news_viewed","news"," news_hot = '0' OR news_hot = '1' ORDER BY RAND() LIMIT 20");
for($z=0;$z<count($arr);$z++) {
$news_title		= un_htmlchars($arr[$z][1]);
$news_img		= check_img($arr[$z][3]);
$news_viewed		= $arr[$z][5];
$news_info		= rut_ngan($arr[$z][4],7);
$news_url = check_url_news($arr[$z][1],$arr[$z][0]);
$stt2			= $z+1;
if($stt2 == 20)	$class	=	'border: none; margin: none;';
		$HTML_BOX	.= "<div class=\"top_mp3\">

<a href=\"$news_url\" class=\"zing-video-img _trackLink\" title=\"$news_title\" tracking=\"_frombox=home_chart_video_vietnam\"><img src=\"$news_img\" alt=\"$news_title\" width=\"112px\" height=\"63px\"></a>
					<h6 class=\"song\" style=\"font-size: 12px;\"><a href=\"$news_url\" title=\"$news_name\">$news_title</a></h6>
						
						<div class=\"clr\"></div>
						</div>";
			
	}
	
?>
<? echo $HTML_BOX;?>
</div>
       </div></div>
        <div class="clr"></div>

       <? include("./theme/ip_footer.php");?>
</div>

</body>
</html>