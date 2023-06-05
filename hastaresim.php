<?php
$tcno=$_GET["tcno"];
?>

<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="UTF-8" />
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/style.css" />
    <title>Imza Yükleme</title>
  </head>
  <body>





    <div class="container">
      <input type="file" id="upload-button" multiple accept="image/*" />
      <label for="upload-button">
        <i class="fa-solid fa-upload"></i>&nbsp; Dosya Seç
      </label>

   

    </div>

     
  


    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="application/javascript" src="js/script.js"></script>
    <!-- <script type="application/javascript" src="js/jquery.resizeImg.js"></script> -->
  </body>
</html>
