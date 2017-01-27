<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
define('TGT-MUSIC',true);
include("./tgt/tgt_music.php");
include("./tgt/class.inputfilter.php");
$myFilter = new InputFilter();
if(isset($_GET["id"])) $id = $myFilter->process($_GET['id']);
if(isset($_GET["key"])) $key = $myFilter->process($_GET['key']);

if ($id && $key == md5($id.'tgt_music')) {
	$arr = $tgtdb->databasetgt(" m_url, m_is_local ","data"," m_id = '".$id."'");
	mysql_query("UPDATE tgt_nhac_data SET m_downloaded = m_downloaded + 1, m_downloaded_month = m_downloaded_month + 1 WHERE m_id = '".$id."'");
	//$url = grab(get_url($arr[0][1],$arr[0][0]));
	$url = zingmp3($arr[0][0]);
	ksort($url['url'], 2);
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style>
      .col-centered{
      float: none;
      margin: 0 auto;
    }
    </style>
</head>
<body>
<div class="col-md-3 col-centered">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><?=$url['name'];?></h3>
    </div>
    <div class="panel-body">
      <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
      <?php	foreach ($url['url'] as $key => $value) {
			if ($value){
				echo '<a class="btn btn-default" role="button" rel="nofollow" href="'.$value.'">'.$key.'</a>';
			}
		}
	  ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>	
<?php
}
function zingmp3($link)
{
	$a = parse_url($link);
	$b = explode('/', $a['path']);
	$c = explode('.', $b[3]);
	$id = $c[0];
	if($id)
	{
        $c = file_get_contents("http://wincor.com.vn/file/mp3.php?id=$id");
        $d = json_decode($c, true);
        return $d;
	}
	return false;
}
?>