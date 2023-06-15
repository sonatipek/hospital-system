<!-- Get tcno  info -->
<?php
$tcno=$_GET["tcno"];
?>
<!-- Get tcno info End -->

<!doctype html>
<html lang="tr-TR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="../src/images/favicon/logoipsum-296.svg" type="image/x-icon">
    <title>İnternet Programcılığı Final | Sonat Saygın İpek</title>

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
            <a class="navbar-brand fw-bold" href="../">
                <img src="../src/images/brand_logo.svg" alt="final exam brand logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse ms-5" id="navbarsExample07">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../">Ana Sayfa</a>
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
                    <li class="nav-item"><a href="./hastaekle.php" class="btn btn-primary">Hasta Ekle</a></li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Diğer İşlemler
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="./hastasil.php">Hasta Sil</a></li>
                          <li><a class="dropdown-item" href="./hastaguncelle.php">Hasta Güncelle</a></li>
                        </ul>
                    </li>
                </ul>
        </div>
    </nav>
    <!-----------------------------Navbar End---------------------->

        <!-- Fixed Information Card -->
        <div class="mt-5 mx-3 w-25">
            <div class="border border-primary-subtle shadow rounded-3">
                <!-- Card Title -->
                <div class="bg-primary-subtle border border-bottom border-primary-subtle rounded-top  px-3 py-2 ">
                    <i class="fa-solid fa-circle-info text-primary-emphasis me-1"></i>
                    <strong class="text-primary-emphasis">İşlem Yaptığınız Hastanın T.C. Numarası</strong>
                </div>

                <!-- Card Desc -->
                <div class="text-secondary px-3 py-3">
                    <?php echo $tcno;?>
                </div>
            </div>
        </div>
        <!-- Fixed Information Card End -->


    <main class="container mt-3">
        <h1 class="display-3">Görüntü Yükle</h1>
    
        <div class="input-group input-group-lg px-5 mt-4">
            <input id="upload-input" type="file" accept="image/*" class="form-control form-control-lg " id="inputGroupFile04" aria-describedby="upload-button" aria-label="Upload">
            <button class="btn btn-lg btn-outline-primary" type="button" id="upload-button"><i class="fa-solid fa-cloud-arrow-up me-3"></i>Görüntüyü Yükle</button>
        </div>
        <p class="text-secondary px-5">Görüntü yüklemek için 'Dosya Seç' butonuna tıklayınız.</p>
    </main>



    <!------------------------------------Footer------------------------------------>
    <div class="container position-fixed bottom-0 start-50 translate-middle">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">© 2023 Sonat Saygın İpek</p>
        
            <a href="../" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <b class="fw-bold fs-5">İP Final</b>
            </a>
      
            <!-- Footer Links -->
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="../" class="nav-link px-2 text-body-secondary">Ana Sayfa</a></li>
                <li class="nav-item"><a href="./hastalistele.php" class="nav-link px-2 text-body-secondary">Hastalar</a></li>
                <li class="nav-item"><a href="./goruntuyukle.php" class="nav-link px-2 text-body-secondary">Görüntü Yükle</a></li>
                <li class="nav-item"><a href="./goruntulistele.php" class="nav-link px-2 text-body-secondary">Görüntü Listele</a></li>
            </ul>
            
        </footer>
    </div>
    <!------------------------------------Footer  End------------------------------->


    <!-- ... -->
    <input type="hidden" id="tcno" value="<?php echo $tcno;?>"> 
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Main.js File -->
    <script src="../src/javascript/fileUpload.js"></script>

</body>
</html>