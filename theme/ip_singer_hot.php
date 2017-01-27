        	<div class="box w_1">
            	<h1>Việt Nam</h1>
                <div class="padding">
                    <ul>
                    <?
                    $hotSinger = $tgtdb->databasetgt("  singer_id, singer_name  ","singer"," singer_type = 1 AND singer_hot = 1 ORDER BY singer_name_ascii ASC LIMIT 20");
                    for($i=0;$i<count($hotSinger);$i++) {
                    ?>
                    <li><a title="Các bài hát của ca sỹ <? echo $hotSinger[$i][1];?>" href="tim-kiem/bai-hat.html?key=<? echo text_s($hotSinger[$i][1]);?>&ks=singer"><? echo $hotSinger[$i][1];?></a></li>
                    <? } ?>
                    </ul>
            	</div>
         	</div>

        	<div class="box w_1">
            	<h1>Âu Mỹ</h1>
                <div class="padding">
                    <ul>
						<?
                        $hotSinger = $tgtdb->databasetgt("  singer_id, singer_name  ","singer"," singer_type = 2 AND singer_hot = 1 ORDER BY singer_name_ascii ASC LIMIT 15");
                        for($i=0;$i<count($hotSinger);$i++) {
                        ?>
                        <li><a title="Các bài hát của ca sỹ <? echo $hotSinger[$i][1];?>" href="tim-kiem/bai-hat.html?key=<? echo text_s($hotSinger[$i][1]);?>&ks=singer"><? echo $hotSinger[$i][1];?></a></li>
                        <? } ?>
                    </ul>
            	</div>
         	</div>
        	<div class="box w_1">
            	<h1>Châu Á</h1>
                <div class="padding">
                    <ul>
						<?
                        $hotSinger = $tgtdb->databasetgt("  singer_id, singer_name  ","singer"," singer_type = 3 AND singer_hot = 1 ORDER BY singer_name_ascii ASC LIMIT 15");
                        for($i=0;$i<count($hotSinger);$i++) {
                        ?>
                        <li><a title="Các bài hát của ca sỹ <? echo $hotSinger[$i][1];?>" href="tim-kiem/bai-hat.html?key=<? echo text_s($hotSinger[$i][1]);?>&ks=singer"><? echo $hotSinger[$i][1];?></a></li>
                        <? } ?>
                    </ul>
            	</div>
         	</div>