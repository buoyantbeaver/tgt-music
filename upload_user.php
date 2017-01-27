<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/ajax.php");
include("./tgt/functions_user.php");
if(!$_SESSION["tgt_user_id"])  mss("Bạn chưa đăng nhập vui lòng đăng nhập để sử dụng chức năng này.","./index.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<? echo SITE_LINK ?>" />
<title>UPLOAD NHẠC</title>
<meta name="title" content="Upload nhạc miễn phí" />
<meta name="keywords" content="Upload nhạc miễn phí" />
<meta name="description" content="Upload,nhạc,miễn,phí,upload nhạc, miễn phí" />
<? include("./theme/ip_java.php");?>
<script type="text/javascript" src="up_v1/swfupload.js"></script>
<script type="text/javascript" src="up_v1/fileprogress.js"></script>
<script type="text/javascript" src="up_v1/handlers.js"></script>
<link rel="stylesheet" href="up_v1/default.css" type="text/css" />
<script type="text/javascript">
		var swfu;

		window.onload = function () {
			swfu = new SWFUpload({
				// Backend settings
				upload_url: mainURL+"upload.php",
				file_post_name: "resume_file",

				// Flash file settings
				file_size_limit: "16 MB",
				file_types : "*.f4v;*.flv;*.mp4;*.mp3",
				file_types_description : "All Files",
				file_upload_limit : 0,
				file_queue_limit : 1,

				// Event handler settings
				swfupload_loaded_handler : swfUploadLoaded,
				
				file_dialog_start_handler: fileDialogStart,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				
				//upload_start_handler : uploadStart
				swfupload_preload_handler : preLoad,
				swfupload_load_failed_handler : loadFailed,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : mainURL+"up_v1/upload.png",
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 61,
				button_height: 22,
				
				// Flash Settings
				flash_url : mainURL+"up_v1/swfupload.swf",
				flash9_url : mainURL+"up_v1/swfupload_fp9.swf",

				custom_settings : {
					progress_target : "fsUploadProgress",
					upload_successful : false
				},
				
				// Debug settings
				debug: false
			});

		};
	</script>
</head>
<body>
<div id="main">
	<? include("./theme/ip_header.php");?>
    <div id="contents">
    	<div id="m_4">
			<div class="box w_4">
            <h1>Upload nhạc</h1>
            <div style="padding:10px;">
            <form id="form1" action="thanks.php" enctype="multipart/form-data" method="post">
			<table width="100%" cellpadding="5" cellspacing="5">
				<tr>
					<td valign="top" align="right"><label for="song_name">Tên bài hát:</label></td>
					<td><input name="song_name" id="song_name" type="text" class="upload_tgt" style="width: 400px;" /><br>
<span style="padding-bottom: 5px;"><i>Tên chủ đề bài hát, clip, phim dạng tiếng Việt có dấu. </i></span>

</td>
				</tr>
				<tr>
					<td valign="top" align="right"><label for="singer_new">Trình bày: </label></td>
					<td><input name="singer_new" id="singer_new" type="text"  class="upload_tgt" style="width: 247px;" /> <select class="upload_tgt" style="width: 150px;" name="singer_type" class="user"><option value="1">Ca Sĩ Việt Nam</option><option value="2">Ca Sĩ Âu Mỹ</option><option value="2">Ca Sĩ Châu Á</option></select>
<br>
<span style="padding-bottom: 5px;"><i>Tên ca sĩ trình bày nếu có 2 ca sĩ vui lòng gõ: ca sĩ 1 Ft. Ca sĩ 2 ... </i></span>
</td>
				</tr>
				<tr>
					<td valign="top" align="right"><label for="cat_name">Thể loại:</label></td>
					<td>
					<p><? echo acp_cat(1);?></p>
                    <p><i>Thể loại chính của ca khúc. Nếu không biết thì chọn là "Thể loại khác" </i></p>
                    </td>
				</tr>

				<tr>
					<td valign="top" align="right"><label for="txtFileName">File Upload: </label></td>
					<td>
						<div>
							<div>
								<input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
								<span id="spanButtonPlaceholder"></span>
							</div>
							<div class="flash" id="fsUploadProgress">
								<!-- This is where the file progress gets shown.  SWFUpload doesn't update the UI directly.
											The Handlers (in handlers.js) process the upload events and make the UI updates -->
							</div>
							<input type="hidden" name="hidFileID" id="hidFileID" value="" />
							<!-- This is where the file ID is stored after SWFUpload uploads the file and gets the ID back from upload.php -->
						</div>
                        <div><i>File upload không quá 50 Mb, có dạng MP3, FLV, MPEG, MPG, MP4</i></div>

					</td>
				</tr>
				<tr>
					<td valign="top" align="right"><label for="lyric">Lời bài hát:</label></td>
					<td><textarea  class="upload_tgt" name="lyric" id="lyric" cols="0" rows="0" style="width: 400px; height: 100px;"></textarea></td>				</tr>
                <tr><td></td>
                <td><input type="submit" value="Upload" class="_add_" id="btnSubmit" /></td>
                </tr>
			</table>
			
	</form>
    </div>
    </div>
            
        </div>
        <!--3-->
        <div id="m_3">
			<div class="box w_3">
            	<h1>Quy định upload</h1>
                <div style="padding: 10px;">
    Không upload nhạc cấm<br />
    Không upload nhạc xuyên tạc<br>
    Kích thước file tối đa là 50 MB

                </div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
    <? include("./theme/ip_footer.php");?>
</div>
</body>
</html>
<? 
//}
//$cache->close();
?>