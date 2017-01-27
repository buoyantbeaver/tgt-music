<!--Playlist-->
		<div class="title-main"><img src="./nct/ico-list.gif" width="18" height="15" align="baseline"> Playlist </div>
		<?
$arr_album = $tgtdb->databasetgt(" album_id, album_name, album_singer, album_img, album_cat, album_viewed ","album");
				for($i=0;$i<count($arr_album);$i++) {
				$id_album  =  $arr_album[$i][0];
				$id_singer = $arr_album[$i][2];
				$album_name = htmlchars($arr_album[$i][1]);
				$singer_name = htmlchars(get_data("singer","singer_name"," singer_id = '".$id_singer."'"));
				$album_url = url_link_mobile($album_name,$id_album,'nghe-album');
				$singer_url = 'tim-kiem/bai-hat.html?key='.text_s($singer_name).'&ks=singer';
				$album_img = check_img($arr_album[$i][3]);
				$viewed = number_format($arr_album[$i][5]);
				$stt	=	$i+1;
				?>
                    <div class="row ">
    <div class="img-40"><a href="<?=$album_url;?>"><img src="<? echo $album_img;?>" width="40" height="40" border="0"></a></div>
    <div class="txt-40">
        <h3><a href="<?=$album_url;?>"><?=$album_name?> - <?=$singer_name;?></a></h3>  
        <p><img src="./nct/ico-head.gif" width="11" height="11" border="0"> <? echo number_format($arr_album[$i][5]);?> &nbsp;&nbsp;&nbsp;<img src="./nct/ico-music.gif" width="11" height="11" border="0"> <? echo number_format($arr_album[$i][5]);?></p>
    </div>
</div>
				<? } ?>



			
    </div>
</div>
			<div class="more"><a href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html">Xem thêm <img src="./nct/ico-more.gif" width="10" height="10" border="0" align="absmiddle"></a></div> 
