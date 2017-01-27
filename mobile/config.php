<?php 
$dbhost ="localhost";
$dbuser="root";
$dbpass ="";
$db="nhacso";
$link = mysql_connect("$dbhost","$dbuser","$dbpass") or die("Khong the ket noi");
mysql_select_db("$db") or die("khong the ket noi CSDL");
mysql_query("SET NAMES 'UTF8'");
?>