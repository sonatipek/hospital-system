<?php
require_once("./config.php");
require_once("./dbconnect.php");

// Values
$resim=$_POST["resim"];
$tcno=$_GET["tcno"];


// DB Connection and sql queries
$db=new DBConnect();
$sql="INSERT INTO resimler (tcno, resimbilgisi)VALUES('$tcno','$resim')";
$isSuccess = $db->sqlExec($sql);

echo $isSuccess;