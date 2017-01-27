<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../temp/js/jquery.js"></script>
<script type="text/javascript" src="../styles/admin.js"></script>
<style>
.left { float: left;}.right { float: right; }.clr { clear: both;}
</style>
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
function onover(obj,cls){obj.className=cls;}
function onout(obj,cls){obj.className=cls;}
function ondown(obj,url,cls){obj.className=cls; window.location=url;}
//-->
</script>
<body topmargin="0" leftmargin="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="style_border" width="7" >&nbsp;</td>
    <td valign="top" class="style"><table width="100%" height="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td valign="top" class="style_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="title_c">SỬA ALBUM</td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			</table>
				
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding: 20px;">
                <form action="<?=$action;?>" method="post" enctype="multipart/form-data">
	<table width=100% align=center cellpadding="2" cellspacing="2">
		<tr><td class=fr width=100px>Tên album *</td><td class=fr_2><input type=text name="name" size=50 value="<? echo $arrz[0][1];?>"></td></tr>
		<tr><td class=fr width=100px>Thể loại </td><td class=fr_2><?=acp_cat($arrz[0][8]);?></td></tr>
		<tr><td class=fr width=100px>Lượt nghe (Month)</td><td class=fr_2><input type=text name="s_nghe" size=20 value="<? echo $arrz[0][13];?>"></td></tr>
        <tr><td class=fr width=100px>Hình ảnh </td><td class=fr_2>
        	<p><input type="file" name="img" size=50></p>
        	<p><input type=text name="pimg" size=60 value="<? echo $arrz[0][4];?>"></p>
        </td></tr>
        <tr><td class=fr width=100px>Ảnh lớn </td><td class=fr_2><input type=text name="imgbig" size=60 value="<?=$arrz[0][14];?>"></td></tr>
		<tr><td class=fr width=100px>Trình bày </td><td class=fr_2><?=acp_singer($arrz[0][3]);?></td></tr>
        <tr><td class=fr width=100px>Nhập tên mới: </td><td class=fr_2><?=them_moi_singer_form();?></td></tr>
		<tr><td class=fr width=100px>Thông tin: </td><td class=fr_2>
						<?php
						$oFCKeditor = new FCKeditor('info') ;
						$oFCKeditor->ToolbarSet = 'Basic';
						$oFCKeditor->Height = '150' ; 
						$oFCKeditor->BasePath = '../fckeditor/' ;
						$oFCKeditor->Value = un_htmlchars($arrz[0][5]);
						$oFCKeditor->Create() ;
						?></td></tr>
        <tr><td class=fr width=100px valign="top">List Song: <br> <font color="#FF0000"><i>Dùng chuột kéo thả để sắp xếp lại thứ tự bài hát</i></font></td><td class=fr_2>
        <div id="list"><div id="response"></div>
<div id="playlist_field"><ul id="LoadSongAlbum">
<?
	$s = explode(',',$arrz[0][10]);
	foreach($s as $x=>$val)
      {
	$arr[$x] = $tgtdb->databasetgt(" m_id, m_title, m_singer ","data"," m_id = '".$s[$x]."'");
	$singer_name = get_data("singer","singer_name"," singer_id = '".$arr[$x][0][2]."'");
	$stt	=	$x+1;
?>
		<li id="arrayorder_<? echo $arr[$x][0][0];?>"><div class="left"><? echo $stt.". ".$arr[$x][0][1];?> - <? echo $singer_name;?></div><div class="right"><a onClick="xSongAlbum(<? echo $id;?>,<? echo $arr[$x][0][0];?>);" style="cursor: pointer;">X</a></div><div class="clr"></div></li>
<? } ?>
</ul></div></div></div>
<input type="hidden" id="id_album" value="<? echo $id;?>">
<script type="text/javascript" src="../../script/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../../script/jquery-ui-1.7.1.custom.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){ 	
function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
});
    
}, 500);}
	
    $("#response").hide();
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable("serialize") + '&update=update&id_album=<? echo $id;?>'; 
			$.post("update-album.php", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});
</script>
        </td></tr>
		<tr><td class="fr" align="center" colspan="2"><input class="sutm" type="submit" name="submit" value="Gửi Đi">  <input class="sutm" type="reset" value="Nhập Lại"></td></tr>
	</table>
</form>
                
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>