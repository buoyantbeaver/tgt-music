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
$up = $tgtdb->databasetgt(" * ","cf"," cf_id = 10");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>Bảng Xếp Hạng Album Hàn Quốc Tháng <? echo date('m');?></title>
<meta name="title" content="Bảng xếp hạng album hàn quốc tháng <? echo date('m');?>" />
<meta name="keywords" content="Bảng xếp hạng album hàn quốc tháng <? echo date('m');?>" />
<meta name="description" content="Bảng xếp hạng album hàn quốc tháng <? echo date('m');?>" />
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
 <div class="bxh_title a_ca_ _bottom"><span>BXH</span> Album Hàn Quốc</div>
 <div class="bxh_title_s">Bảng Xếp Hạng Tuần <span><? echo $up[0][3];?></span></div>
 <div class="bxh_list _delline">
<?
				$arr_vn_ = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat ","album"," album_cat LIKE '%,".IDCATHQ.",%' AND album_type = 0 ORDER BY album_viewed_month DESC LIMIT 40");				
				for($i=0;$i<count($arr_vn_);$i++) {
					$list_album	.=	$arr_vn_[$i][0].',';
					$list_album_ = 	substr($list_album,0,-1);
				if(date("w") == 0 && $up[0][4] == '1') {
					mysql_query("UPDATE tgt_nhac_cf SET cf_value = '".$list_album_."', cf_date = '".date("d/m/Y")." - ".tinh_tuan(7)."', cf_up = '0' WHERE cf_id = '8'");
				}
                $id_album = $arr_vn_[$i][0];
				$id_singer = $arr_vn_[$i][2];
				$album_name_vn_ = htmlchars($arr_vn_[$i][1]);
				$url_album_vn_ = url_link($album_name_vn_,$id_album,'nghe-album');
				$singer_name_vn_ = htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));				
				$singer_url_vn_ = 'tim-kiem/bai-hat.html?key='.text_s($singer_name_vn_).'&ks=singer';
				$img_album = check_img($arr_vn_[$i][3]);
				$stt	=	$i+1;
                ?>

                        <div class="list">
                            <div class="left number"><? echo $stt;?>.</div>
                            <div class="left images"><img src="<? echo $img_album;?>" class="img"  /></div>
                            <div class="left info">
                                <h3><a title="Nghe album <? echo $album_name_vn_;?>" href="<? echo $url_album_vn_;?>"><? echo rut_ngan($album_name_vn_,7);?></a></h3>
                                <h4><a title="<? echo $singer_name_vn_;?>" href="<? echo $singer_url_vn_;?>"><? echo $singer_name_vn_;?></a></h4>
                            </div>
                            <br class="clr" />
                        </div>
                 <? } ?>
 </div>
                 </td>
                <td width="300" valign="top">
                    <div class="box w_3">
                    	<h1>Hàn Quốc</h1>
                        <div class="xxxxx">Tuần <? echo $up[0][5];?></div>
                        <div class="album">
<?
$arr_album = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat, album_viewed ","album"," album_id IN (".$up[0][2].") ORDER BY album_viewed_month DESC LIMIT 10");
for($z=0;$z<count($arr_album);$z++) {
    $id_album = $arr_album[$z][0];
	$id_singer = $arr_album[$z][2];
	$album_name = htmlchars($arr_album[$z][1]);
	$album_url = url_link($album_name,$id_album,'nghe-album');
	$album_img = check_img($arr_album[$z][3]);
	$singer_name = htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));
	$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$stt = $z+1;
	$viewed = number_format($arr_album[$z][5]);
?>


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