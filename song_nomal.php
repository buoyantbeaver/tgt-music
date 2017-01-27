<?
$url = $_GET['id'];
$link = preg_match("#www(.*?).zippyshare.com/v/(.*?)/file.html#s",$url,$id);
$url = 'http://www'.$id[1].'.zippyshare.com/downloadMusic?key='.$id[2].'&time='.strtotime(date("Y/m/d"));
header("Location: ".$url);
exit();