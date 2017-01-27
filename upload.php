<?php

#############################################
#		Upload music TGT-musisc V1.0		#
#			Code by ichphien_pro			#
#			  Y!m: ichphien_pro				#
#		Email: ichphienkute@Gmail.com		#
#############################################

function file_type(&$url) {

	$t_url = strtolower($url);

	$ext = explode('.',$t_url);

	$ext = $ext[count($ext)-1];

	$ext = explode('?',$ext);

	$ext = $ext[0];

	return $ext;

}

	// Thu muc upload

	$forder_upload	= "file_music/".date('m-Y')."/";

	$file_type		= file_type($_FILES["resume_file"]["name"]);

	// Tao thu muc upload

	$oldumask = umask(0);

		@mkdir('file_music/', 0777);

		@mkdir('file_music/'.date("m-Y"), 0777);	

	umask($oldumask); 

	// File sau khi duoc upload

	$file_name 		= '[IPOS - ONER.VN]-' .time() . '.' . $file_type;

	if (isset($_FILES["resume_file"]) && is_uploaded_file($_FILES["resume_file"]["tmp_name"]) && $_FILES["resume_file"]["error"] == 0) {

		@move_uploaded_file($_FILES["resume_file"]["tmp_name"],$forder_upload.$file_name);

		echo $file_name;

	}

			// TAGs
		$TaggingFormat = 'UTF-8';
		require_once('./getid3/getid3.php');
		// Initialize getID3 engine
		$getID3 = new getID3;
		$getID3->setOption(array('encoding'=>$TaggingFormat));
		
		require_once('./getid3/write.php');
		// Initialize getID3 tag-writing module
		$tagwriter = new getid3_writetags;
		//$tagwriter->filename       = '/path/to/file.mp3';
		$tagwriter->filename   = $local_file;
		$tagwriter->tagformats = array('id3v1'); 
		// set various options (optional)
		$tagwriter->overwrite_tags = true;
		$tagwriter->tag_encoding   = $TaggingFormat;
		$tagwriter->remove_other_tags = true;
		
		// populate data array
		$TagData['title'][]   =  '';
		$TagData['artist'][]  =  '';
		$TagData['album'][]   = '© IPOS - ONER.VN';
		$TagData['year'][]    =  date("Y");
		$TagData['genre'][]   = 'Other';
		$TagData['comment'][] = '© IPOS - ONER.VN';
		$TagData['track'][]   =  date("m");
		
		$tagwriter->tag_data = $TagData;
		$tagwriter->WriteTags();

	exit(0);

?>