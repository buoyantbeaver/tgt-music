<?
$pass_key = 'mahoalinkzip';
include_once('security/src/ancrypt_static/ANCrypt.static.class.php');
ANCrypt::setKey( $pass_key );
$url = $_GET['id'];
$link = preg_match("#www(.*?).zippyshare.com/v/(.*?)/file.html#s",$url,$id);
$url = 'http://www'.ANCrypt::decrypt($id[1]).'.zippyshare.com/downloadMusic?key='.ANCrypt::decrypt($id[2]).'&time='.strtotime(date("Y/m/d"));
header("Location: ".$url);
exit();