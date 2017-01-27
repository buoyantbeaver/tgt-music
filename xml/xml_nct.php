<?php
define('TGT-MUSIC',true);
include('../tgt/tgt_music.php');
include('../tgt/class.inputfilter.php');

$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']); $id = del_id($id);
header("Content-Type: text/xml; charset=utf-8");

$xml = '<tracklist>'.

	'<type>song</type>';
	
$arr = $tgtdb->databasetgt(" m_id, m_url, m_title, m_singer, m_is_local, m_lyricLRCNCT, m_img ","data"," m_id = '".$id."'");
$singer_name	=	str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'"));
$lyricCaption = str_replace("'", " ", un_htmlchars($arr[0][5]));
$image = un_htmlchars($arr[0][6]);
$title 		= get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'");
$song_url 	= url_link($arr[0][2].'-'.$title,$id,'nghe-bai-hat-nct');
$singer_url = SITE_LINK.'tim-kiem/bai-hat.html?key='.text_s($title).'&ks=singer';
//<jwplayer:image>image_path</jwplayer:image>
//<media:thumbnail url="/thumbs/bunny.jpg" />
//<jwplayer:hd.file>/videos/hd-bunny.mp4</jwplayer:hd.file>

//<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:jwplayer="http://developer.longtailvideo.com/trac/"> 
  //<channel> 
    //<title>MRSS Playlist</title> 
    //<description>MRSS Playlist Demo</description> 
    //<link>http://developer.longtailvideo.com/</link> 
    //<item> 
      //<title>Big Buck Bunny</title> 
      //<description>Big Buck Bunny is a short Blender Film.</description>
      //<link>http://developer.longtailvideo.com/</link> 
      //<author>Buck Bunny</author> 
      //<jwplayer:file>/videos/bunny.mp4</jwplayer:file>
      //<jwplayer:hd.file>/videos/hd-bunny.mp4</jwplayer:hd.file>
      //<media:thumbnail url="/thumbs/bunny.jpg" />
      //<jwplayer:duration>33.03</jwplayer:duration> 
      //<jwplayer:provider>http</jwplayer:provider>
      //<jwplayer:http.startparam>start</jwplayer:http.startparam>
//      <jwplayer:captions.file>/files/captions_1.xml</jwplayer:captions.file>
    //</item> 
    //<item> 
      //<title>Sintel</title> 
      //<description>Sintel is a fantasy computer generated short movie.</description>
      //<link>http://developer.longtailvideo.com/</link> 
      //<author>Sintel</author> 
      //<jwplayer:file>/videos/sintel.mp4</jwplayer:file>
//      <jwplayer:hd.file>/videos/hd-sintel.mp4</jwplayer:hd.file>
      //<media:thumbnail url="/thumbs/sintel.jpg" />
      //<jwplayer:duration>888.06</jwplayer:duration> 
   //   <jwplayer:streamer>rtmp://myserver.com/myApp/</jwplayer:streamer>
  //    <jwplayer:captions.file>/files/captions_1.xml</jwplayer:captions.file>
 //   </item> 
//  </channel> 
//</rss>

$xml .= '<track>'.

		'<title><![CDATA['.str_replace("'", " ", un_htmlchars($arr[0][2])).']]></title>'.

		'<creator><![CDATA['.str_replace("'", " ", get_data("singer","singer_name"," singer_id = '".$arr[0][3]."'")).']]></creator>'.

		'<location><![CDATA['.grab(get_url($arr[0][4],$arr[0][1])).']]></location>'.
			
		'<image><![CDATA['.$image.']]></image>'.
		
		'<bgimage><![CDATA['.$image.']]></bgimage>'.
		
		'<avatar><![CDATA['.$image.']]></avatar>'.
		
		'<info><![CDATA['.$song_url.']]></info>'.
		
		'<lyric><![CDATA['.$lyricCaption.']]></lyric>'.
		
		'<newtab><![CDATA['.$singer_url.']]></newtab>'.
		
		'<kbit><![CDATA[128]]></kbit>'.

		'</track>';

$xml .= '</tracklist>';
	
echo $xml;
exit();
?>