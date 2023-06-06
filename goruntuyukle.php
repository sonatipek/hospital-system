<?php
require_once("./db/config.php");
require_once("./db/dbconnect.php");

$db=new DBConnect();
$sql="SELECT * FROM hastabilgileri";
$data=$db->fetchAllData($sql);
?>

<!doctype html>
<html lang="tr-TR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="./src/images/favicon/logoipsum-296.svg" type="image/x-icon">
    <title>Nesne Tabanlı Programlama Final | Sonat Saygın İpek</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!----------------------------Navbar--------------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Nesne Tabanlı Final">
        <div class="container">
            <!-- Brand Name -->
            <a class="navbar-brand fw-bold" href="./">
                <img src="./src/images/brand_logo.svg" alt="final exam brand logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse ms-5" id="navbarsExample07">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./hastalistele.php">Hastalar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./goruntuyukle.php">Görüntü Yükle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./goruntulistele.php">Görüntü Listele</a>
                    </li>
                </ul>


                <ul class="navbar-nav">
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Diğer İşlemler
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="./hastasil.php">Hasta Sil</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="./hastaekle.php" class="btn btn-outline-primary">Hasta Ekle</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----------------------------Navbar End---------------------->

    <main class="container mt-5">

        <h1 class="display-3">Hasta Seçim</h1>
        <p class="text-secondary">*Görüntüsünü yüklemek için bir hasta seçiniz!</p>

        <!-- Upload Image Cards Listing -->
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center mt-5">

            <!-- reproduction of cards according to the data -->
            <?php
                $len=count($data);
                for ($i=0; $i < $len; $i++) { 
                    echo "
                        <div class='col'>
                            <div class='card mb-4 rounded-3 shadow-sm border-primary-subtle'>
                                <div class='card-header py-3 bg-primary-subtle border-primary-subtle'>
                                    <h2 class='my-0 text-primary-emphasis'>".$data[$i]['adi']. " ".$data[$i]['soyad']."</h2>
                                </div>
                                
                                <div class='card-body'>
                                    <h4 class='text-secondary'>T.C. Numarası</h4>
                                    <h3 class='card-title pricing-card-title mb-4 text-primary-emphasis'>".$data[$i]['tcno']."</h3>

                                    <a href='./yuklemeekrani.php?tcno=".$data[$i]['tcno']."' class='w-100 btn btn-outline-primary mt-1 opacity-50'>
                                        Görüntü Yükle
                                        <i class='fa-solid fa-cloud-arrow-up'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    ";
                } 
            ?>

        </div>
        <!-- Upload Image Card Listing End -->
    </main>

    

    <!------------------------------------Footer------------------------------------>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">© 2023 Sonat Saygın İpek</p>
        
            <a href="./" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <b class="fw-bold fs-5">NT Final</b>
            </a>
      
            <!-- Footer Links -->
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="./" class="nav-link px-2 text-body-secondary">Ana Sayfa</a></li>
                <li class="nav-item"><a href="./hastalistele.php" class="nav-link px-2 text-body-secondary">Hastalar</a></li>
                <li class="nav-item"><a href="./goruntuyukle.php" class="nav-link px-2 text-body-secondary">Görüntü Yükle</a></li>
                <li class="nav-item"><a href="./goruntulistele.php" class="nav-link px-2 text-body-secondary">Görüntü Listele</a></li>
            </ul>
            
        </footer>
    </div>
    <!------------------------------------Footer  End------------------------------->

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>