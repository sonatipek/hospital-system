<?php
require_once("./config.php");
require_once("./dbconnect.php");

// Form values
$ad = $_POST['hasta_adi'];
$soyad = $_POST['hasta_soyadi'];

$tc = $_POST['hasta_tc'];
$tc = str_replace(' ','',$tc);  //deleting blanks that occur when retrieving from input

$tel = $_POST['hasta_tel'];
$tel = str_replace(' ','',$tel); //deleting blanks that occur when retrieving from input
$tel = str_replace('(','',$tel); //deleting brackets that occur when retrieving from input
$tel = str_replace(')','',$tel); //deleting brackets that occur when retrieving from input
$tel = str_replace(')','',$tel); //deleting brackets that occur when retrieving from input
$tel = ltrim($tel,"0"); //deletes if there is a 0 at the beginning of the data

$cinsiyet = $_POST['hasta_cinsiyet'];



// DB Connection and sql queries
$db=new DBConnect();
$sql="INSERT INTO hastabilgileri(adi,soyad,tcno,tlfno,cinsiyet) VALUES('$ad', '$soyad', '$tc', '$tel', '$cinsiyet')";
$isSuccess = $db->sqlExec($sql);




if ($isSuccess) {
    header("Location:../pages/hastaekle.php?success");
    
}else {
    header("Location:../pages/hastaekle.php?unsuccess");
    
}

