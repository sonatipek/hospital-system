<?php
require_once("./db/config.php");
require_once("./db/dbconnect.php");

$tcno=$_GET["tcno"];
$resim_id=$_GET["resimid"];


$db=new DBConnect();
$sql="DELETE FROM resimler WHERE resim_id=$resim_id";
$data=$db->fetchAllData($sql);


header("Location:./goruntugoster.php?success=1&tcno=$tcno");