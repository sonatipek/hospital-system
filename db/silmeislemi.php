<?php
require_once("./config.php");
require_once("./dbconnect.php");

$tcno=$_GET["tcno"];
$hasta_id=$_GET["hastaid"];

$db=new DBConnect();
$sql="DELETE FROM hastabilgileri WHERE hastaid=$hasta_id";
$data=$db->fetchAllData($sql);


header("Location:../pages/hastasil.php?success=1");