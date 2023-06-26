<?php
require_once("./config.php");
require_once("./dbconnect.php");

// Form values
$tc = $_POST['hasta_tc'];
$tc = str_replace(' ','',$tc);  //deleting blanks that occur when retrieving from input

$adres = $_POST['hasta_adres'];
$email = $_POST['hasta_mail'];



// DB Connection and sql queries
$db=new DBConnect();
$sql="UPDATE hastabilgileri SET adres = '$adres', email = '$email' WHERE tcno = '$tc'";
$isSuccess = $db->sqlExec($sql);


if ($isSuccess) {
    header("Location:../pages/hastaguncelle.php?success");
    
}else {
    header("Location:../pages/hastaguncelle.php?unsuccess");
    
}

