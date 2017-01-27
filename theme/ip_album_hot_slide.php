		            <div class="box w_4">
                <div>
 <div id="slider">
                        <ul>
                    <?
$hotA = $tgtdb->databasetgt("album_id, album_name, album_singer, album_img","album"," album_type = 0 AND album_hot = 1 ORDER BY rand() LIMIT 5");
                    for($i=0;$i<count($hotA);$i++) {
						$album_nameA	=	$hotA[$i][1];
						$album_singerA	=	get_data("singer","singer_name"," singer_id = '".$hotA[$i][2]."'");
						$album_imgA		=	$hotA[$i][3];
						$album_urlA		= url_link($album_nameA.'-'.$album_singerA,$hotA[$i][0],'nghe-album');
						?>
                            <li><a href="<?=$album_urlA;?>" title="<?=$album_nameA?> - <?=$album_singerA;?>"><img src="<?=$album_imgA;?>" alt="<?=$album_nameA?> - <?=$album_singerA;?>" /></a></li>
					<? } ?>
                        </ul>
                    </div>
                </div>
                <ul id="pagination" class="pagination">
                <? 
				for($i=0;$i<count($hotA);$i++) { 
						$album_nameA	=	rut_ngan($hotA[$i][1],5);
						$album_singerA	=	rut_ngan(get_data("singer","singer_name"," singer_id = '".$hotA[$i][2]."'"),3);
				?>
                    <li onclick="slideshow.pos(<?=$i;?>)"><p class="sl_name"><?=$album_nameA;?></p><p class="sl_singer"><?=$album_singerA;?></p></li>
				<? } ?>
                </ul>
            </div>
<script type="text/javascript">var slideshow=new TINY.slider.slide('slideshow',{id:'slider',auto:3,resume:true,vertical:false,navid:'pagination',activeclass:'current',position:0});</script>