<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
if (!defined('TGT-MUSIC')) die("Mọi chi tiết về code liên hệ yahoo: ichphien_pro !");

function cam_nhan($media_id,$page,$type){
    global $link_music,$tgtdb; 
	$num=10;
	$num = intval($num);
	$page = intval($page);
	if (!$page) $page = 1;
	$limit = ($page-1)*$num;
	if($limit<0) $limit=0;
	$arr = $tgtdb->databasetgt(" * ","comment"," comment_media_id = '".$media_id."' AND comment_type = '".$type."' ORDER BY comment_time DESC LIMIT ".$limit.",$num");
	$sql = "SELECT comment_id FROM tgt_nhac_comment WHERE comment_media_id = '".$media_id."' AND comment_type = '".$type."' ORDER BY  comment_time DESC";
	$result = mysql_query($sql,$link_music);
	$total = mysql_num_rows($result);
	$phan_trang = pages_ajax('cam_nhan',$total,$num,$page,$media_id,$type);
	$poster_id 	= $_SESSION["tgt_user_id"];
?>	
<div id="comment_field">
<form method="post" onSubmit="return false;" name='add'>
<input value="<? echo $media_id;?>" type="hidden" id="media_id">
<input value="<? echo $poster_id;?>" type="hidden" id="comment_poster">
<input value="<? echo $type;?>" type="hidden" id="comment_type">
<input value="<? echo $num;?>" type="hidden" id="num">
<div id="comment_loading"></div>
<div class="send_cm1"><textarea id="comment_content" name="comment_content"></textarea></div>
<div class="send_cm009"><span style="float: left; padding-top: 3px;">Chỉ chấp nhận bình luận bằng tiếng Việt có dấu, những bình luận sai qui định sẽ bị xóa. </span><input type="submit" class="_add_" value="Bình luận" onClick="return comment_check_values();"></div>
<?	
if ($total) {
		for($i=0;$i<count($arr);$i++) {
				$avatarcm	=	get_data("user","avatar","userid = '".$arr[$i][2]."'");
?>
<div class="cam_nhan_list">
<div class="cm00008"><img src="<?=check_avt($avatarcm);?>" /></div>
<div class="cm00009">
<p class="user_"><a href="#"><?=get_user($arr[$i][2]);?></a><span>vào lúc <?=GetTIMEDATE($arr[$i][4]);?></span></p>
<p><?=ucBr(text_tidy($arr[$i][3]));?></p>
</div>
<div class="clr"></div>
</div>
<? }	
}
?>
<div class="pages"><? echo $phan_trang;?></div>
</div>
</form>


<? } 
function bang_xep_hang($type) {
	global $tgtdb;
	if($type == 'bxh_vn') {
	$where 	= "find_in_set(".IDCATVN.",m_cat)";
	}
	elseif($type == 'bxh_am') {
	$where 	= "find_in_set(".IDCATAM.",m_cat)";
	}
	elseif($type == 'bxh_hq') {
	$where 	= "find_in_set(".IDCATHQ.",m_cat)";
	}
				$arr_vn = $tgtdb->databasetgt(" m_id, m_title, m_singer ","data",$where." AND m_type = 1 ORDER BY  m_viewed_month DESC LIMIT 0,1");	
				$singer_vn = get_data("singer","singer_name"," singer_id = '".$arr_vn[0][2]."'");
				$song_vn = url_link($arr_vn[0][1],$arr_vn[0][0],'nghe-bai-hat');
				$singer_url_vn = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn).'&ks=singer';
				$singer_img_vn = get_data("singer","singer_img"," singer_id = '".$arr_vn[0][2]."'");
				?>
                	
					<div class="bxh_top"><img src="<? echo check_img($singer_img_vn);?>" width="313" height="140" /></div>
                    <div class="bxh_top_bg">
                    <h3><a title="<? echo $arr_vn[0][1];?>" href="<? echo $song_vn;?>">1. <? echo rut_ngan($arr_vn[0][1],3);?></a></h3>
                    <h4><a title="<? echo $singer_vn;?>" href="<? echo $singer_url_vn;?>"><? echo rut_ngan($singer_vn,3);?></a></h4>
                    </div>
                    <div class="bxh_list">
                <?
				$arr_vn_ = $tgtdb->databasetgt(" m_id, m_title, m_singer ","data",$where."  AND m_type = 1 ORDER BY  m_viewed_month DESC LIMIT 1,9");	
				for($i=0;$i<count($arr_vn_);$i++) {
				$singer_vn_ = get_data("singer","singer_name"," singer_id = '".$arr_vn_[$i][2]."'");
				$song_vn_ = url_link($arr_vn_[$i][1],$arr_vn_[$i][0],'nghe-bai-hat');
				$singer_url_vn_ = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn_).'&ks=singer';
				$singer_img_vn_ = get_data("singer","singer_img"," singer_id = '".$arr_vn_[$i][2]."'");
				$number	=	$i+2;
				if($i==8)	$class[$i]	=	'fjx';
                ?>

                        <div class="list <?=$class[$i];?>">
                            <div class="left number"><? echo $number;?>.</div>
                            <div class="left images"><img src="<? echo check_img($singer_img_vn_);?>" class="img"  /></div>
                            <div class="left info">
                                <h3><a title="Nghe bài hát <? echo $arr_vn_[$i][1];?>" href="<? echo $song_vn_;?>"><? echo rut_ngan($arr_vn_[$i][1],4);?></a></h3>
                                <h4><a title="<? echo $singer_vn_;?>" href="<? echo $singer_url_vn_;?>"><? echo rut_ngan($singer_vn_,4);?></a></h4>
                            </div>
                            <br class="clr" />
                        </div>
                 <? } ?>
                    </div>
                    <?
}
function bxh_video($type) {
	global $tgtdb;
	if($type == 'bxh_vn') {
	$where 	= "m_cat LIKE '%,".IDCATVN.",%'";
	}
	elseif($type == 'bxh_am') {
	$where 	= "m_cat LIKE '%,".IDCATAM.",%'";
	}
	elseif($type == 'bxh_hq') {
	$where 	= "m_cat LIKE '%,".IDCATHQ.",%'";
	}
				$arr_vn = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img ","data",$where." AND m_type = 2 ORDER BY  m_viewed_month DESC LIMIT 0,1");	
				$singer_vn = get_data("singer","singer_name"," singer_id = '".$arr_vn[0][2]."'");
				$song_vn = url_link($arr_vn[0][1],$arr_vn[0][0],'xem-video');
				$singer_url_vn = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn).'&ks=singer';
				?>
                	
					<div class="bxh_top"><img src="<? echo check_img($arr_vn[0][3]);?>" width="313" height="140" /></div>
                    <div class="bxh_top_bg">
                    <h3><a title="Xem video <? echo $arr_vn[0][1];?>" href="<? echo $song_vn;?>">1. <? echo rut_ngan($arr_vn[0][1],3);?></a></h3>
                    <h4><a title="<? echo $singer_vn;?>" href="<? echo $singer_url_vn;?>"><? echo rut_ngan($singer_vn,3);?></a></h4>
                    </div>
                    <div class="bxh_list">
                <?
				$arr_vn_ = $tgtdb->databasetgt(" m_id, m_title, m_singer, m_img ","data",$where."  AND m_type = 2 ORDER BY  m_viewed_month DESC LIMIT 1,9");	
				for($i=0;$i<count($arr_vn_);$i++) {
				$singer_vn_ = get_data("singer","singer_name"," singer_id = '".$arr_vn_[$i][2]."'");
				$song_vn_ = url_link($arr_vn_[$i][1],$arr_vn_[$i][0],'xem-video');
				$singer_url_vn_ = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn_).'&ks=singer';
				$number	=	$i+2;
				if($i==8)	$class[$i]	=	'fjx';
                ?>

                        <div class="list <?=$class[$i];?>">
                            <div class="left number"><? echo $number;?>.</div>
                            <div class="left images"><img src="<? echo check_img($arr_vn_[$i][3]);?>" class="img"  /></div>
                            <div class="left info">
                                <h3><a title="Xem video <? echo $arr_vn_[$i][1];?>" href="<? echo $song_vn_;?>"><? echo rut_ngan($arr_vn_[$i][1],4);?></a></h3>
                                <h4><a title="<? echo $singer_vn_;?>" href="<? echo $singer_url_vn_;?>"><? echo rut_ngan($singer_vn_,4);?></a></h4>
                            </div>
                            <br class="clr" />
                        </div>
                 <? } ?>
                    </div>
                    <?
}
function bxh_album($type) {
	global $tgtdb;
	if($type == 'bxh_vn') {
	$where 	= "album_cat LIKE '%,".IDCATVN.",%'";
	}
	elseif($type == 'bxh_am') {
	$where 	= "album_cat LIKE '%,".IDCATAM.",%'";
	}
	elseif($type == 'bxh_hq') {
	$where 	= "album_cat LIKE '%,".IDCATHQ.",%'";
	}
				$arr_vn = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat ","album",$where." AND album_type = 0 ORDER BY  album_viewed_month DESC LIMIT 0,1");	
				$singer_vn = get_data("singer","singer_name"," singer_id = '".$arr_vn[0][2]."'");
				$song_vn = url_link($arr_vn[0][1],$arr_vn[0][0],'nghe-album');
				$singer_url_vn = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn).'&ks=singer';
				?>
                	
					<div class="bxh_top"><img src="<? echo check_img($arr_vn[0][3]);?>" width="313" height="140" /></div>
                    <div class="bxh_top_bg">
                    <h3><a title="Nghe Album <? echo $arr_vn[0][1];?>" href="<? echo $song_vn;?>">1. <? echo rut_ngan($arr_vn[0][1],3);?></a></h3>
                    <h4><a title="<? echo $singer_vn;?>" href="<? echo $singer_url_vn;?>"><? echo rut_ngan($singer_vn,3);?></a></h4>
                    </div>
                    <div class="bxh_list">
                <?
				$arr_vn_ = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat ","album",$where."  AND album_type = 0 ORDER BY  album_viewed_month DESC LIMIT 1,9");	
				for($i=0;$i<count($arr_vn_);$i++) {
				$singer_vn_ = get_data("singer","singer_name"," singer_id = '".$arr_vn_[$i][2]."'");
				$song_vn_ = url_link($arr_vn_[$i][1],$arr_vn_[$i][0],'nghe-album');
				$singer_url_vn_ = 'tim-kiem/bai-hat.html?key='.text_s($singer_vn_).'&ks=singer';
				$singer_img_vn_ = get_data("singer","singer_img"," singer_id = '".$arr_vn_[$i][2]."'");
				$number	=	$i+2;
				if($i==8)	$class[$i]	=	'fjx';
                ?>

                        <div class="list <?=$class[$i];?>">
                            <div class="left number"><? echo $number;?>.</div>
                            <div class="left images"><img src="<? echo check_img($arr_vn_[$i][3]);?>" class="img"  /></div>
                            <div class="left info">
                                <h3><a title="Nghe Album <? echo $arr_vn_[$i][1];?>" href="<? echo $song_vn_;?>"><? echo rut_ngan($arr_vn_[$i][1],4);?></a></h3>
                                <h4><a title="<? echo $singer_vn_;?>" href="<? echo $singer_url_vn_;?>"><? echo rut_ngan($singer_vn_,4);?></a></h4>
                            </div>
                            <br class="clr" />
                        </div>
                 <? } ?>
                    </div>
                    <?
}

?>