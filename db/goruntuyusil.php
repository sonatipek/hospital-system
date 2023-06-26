<?php
require_once("./config.php");
require_once("./dbconnect.php");

$tcno=$_GET["tcno"];
$resim_id=$_GET["resimid"];


$db=new DBConnect();
$sql="DELETE FROM resimler WHERE resim_id=$resim_id";
$data=$db->fetchAllData($sql);


header("Location:../pages/goruntugoster.php?success=1&tcno=$tcno");