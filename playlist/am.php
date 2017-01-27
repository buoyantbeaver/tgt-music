<?php
	// phan trang
	$sql_tt = "SELECT album_id  FROM tgt_nhac_album LEFT JOIN tgt_nhac_singer ON (tgt_nhac_album.album_singer = tgt_nhac_singer.singer_id) WHERE tgt_nhac_singer.singer_type = '2' AND album_type = '0' ORDER BY album_id DESC LIMIT ".LIMITSONG;

	$rStar = HOME_PER_PAGE * ($page -1 );
	$arr_album = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_viewed, album_img, album_type, album_cat, album_poster, album_time, album_song ","album  LEFT JOIN tgt_nhac_singer ON (tgt_nhac_album.album_singer = tgt_nhac_singer.singer_id)"," tgt_nhac_singer.singer_type = '2' AND album_type = '0'  ORDER BY album_id DESC LIMIT ".$rStar .",". HOME_PER_PAGE,"");
	$cat_name = get_data("theloai","cat_name"," cat_id = '".$id."'");
	$phantrang = linkPage($sql_tt,HOME_PER_PAGE,$page,"Album/Viet-Nam/#page#","");
?>
                <!-- begin song -->
        	<div class="box w_2">
            	<h1>Danh Sách Album Âu Mỹ</h1>
                <div class="padding">
					<div>
<? 
if (count($arr_album)<1) echo 'Phần này chưa có dữ liệu !';
if($page <= 20) { 
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
                                    <tr><td colspan="2" class="album_title"><h4><span class="singer_"><a title="Nghe Album <? echo $arr_album[$i][1]; ?>" href="<? echo $album_url; ?>"><? echo un_htmlchars($arr_album[$i][1]);?></a></span> - <span class="singer_"><a href="<? echo $singer_url;?>" title="Bài hát của ca sĩ <? echo un_htmlchars($singer_name);?>"><? echo un_htmlchars($singer_name);?></a></span></h4></td></tr>
                                    <tr><td width="100">Lượt nghe: </td><td><? echo number_format($arr_album[$i][3]);?></td></tr>
                                    <tr><td>Số bài hát: </td><td><? echo SoBaiHat($arr_album[$i][9]);?></td></tr>
                                    <tr><td>Ngày upload: </td><td><? echo check_data($arr_album[$i][8]);?></td></tr>
                                    <tr><td>Thể loại: </td><td><? echo GetTheLoai($arr_album[$i][6],'album');?></td></tr>
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
                </div>
            </div>
                <!-- end song -->