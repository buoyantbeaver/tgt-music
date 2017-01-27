        	<div class="w_1">
					<div class="new_chude_bg" id="load_album">
						<div class="chude_ ">
                    <?php
                    $arr = $tgtdb->databasetgt(" * ","chude"," chude_id");
                    for($z=0;$z<count($arr);$z++) {
                    ?>


    <p class="images">
	<a title="<? echo $arr[$z][1];?>" href="<? echo $arr[$z][2];?>"><img src="<? echo $arr[$z][3];?>" alt="<? echo $arr[$z][1];?>" /></a></p>
    <h2><a title="<? echo $arr[$z][1];?>" href="<? echo $arr[$z][2];?>"><? echo $arr[$z][1];?></a></h2>

                    <? } ?>
                    </ul>
       
            </div>                </div>
            </div>