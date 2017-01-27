        	<div class="box w_3">
            	<h1>Chủ Đề HOT<br class="clr"></h1>
                <div class="padding">
                    <ul>
                    <?php
                    $arr = $tgtdb->databasetgt(" * ","chude"," chude_id");
                    for($z=0;$z<count($arr);$z++) {
                    ?>
                    	<li><a href="<? echo $arr[$z][2];?>" title="Xem chủ đề <? echo $arr[$z][1];?>"><? echo $arr[$z][1];?></a></li>
                    <? } ?>
                    </ul>
                </div>
            </div>