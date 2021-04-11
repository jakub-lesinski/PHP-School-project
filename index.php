<?php 
    session_start();
    
    require_once "resources/views/partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    if($connect) {
        $sql = "SELECT * FROM produkty";
        $result = mysqli_query($connect, $sql);
        $data = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        if(isset($_POST['send-btn'])) {
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $send = "INSERT INTO `wiadomosci` (`Id_wiadomosci`, `Email`, `Temat`, `Tresc`) VALUES (NULL, '$email', '$subject', '$message')";
            mysqli_query($connect, $send);
            echo 'Wysłano wiadomość';
        }

        $connect->close();
    } else {
        echo "Error: $connect->connect_errno";
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="public/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/swiper-bundle.css">
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
                            <a href="#" class="loginIcon">
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
    <section class="index">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="index-heading">Wybierz swój samochód!</h1>
                    <form action="" class="index-form">
                        <div class="index-form-line">
                            <label for="type"></label>
                            <select class="index-form-select" name="type" id="type">
                                <option value="" class="default-option">Rodzaj samochodu</option>
                                <option value="">Sportowe</option>
                                <option value="">Suv</option>
                                <option value="">Miejskie</option>
                                <option value="">Cabrio</option>
                                <option value="">Sedan</option>
                            </select>
                        </div>
                        <div class="index-form-line">
                            <label for="brand"></label>
                            <select class="index-form-select" name="brand" id="brand">
                                <option value="" class="default-option">Marka</option>
                                <?php
                                        foreach ($data as $row) {
                                            $marka = $row['Marka'];
                                            echo '
                                                <option class="">'.$marka.'</option>
                                            ';
                                        }
                                    ?>
                            </select>
                            <label for="model"></label>
                            <select class="index-form-select" name="model" id="model">
                                <option value="" class="default-option">Model</option>
                                <?php
                                        foreach ($data as $row) {
                                            $model = $row['Model'];
                                            echo '
                                                <option class="">'.$model.'</option>
                                            ';
                                        }
                                    ?>
                            </select>
                            <label for="yearFrom"></label>
                            <select class="index-form-select" name="yearFrom" id="yearFrom">
                                <option value="" class="default-option">Rok od</option>
                                <?php
                                        foreach ($data as $row) {
                                            $year = $row['Rok_Produkcji'];
                                            echo '
                                                <option class="">'.$year.'</option>
                                            ';
                                        }
                                    ?>
                            </select>
                            <label for="yearTo"></label>
                            <select class="index-form-select" name="yearTo" id="yearTo">
                                <option value="" class="default-option">Rok do</option>
                                <?php
                                        foreach ($data as $row) {
                                            $year = $row['Rok_Produkcji'];
                                            echo '
                                                <option class="">'.$year.'</option>
                                            ';
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="index-form-line">
                            <label for="fuel"></label>
                            <select class="index-form-select" name="fuel" id="fuel">
                                <option value="" class="default-option">Rodzaj Paliwa</option>
                                <option value="">Benzyna</option>
                                <option value="">Diesel</option>
                            </select>
                        </div>
                        <div class="index-form-line">
                            <label for="priceFrom"></label>
                            <select class="index-form-select" name="priceFrom" id="priceFrom">
                                <option value="" class="default-option">Cena od</option>
                                <?php
                                        foreach ($data as $row) {
                                            $price= $row['Cena'];
                                            echo '
                                                <option class="">'.$price.'</option>
                                            ';
                                        }
                                    ?>
                            </select>
                            <label for="priceTo"></label>
                            <select class="index-form-select" name="priceTo" id="priceTo">
                                <option value="" class="default-option">Cena do</option>
                                <?php
                                        foreach ($data as $row) {
                                            $price= $row['Cena'];
                                            echo '
                                                <option class="">'.$price.'</option>
                                            ';
                                        }
                                    ?>
                            </select>
                        </div>
                    </form>
                        <div class="index-form-line">
                            <button class="main-button">SZUKAJ</button>
                        </div>
                    <a href="/resources/views/pages/listing.php" class="index-link"><p class="index-desc">Wyszukaj więcej...</p></a>
                </div>
            </div>
        </div>
    </section>
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
    <script src="public/js/swiper-bundle.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/script.js"></script>
</body>
</html>