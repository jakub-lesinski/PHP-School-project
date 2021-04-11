<?php
    session_start();

    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    if($connect) {
        $id = $_SESSION['logged'];
        $user = "SELECT Id_użytkownika FROM użytkownicy WHERE Id_klienta = '$id'";
        $use = mysqli_query($connect, $user);

        if(mysqli_num_rows($use) != 0) {
            if(isset($_POST['add-photo'])) {
                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];    
                $folder = "image/".$filename;
                $productsql = "SELECT Id_produktu FROM produkty ORDER BY Id_produktu DESC LIMIT 1";
                $productres = mysqli_query($connect, $productsql);
                $idProduct = mysqli_fetch_array($productres, MYSQLI_ASSOC);
                $id = $idProduct['Id_produktu'];
                $sql = "INSERT INTO `produkty_zdjęcia` (`Id_zdjecia`, `Id_produktu`, `Url_zdjecia`) VALUES (NULL, '$id', '$filename')";
                mysqli_query($connect, $sql);
                header('location: /resources/views/pages/admin-panel.php');

                if (move_uploaded_file($tempname, $folder))  {
                    echo "Image uploaded successfully";
                }else{
                    echo "Failed to upload image";
              }
            }
        } else {
            header('location: /index.php');
        }

    } else {
        echo "Errors: $connect->connect_errno";
    }


?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/public/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/swiper-bundle.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header class="header">
        <div class="logo-wrapper">
            <a href="/index.php" class="logo"><h2 class="logo-heading">LES<span>CAR</span></h2></a>
            <button class="mobile-nav-button">
                <span class="mobile-nav-line"></span>
                <span class="mobile-nav-line"></span>
                <span class="mobile-nav-line"></span>
            </button>
        </div>
        <div class="nav-list-wrapper">
            <ul class="nav-list">
                <a href="#" class="close-nav-button">&times;</a>
                <li class="nav-list-item"><a href="/index.php" class="nav-list-link">STRONA GŁÓWNA</a></li>
                <li class="nav-list-item"><a href="/resources/views/pages/listing.php" class="nav-list-link">POJAZDY</a></li>
                <li class="nav-list-item"><a href="/resources/views/pages/about.php" class="nav-list-link">O NAS</a></li>
                <li class="nav-list-item"><a href="/resources/views/pages/contact.php" class="nav-list-link">KONTAKT</a></li>
            </ul>
            <div class="login-basket">
                <?php
                    if(isset($_SESSION['logged']) == "") {
                        echo '
                            <a href="/resources/views/pages/login.php" class="loginIcon">
                            <div class="loginIcon-item">
                            <i class="fas fa-user"></i>
                            <a href="/resources/views/pages/login.php" class="loginIcon-link"><p class="loginIcon-desc">Zaloguj</p></a>
                            </div>
                            </a>
                        ';
                    } else {
                        echo '
                        <div>
                            <a href="/resources/views/pages/panel.php" class="loginIcon">
                            <div class="loginIcon-item">
                            <i class="fas fa-user"></i>
                            <a href="/resources/views/pages/panel.php" class="loginIcon-link"><p class="loginIcon-desc">Profil</p></a>
                            </div>
                            </a>
                            <a href="/resources/views/partials/logout.php" class="loginIcon-link"><p class="loginIcon-desc">Wyloguj</p></a>
                        </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </header>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="uploadfile">
            <button type="submit" class="main-button" name="add-photo">DODAJ</button>
        </form>
    <footer class="footer">
        <div class="footer-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <a href="" class="logo"><h2 class="logo-heading">LES<span>CAR</span></h2></a>
                    </div>
                    <div class="col-12 col-md-3">
                        <p class="footer-desc">62-081 Przeźmierowo</p>
                        <p class="footer-desc">Ogrodowa 10</p>
                    </div>
                    <div class="col-12 col-md-3">
                        <p class="footer-desc">Godziny otwarcia:</p>
                        <p class="footer-desc">Pon-pt: 9-17</p>
                    </div>
                    <div class="col-12 col-md-3">
                        <a href="tel:792-882-508" class ="footer-link">
                            <i class="fas fa-phone-alt"></i>
                            <p class="footer-desc">+48 792 882 508</p>
                        </a>
                        <a href="mailto:jakub.lesinski@uczen.zsk.poznan.pl" class="footer-link">
                            <i class="fas fa-envelope"></i>
                            <p class="footer-desc">jakub.lesinski@uczen.zsk.poznan.pl</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="footer-copy">&copy;Copyright Jakub Lesiński 2021</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="/public/js/swiper-bundle.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/script.js"></script>
</body>
</html>