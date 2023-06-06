<?php
require_once("./db/config.php");
require_once("./db/dbconnect.php");

$tcno=$_GET["tcno"];

$db=new DBConnect();
$sql="SELECT resimbilgisi FROM resimler WHERE tcno='435345'";
$data=$db->fetchData($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

  
    <?php
        $len=count($data);

        for($i = 0; $i <= $len; $i++){
            echo "<img src='".$data['resimbilgisi']."' alt=''>";
        }    
    ?>
</body>
</html>