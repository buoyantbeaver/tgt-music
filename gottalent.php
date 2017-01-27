<?php
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/class.inputfilter.php");
include("./tgt/cache.php");
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id_media = $myFilter->process($_GET['id']);
$id_media	=	del_id($id_media);
mysql_query("UPDATE tgt_nhac_news SET news_viewed = news_viewed+1 WHERE news_id = '".$id_media."'");
$news = $tgtdb->databasetgt("news_id, news_title, news_cat, news_img, news_info, news_viewed, news_poster","news"," news_id = '".$id_media."' ORDER BY news_id DESC ");
$news_title	=	$news[0][1];
$news_info      =       $news[0][2];
$news_info_ngan      =       $news[0][4];
$luotnghe = get_data("news","news_viewed"," news_id = '".$news[0][2]."'");
$cat = get_data("catnews","cat_name"," cat_id = '".$news[0][2]."'");
$news_url = check_url_news($news_title.'-'.$title,$news[0][0],'news');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title><? echo $news[0][1] ?></title>
<meta name="title" content="<? echo $news[0][1] ?> - <? echo $website; ?>" />
<meta name="keywords" content="<? echo $news[0][1];?>, <? echo WEB_NAME; ?>" />
<meta name="description" content="<? echo $news[0][1] ?> - <? echo $website; ?>" />
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
            <div style="padding:10px;">
    <h1><? echo $news_title; ?></h1>
<b> <? echo $news_info_ngan; ?></b><br><br>
<? echo htmlspecialchars_decode($news_info); ?>
</div></div>

		<!-- begin binh luan -->
		
                	<div class="box w2">
            	<h1>Bình luận tin tức này<br class="clr"></h1>
<div class="fb-comments" data-href="<? echo $news_url; ?>" data-numposts="5" data-width="635" data-colorscheme="light">

</div>

<!-- end binh luan -->
    </div></div>
	
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
		$HTML_BOX	.= "<div class=\"top_video\" style=\"$class\">
<a href=\"$news_url\" class=\"zing-video-img _trackLink\" title=\"$news_title\" tracking=\"_frombox=home_chart_video_vietnam\"><img src=\"$news_img\" alt=\"$news_title\" width=\"112px\" height=\"63px\"></a>
							<h3 class=\"song\" style=\"font-size: 12px;\"><a href=\"$news_url\" title=\"$news_name\">$news_title</a></h3>
						<div class=\"clr\"></div>
						</div>";
			
	}
	
?>
<? echo $HTML_BOX;?>


</div>  

</div>    
 
</div>  

<div class="clr"></div>    

       <? include("./theme/ip_footer.php");?>
</div>

</body>
</html>