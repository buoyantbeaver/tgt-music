<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["act"])) $act = $myFilter->process($_GET['act']);
$up = $tgtdb->databasetgt(" * ","cf"," cf_id = 1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Bảng Xếp Hạng Nhạc Việt Nam Tháng <? echo date('m');?></title>
<meta name="title" content="Bảng xếp hạng nhạc việt nam tháng <? echo date('m');?>" />
<meta name="keywords" content="Bảng xếp hạng nhạc việt nam tháng <? echo date('m');?>" />
<meta name="description" content="Bảng xếp hạng nhạc việt nam tháng <? echo date('m');?>" />
<? include("./theme/ip_java.php");?>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents"  class="contents_bg box">
		<table width="100%" cellpadding="0" cellspacing="0" class="bxh_tgt_v4_5">
        	<tr>
                <td width="120" valign="top">
					<? include("./theme/ip_bxh.php");?>
                </td>
                <td width="530" style="padding:0px 5px; border-left: 1px solid #cfcfcf;" valign="top">
 <div class="bxh_title m_vn_ _bottom"><span>BXH</span> Nhạc Việt Nam<a href="BXH/bai-hat/Viet-Nam.htm"><img class="right" src="temp/img/play.gif" border="0" /></a></div>
 <div class="bxh_title_s">Bảng Xếp Hạng Tuần <span><? echo $up[0][3];?></span></div> 
 <? if($act == 'play') {
 ?>
 <div class="_player">
			<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="84">
	<param name="movie" value="<? echo SITE_LINK; ?>tgt_file/player.swf" />
	<param name="quality" value="high" />
	<param name="wmode" value="transparent" />
	<param name="allowscriptaccess" value="always"/>

	<param name="allowfullscreen" value="true"/>
	<param name="flashvars" value="file=<? echo SITE_LINK; ?>xml/6/bxh-nhac-vn.xml&playlistsize=0&playlist=bottom&info=true&autostart=true&songid=<?=$st;?>&uservip=true&ads=">
	<embed id="player" wmode="transparent" allowscriptaccess="always" allowfullscreen="true" width="100%" height="84" src="<? echo SITE_LINK; ?>tgt_file/player.swf" flashvars="file=<? echo SITE_LINK; ?>xml/6/bxh-nhac-vn.xml&playlistsize=0&playlist=bottom&info=true&autostart=true&songid=<?=$st;?>&uservip=true&ads=" />
</object>
 </div>
 <? } ?>
 <div class="bxh_list _delline">
                <?
				$arr_vn_ = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_viewed ","data"," m_cat LIKE '%,".IDCATVN.",%' AND m_type = 1 ORDER BY m_viewed_month DESC LIMIT 10");
				
				for($i=0;$i<count($arr_vn_);$i++) {
					$list_song	.=	$arr_vn_[$i][0].',';
					$list_song_ = 	substr($list_song,0,-1);
				if(date("w") == 0 && $up[0][4] == '1') {
					mysql_query("UPDATE tgt_nhac_cf SET cf_value = '".$list_song_."', cf_date = '".date("d/m/Y")." - ".tinh_tuan(7)."', cf_up = '0' WHERE cf_id = '1'");
				}
				$viewed 	= number_format($arr_vn_[$i][3]);
				$singer_vn_ = get_data("singer","singer_name"," singer_id = '".$arr_vn_[$i][2]."'");
				$song_vn_ = url_link($arr_vn_[$i][1],$arr_vn_[$i][0],'nghe-bai-hat');
				$singer_url_vn_ = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn_).'&ks=singer';
				$singer_img_vn_ = get_data("singer","singer_img"," singer_id = '".$arr_vn_[$i][2]."'");
				$number	=	$i+1;
                ?>

                        <div class="list">
						
                            <div class="left number"><? echo $number;?>.</div>
							                            
														<p>
                            <div class="left images"><img src="<? echo check_img($singer_img_vn_);?>" class="img"  /></div>
                            <div class="left info">
                                <h3><a href="<? echo $song_vn_;?>"><? echo rut_ngan($arr_vn_[$i][1],4);?></a></h3>
                                <h4><a href="<? echo $singer_url_vn_;?>"><? echo rut_ngan($singer_vn_,4);?></a></h4>

						</div>
						<!--Luot Nghe-->
							<div class="right list_icon">
						<div class="left"><? echo $viewed; ?></div>
						
						  </div>
						
                            <br class="clr" />
                        </div>
                 <? } ?>
 </div>
                 </td>
                <td width="300" valign="top">
                    <div class="box w_3">
                    	<h1>Việt Nam</h1>
                        <div class="xxxxx">Tuần <? echo $up[0][5];?></div>
                        <div class="album">
<?
$arr_song = $tgtdb->databasetgt(" m_id, m_title, m_singer ","data"," m_id IN (".$up[0][2].") ORDER BY m_viewed_month DESC LIMIT 10");
for($z=0;$z<count($arr_song);$z++) {
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr_song[$z][2]."'");
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$song_url = url_link($arr_song[$z][1],$arr_song[$z][0],'nghe-bai-hat');

?>
        <div class="top_mp3">
        	<div class="x_1"><? echo $z+1;?></div>
            <div class="x_2">
            <p class="song"><a title="Nghe bài hát <?=$arr_song[$z][1]; ?>" href="<?=$song_url; ?>"><?=$arr_song[$z][1]; ?></a></p>
            <p class="singer"><a title="Tìm kiếm bài hát của ca sĩ <? echo $singer_name; ?>" href="<?=$singer_url; ?>"><?=rut_ngan($singer_name,5); ?></a></p>
            </div>
        <div class="clr"></div>
        
        </div>
<? } ?>
                        </div>
                    </div>
                </td>
            </tr>
        </table> 
     </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>