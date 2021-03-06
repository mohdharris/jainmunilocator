<?php

//Connecting to the database
$db = new PDO('mysql:host=localhost;dbname=database name;charset=utf8', 'username', 'password', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$link = mysqli_connect("localhost","username","password","database name"); 
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//Please specify the use of this function here.
function getlocation($id)
{
	global $db;
	$x = $db->prepare("SELECT * FROM location WHERE lid = ?");
	$x->execute(array($id));
	if($x->rowCount() == 1)
	{
		$y = $x->fetch(PDO::FETCH_ASSOC);
		$t= "";
		if($y['place'] != "") $t = $t.', '.$y['place'];
		if($y['district'] != "") $t = $t.', '.$y['district'];
		if($y['state'] != "") $t = $t.', '.$y['state'];
		$t = ltrim($t,",");
		return $t;
	}
	else
	{
		return "N/A";
	}
}

//Please specify the use of this function here
function getmuni($id)
{
	global $db;
	$m = $db->prepare("SELECT * FROM munishri, upadhis WHERE id = ? AND approved=1 AND uid=upadhi");
	$m->execute(array($id));
	if($m->rowCount() == 1)
	{
		$n = $m->fetch(PDO::FETCH_ASSOC);
		$t= "";
		if($n['uname'] != "") $t = $t.' '.$n['uname'];
		if($n['prefix'] != "") $t = $t.' '.$n['prefix'];
		if($n['name'] != "") $t = $t.' '.$n['name'];
		if($n['suffix'] != "") $t = $t.' '.$n['suffix'];
		$t = ltrim($t,",");
		return $t;
	}
	else
	{
		return "N/A";
	}
}
?>
