<div class="main_bg">
                	<div class="tab">
                        <div class="title">
<div class="left"><span>Album HOT</span></div>
<div class="right">

							
                    <?
                    $hotA = $tgtdb->databasetgt("album_id, album_name, album_singer, album_img","album"," album_type = 0 AND album_hot = 1 ORDER BY album_id DESC LIMIT 9");
                    for($i=0;$i<count($hotA);$i++) {
						$album_nameA	=	$hotA[$i][1];
						$album_singerA	=	get_data("singer","singer_name"," singer_id = '".$hotA[$i][2]."'");
						$album_imgA		=	$hotA[$i][3];
						$album_urlA		= url_link($album_nameA.'-'.$album_singerA,$hotA[$i][0],'nghe-album');
						
if(($i+1)%3==0)   
$class    =       'margin-right: 0 !important;'; 
else 
$class= '';

?>


<div style="display: block; width: 165px; height: 165px; position: relative; float: left; margin: 0 7px 5px 0; z-index: 5; <? echo $class; ?>;">
<a title="<?=$album_nameA?> - <?=$album_singerA;?>" href="<?=$album_urlA;?>" class="_trackLink" tracking="_frombox=hotalbum"><img src="<?=$album_imgA;?>" width="165" height="165" alt="<?=$album_nameA?> - <?=$album_singerA;?>" /></a>

<div style="position: absolute; bottom: 0; width: 145px; height: 30px; padding: 6px 10px 10px; background-color: black; left: 0; opacity: 0.75;">
<h3 style="font-size: 100%; font-weight: normal; margin-bottom: 5px;"><a title="<?=$album_nameA?> - <?=$album_singerA;?>" href="<?=$album_urlA;?>" class="_trackLink" style="color: white; font-size: 12px; font-weight: bold;" tracking="_frombox=hotalbum"><? if(strlen($album_nameA) > 20) { ?><?=substr($album_nameA, 0, 20)?>...<? } else { ?><?=$album_nameA?><? } ?></a></h3>
<span><a style="color: #D2D1CF; font-size: 11px !important;"href="tim-kiem/bai-hat.html?key=<?=$album_singerA;?>&amp;ks=singer" title="Tìm bài hát của <?=$album_singerA;?>"><? if(strlen($album_singerA) > 25) { ?><?=substr($album_singerA, 0, 25)?>...<? } else { ?><?=$album_singerA?><? } ?></a></span>
</div>
</div>

					<? } ?>
</div>
                            <div class="clr"></div>
                        </div>
                    </div>
                </div>