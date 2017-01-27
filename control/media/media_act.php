<?php
include("../../tgt/lang.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<?include("../head.php");?>
<script type="text/javascript" src="../../temp/js/jquery.js"></script>
<script type="text/javascript" src="../styles/admin.js"></script>
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
function onover(obj,cls){obj.className=cls;}
function onout(obj,cls){obj.className=cls;}
function ondown(obj,url,cls){obj.className=cls; window.location=url;}
//-->
</script>
<body>

<div class="col-lg-12">
	<h1 class="page-header"><?echo addanewsong;?></h1>
</div>

<form action="<?=$action;?>" method="post" enctype="multipart/form-data" >
	<table width=100% align=center cellpadding="2" cellspacing="2" class="table table-hover">
		<tr><td class=fr width=10%><font color="red"><b>Tên Ca Khúc :</b></font> </td>
		<td class=fr_2><input type=text name="song" size=50 value="<? echo $arrz[0][1];?>" class="form-control findasong" required></td></tr>
		<tr><td class=fr width=10%><font color="red"><b>Trình bày: </b></font> </td>
		<td class=fr_2><?=acp_singer($arrz[0][2]);?></td></tr>
        <tr><td class=fr width=10%><font color="blue"><b>Nhập tên mới: </b></font></td>
		<td class=fr_2><?=them_moi_singer_form();?></td></tr>
        <tr><td class=fr width=10%><font color="blue"><b>Sáng tác: </b></font></td>
		<td class=fr_2><input type=text name="sangtac" size=30 value="<? echo $arrz[0][9];?>" class="form-control findasong"></td></tr>
		<tr><td class=fr width=10%><font color="red"><b>Thể loại:</b></font> </td>
		<td class=fr_2><?=acp_cat($arrz[0][3]);?></td></tr>
		<tr><td class=fr width=10%><font color="blue"><b>Lượt Nghe (Month):</b></font> </td>
		<td class=fr_2><input type=text name="s_nghe" size=20 value="<? echo $arrz[0][11];?>" class="form-control findasong"></td></tr>
		<tr><td class=fr width=10%><font color="red"><b>Link:</b></font> </td>
		<td class=fr_2><input type=text name="url" size=100 value="<? echo $arrz[0][4];?>" class="form-control findasong" required>
			<div class="help-tip"><p><b>Link: (*.mp3)(kiwi6.com)(mboxmp3.com)(musicsite.biz)(youtube.com)</b></p></div>
		</td></tr>
		<tr><td class=fr width=10%><font color="blue"><b>Đường dẫn lời nhạc (LRC NCT):</b></font></td>
		<td class=fr_2><input type=text name="lyricLRCNCT" size=100 value="<? echo $arrz[0][12];?>" class="form-control findasong">
			<div class="help-tip"><p>ví dụ: <b>http://lrc.nct.nixcdn.com/2015/12/22/1/4/4/5/1450749578576.lrc (.lrc mã hóa: Lyr1cjust4nct)</b></p></div>
		</td></tr>
		<tr><td class=fr width=10%><font color="blue"><b>Đường dẫn lời nhạc (SRT):</b></font></td>
		<td class=fr_2><input type=text name="lyricSRT" size=100 value="<? echo $arrz[0][14];?>" class="form-control findasong">
			<div class="help-tip"><p>ví dụ: <b>lyrics/Thu Hien,Trung Duc - Truong Son Dong Truong Son Tay.srt</p></div>
		</td></tr>
		<tr><td class=fr width=10%><font color="blue"><b>Đường dẫn lời nhạc (LRC):</b></font></td>
		<td class=fr_2><input type=text name="lyricLRC" size=100 value="<? echo $arrz[0][15];?>" class="form-control findasong">
			<div class="help-tip"><p>ví dụ: <b>lyrics/Thu Hien,Trung Duc - Truong Son Dong Truong Son Tay.lrc</p></div>
		</td></tr>
		<tr><td class=fr width=10%><font color="blue"><b>Đường dẫn lời nhạc Karaoke (XML):</b></font></td>
		<td class=fr_2><input type=text name="lyricKAR" size=100 value="<? echo $arrz[0][16];?>" class="form-control findasong">
			<div class="help-tip"><p>Định dạng của AS3 Karaoke: <b>lyrics/Thu Hien,Trung Duc - Truong Son Dong Truong Son Tay.xml</p></div>
		</td></tr>
        <tr><td class=fr width=10%><font color="blue"><b>Định Dạng:</b></font></td>
		<td class=fr_2><?=acp_type($arrz[0][8]);?></td></tr>
        <tr><td class=fr width=10%><font color="blue"><b>IMG (Video):</b></font> </td>
		<td class=fr_2>
			<input type="file" name="img" size=50 class="form-control findasong inline-block">
			<span class="inline-block" style="margin-left:15px"><input type="checkbox" name="grab_img"> Grab IMG (Youtube, Zing Video) [ <? echo $arrz[0][5];?> ]</span>
		</td></tr>
        <tr><td class=fr width=10%><font color="blue"><b>Đường dẫn ảnh bài hát:</b></font></td>
		<td class=fr_2><input type=text name="image" size=100 value="<? echo $arrz[0][5];?>" class="form-control findasong">
			<div class="help-tip"><p>Ví dụ: <b>upload/singer/TrungDucThuHien.jpg</p></div>
		</td></tr>
		<tr><td class=fr width=10%><font color="blue"><b>Server:</b></font></td>
		<td class=fr_2><?=acp_server($arrz[0][6])?></td></tr>
		<tr><td class=fr width=10% valign="top"><font color="blue"><b>Lời nhạc:</b></font> </td>
		<td class=fr_2><textarea style="height: 250px; width: 600px;" name="lyric" class="form-control"><?=un_htmlchars($arrz[0][7]);?></textarea></td></tr>
        <tr><td class=fr width=10% valign="top"><font color="blue"><b>Lời nhạc động:</b></font> </td>
		<td class=fr_2><textarea style="height: 250px; width: 600px;" name="lyricCaption" class="form-control"><?=un_htmlchars($arrz[0][13]);?></textarea>
        
			<div class="help-tip"><p><b>Gợi ý: Copy nội dung file nhạc .srt vào phía trên (^.^)</p></div>
		</td></tr>
		<tr><td class="fr" align="center" colspan="2">
			<button class="btn btn-primary" type="submit" name="submit"><?echo submit;?></button>
			<button class="btn btn-warning" type="reset"><?echo reset;?></button>
		</td></tr>
	</table>
</form>
</div>
</body>
</html>