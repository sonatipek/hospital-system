<!-- Get Patient Data -->
<?php
    require_once("../db/config.php");
    require_once("../db/dbconnect.php");

    $db=new DBConnect();
    $sql="SELECT * FROM hastabilgileri";
    $data=$db->fetchAllData($sql);
?>
<!-- Get Patient Data End -->

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

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        </div>
    </nav>
    <!-----------------------------Navbar End---------------------->


    <!-- Success Information -->
    <?php if(isset($_GET['success'])) : ?>
        <div class="alert alert-success" role="alert">
            Hasta Güncelleme İşlemi Başarılı!
        </div>
    <?php endif; ?>
    <!-- Success Information End -->

    <!-- Unsuccess Information -->
    <?php if(isset($_GET['unsuccess'])) : ?>
        <div class="alert alert-danger" role="alert">
            Hasta Güncelleme İşlemi Başarısız!
        </div>
    <?php endif; ?>
    <!-- Unsuccess Information End -->


    <main class="container mx-auto w-25 mt-5">
        <form method="POST" action="../db/hastayiguncelle.php">
            <!-- Form Image -->
            <div class="col-12 text-center">
                <img class="mb-4" src="../src/images/brand_logo.svg" alt="logo" height="60">
            </div>


            <!-- Form Title -->
            <h1 class="fs-3 fw-light mt-2">Hasta Güncelleme Formu</h1>

            <!-- Hasta seçimi -->
            <div class="row">
                
                <div class="col-12 my-2">
                    <label for="hasta_mail" class="form-label">Hasta Seçimi</label>
                    <select id="patitent-select" class="form-select" aria-label="select patient">
                        <option selected>Güncellemek İstediğiniz Hastayı Seçiniz</option>
                        <?php
                            $len=count($data);
                            
                            for ($i=0; $i < $len; $i++) { 
                                echo "<option value='". $data[$i]['tcno'] ."'> ". $data[$i]['adi'] ." ". $data[$i]['soyad'] ."</option>";
                            }
                        ?>
                    </select>
                </div> <!-- ./col-12 mb-2 -->

            </div><!-- ./row -->
            <!-- Hasta Adı ve Soyadı End -->


            <!-- Hasta TC -->
            <div class="col-12 my-2">
                <input type="hidden" class="form-control" id="hasta_tc" name="hasta_tc" >
            </div>
            <!-- Hasta TC End -->


            <!-- Hasta Email -->
            <div class="col-12 my-2">
                <label for="hasta_mail" class="form-label">Hasta E-Mail</label>
                <input type="email" class="form-control" id="hasta_mail" name="hasta_mail" >
            </div>
            <!-- Hasta Email End -->

            <!-- Hasta Adres -->
            <div class="col-12 mb-2">
                <label for="hasta_adres" class="form-label">Hasta Adresi</label>
                <textarea class="form-control" id="hasta_adres" name="hasta_adres" rows="3" maxlength="255" placeholder="Hastanın Adersini Giriniz..."></textarea>
            </div>
            <!-- Hasta Adres End -->

            <button class="btn btn-lg btn-primary w-100 mt-4" type="submit">Ekle</button>
        </form>
    </main>
    

    <!------------------------------------Footer------------------------------------>
    <div class="container">
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

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- automatic data entry after selection -->
    <script>
        let selectPatient = document.querySelector('#patitent-select');
        let tcInput = document.querySelector('#hasta_tc');

 
        selectPatient.addEventListener('change', () => {

            tcInput.value = selectPatient.value;

        })
    </script>
</body>
</html>