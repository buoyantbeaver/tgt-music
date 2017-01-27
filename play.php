<?php
$api = "http://wincor.com.vn/file/mp3.php?id=";
$quality = (isset($_GET['quality'])) ? (int) $_GET['quality'] : 1;
$type = '128';
if($quality == 2) $type = '320';
elseif($quality == 3) $type = 'lossless';
(isset($_GET['url'])) ? $url = $_GET['url'] : null;
if($url)
{
    $c = file_get_contents("http://wincor.com.vn/file/mp3.php?id=$url");
    $d = json_decode($c, true);
    $e = $d['url'][$type];
    if($e){ header("Location: $e"); }
}