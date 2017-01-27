<?php
define('TGT-MUSIC',true);
include("../../tgt/tgt_music.php");
include("../../tgt/securesession.class.php");
#include("../../tgt/lang.php");

$con = mysql_connect("SERVER_HOST","DATABASE_NAME","DATABASE_USER", "DATABASE_PASS");
$db = mysql_select_db("DATABASE_NAME",$con);
	  
if($_GET) {
	$method = $_GET['method'];
	if($method == 'addnotes') {
		$data = $_GET['data'];
		$status = addnotes($data);
		if($status != '')
			$output = array('status'=>'success','id'=>$status);
		else
			$output = array('status'=>'error');	
		echo json_encode($output);
	}
	if($method == 'delnotes') {
		$id = $_GET['id'];
		$status = delnotes($id);
		if($status == 'success')
			$output = array('status'=>'success');
		else
			$output = array('status'=>'error');	
		echo json_encode($output);
	}
}

function addnotes($data)
{
	$insert = mysql_query("insert into notes(description) values('$data')");
	if($insert)
	return mysql_insert_id();
}

function delnotes($id)
{
	$delete = mysql_query("delete from notes where id='$id'");
	if($delete)
	return 'success';
}

function loadnotes()
{
	$query = mysql_query("select * from notes");
	if(mysql_num_rows($query) > 0)
	{
	while($fetch = mysql_fetch_array($query))
	{
		echo '<li id="'.$fetch['id'].'" >'.$fetch['description'].' 
		<a href="#"class="event-close"> &#10005; </a>
		</li>';
	}
	}
}
?>