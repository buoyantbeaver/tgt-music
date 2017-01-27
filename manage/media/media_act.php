<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
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
                    <td class="title_c"><font color="red"><b>Thêm Sửa Media: </b></font><font color="white"><b>những chữ màu đỏ là bắt buộc, màu xanh là tùy chọn (tips: tuannvbg@gmail.com)</b></font></td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			</table>
				
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding: 20px;">
                <form action="<?=$action;?>" method="post" enctype="multipart/form-data" >
	<table width=100% align=center cellpadding="2" cellspacing="2">
		<tr><td class=fr width=100px><font color="red"><b>Tên Ca Khúc :</b></font> </td><td class=fr_2><input type=text name="song" size=50 value="<? echo $arrz[0][1];?>"></td></tr>
		<tr><td class=fr width=100px><font color="red"><b>Trình bày: </b></font> </td><td class=fr_2><?=acp_singer($arrz[0][2]);?></td></tr>
        <tr><td class=fr width=100px><font color="blue"><b>Nhập tên mới: </b></font></td><td class=fr_2><?=them_moi_singer_form();?></td></tr>
        <tr><td class=fr width=100px><font color="blue"><b>Sáng tác: </b></font></td><td class=fr_2><input type=text name="sangtac" size=30 value="<? echo $arrz[0][9];?>"></td></tr>
		<tr><td class=fr width=100px><font color="red"><b>Thể loại:</b></font> </td><td class=fr_2><?=acp_cat($arrz[0][3]);?></td></tr>
		<tr><td class=fr width=100px><font color="blue"><b>Lượt Nghe (Month):</b></font> </td><td class=fr_2><input type=text name="s_nghe" size=20 value="<? echo $arrz[0][11];?>"></td></tr>
		<tr><td class=fr width=100px><font color="red"><b>Link:</b></font> </td><td class=fr_2><input type=text name="url" size=100 value="<? echo $arrz[0][4];?>"><br/><b>Link: (*.mp3)(kiwi6.com)(mboxmp3.com)(musicsite.biz)(youtube.com)</b></td></tr>
		<tr><td class=fr width=100px><font color="blue"><b>Đường dẫn lời nhạc (LRC NCT):</b></font></td><td class=fr_2><input type=text name="lyricLRCNCT" size=100 value="<? echo $arrz[0][12];?>"><br/>ví dụ: <b>http://lrc.nct.nixcdn.com/2015/12/22/1/4/4/5/1450749578576.lrc (.lrc mã hóa: Lyr1cjust4nct)</b></td></tr>
		<tr><td class=fr width=100px><font color="blue"><b>Đường dẫn lời nhạc (SRT):</b></font></td><td class=fr_2><input type=text name="lyricSRT" size=100 value="<? echo $arrz[0][14];?>"><br/>ví dụ: <b>lyrics/Thu Hien,Trung Duc - Truong Son Dong Truong Son Tay.srt</b></td></tr>
		<tr><td class=fr width=100px><font color="blue"><b>Đường dẫn lời nhạc (LRC):</b></font></td><td class=fr_2><input type=text name="lyricLRC" size=100 value="<? echo $arrz[0][15];?>"><br/>ví dụ: <b>lyrics/Thu Hien,Trung Duc - Truong Son Dong Truong Son Tay.lrc</b></td></tr>
		<tr><td class=fr width=100px><font color="blue"><b>Đường dẫn lời nhạc Karaoke(XML):</b></font></td><td class=fr_2><input type=text name="lyricKAR" size=100 value="<? echo $arrz[0][16];?>"><br/>Định dạng của AS3 Karaoke: <b>lyrics/Thu Hien,Trung Duc - Truong Son Dong Truong Son Tay.xml</b></td></tr>
        <tr><td class=fr width=100px><font color="blue"><b>Định Dạng:</b></font></td><td class=fr_2><?=acp_type($arrz[0][8]);?></td></tr>
        <tr><td class=fr width=100px><font color="blue"><b>IMG (Video):</b></font> </td><td class=fr_2><input type="file" name="img" size=50> <input type="checkbox" name="grab_img"> Grab IMG (Youtube, Zing Video) [ <? echo $arrz[0][5];?> ]
        </td></tr>
        <tr><td class=fr width=100px><font color="blue"><b>Đường dẫn ảnh bài hát:</b></font></td><td class=fr_2><input type=text name="image" size=100 value="<? echo $arrz[0][5];?>"><br/>ví dụ: <b>upload/singer/TrungDucThuHien.jpg</b></td></tr>
		<tr><td class=fr width=100px><font color="blue"><b>Server:</b></font></td><td class=fr_2><?=acp_server($arrz[0][6])?></td></td></tr>
		<tr><td class=fr width=100px valign="top"><font color="blue"><b>Lời nhạc:</b></font> </td><td class=fr_2>
        <textarea style="height: 250px; width: 600px;" name="lyric"><?=un_htmlchars($arrz[0][7]);?></textarea>
        </td></tr>
        <tr><td class=fr width=100px valign="top"><font color="blue"><b>Lời nhạc động:</b></font> </td><td class=fr_2>
        <textarea style="height: 250px; width: 600px;" name="lyricCaption"><?=un_htmlchars($arrz[0][13]);?></textarea>
        <br/><b>Gợi ý: Copy nội dung file nhạc .srt vào phía trên (^.^)</b></td></tr>
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