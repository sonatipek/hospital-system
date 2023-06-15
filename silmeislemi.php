<?php
require_once("./db/config.php");
require_once("./db/dbconnect.php");

$tcno=$_GET["tcno"];
$hasta_id=$_GET["hastaid"];

$db=new DBConnect();
$sql="DELETE FROM hastabilgileri WHERE hastaid=$hasta_id";
$data=$db->fetchAllData($sql);


header("Location:./pages/hastasil.php?success=1");