<?php if (!defined('TGT-MUSIC')) die("Mọi chi tiết về website xin vui lòng liên hệ yahoo: minhthanh_qnv !"); ?>
<div class="box w_2">
            	<h1 id="tab_click_video">♪ Playlist </h1>
				<div class="padding">
<?php
$arr = $tgtdb->databasetgt(" album_id,album_name,album_singer,album_img ","album  LEFT JOIN tgt_nhac_singer ON (tgt_nhac_album.album_singer = tgt_nhac_singer.singer_id)"," tgt_nhac_singer.singer_type = '$singer_type' AND album_type = '$album_type' ORDER BY album_id DESC LIMIT 6");
for($z=0;$z<count($arr);$z++) {
	$singer_name 	= get_data("singer","singer_name"," singer_id = '".$arr[$z][2]."'");
	$singer_url 	= 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
	$album_name		= $arr[$z][1];
	$album_img		= $arr[$z][3];
	$album_url 		= url_link($arr[$z][1],$arr[$z][0],'nghe-album');
	if($z == 2 || $z == 5)	{
		$class[$z]	=	"fjx";
		$hang[$z]	=	"<div class=\"clr\"></div>";
	}
?>
<div class="new_album_bg" id="load_album">
						<div class="album_ ">
    <p class="images">
	<a title="$album_name - $singer_name" href="$album_url"><img src="$album_img" alt="$album_name - $singer_name" /></a></p>
    <h2><a title="$album_name - $singer_name" href="$album_url">$album_name</a></h2>
    <p><a href="tim-kiem/bai-hat.html?key=Nhiều+Ca+Sĩ&ks=singer" title="Tìm bài hát của Nhiều Ca Sĩ">Nhiều Ca Sĩ</a></p>
</div><div class="album_ ">
</div><div class="clr"></div><div class="read_"><a class="read-more" href="Album/Viet-Nam.html">Xem thêm</a></div>                    </div>
                </div>
            </div>



<? } ?>
                    </div>
                    </div>