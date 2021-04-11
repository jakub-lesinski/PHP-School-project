<?php
    session_start();

    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    $date = date("Y-m-d");

    if($connect) {
        $id = $_GET['Id_produktu'];
        $sql = "SELECT * FROM produkty WHERE Id_produktu = $id";
        $result = mysqli_query($connect, $sql);
        $data = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        $sqlimg = "SELECT * FROM produkty_zdjęcia WHERE Id_produktu = $id";
        $resultimg = mysqli_query($connect, $sqlimg);
        $photos = array();
        while ($photo = mysqli_fetch_array($resultimg, MYSQLI_ASSOC)) {
            $photos[] = $photo;
        }

        $sqlreserv = "SELECT * FROM rezerwacje WHERE Id_produktu = $id";
        $resultReserv = mysqli_query($connect, $sqlreserv);
        if(mysqli_num_rows($resultReserv) > 0) {
            $czyReserv = true;
        } else {
            $czyReserv = false;
        }

        if(isset($_POST['reserve-btn'])) {
            if($_SESSION['logged']!= '') {
                $idClient = $_SESSION['logged'];
                $reserv = "INSERT INTO `rezerwacje` (`Id_rezerwacji`, `Id_klienta`, `Id_produktu`, `Czas_rezerwacji`) VALUES (NULL, '$idClient', '$id', '$date')";
                mysqli_query($connect, $reserv);
                // echo $connect -> error;
                // echo $reserv;
                header('refresh: 0');
            } else {
                header('location: /resources/views/pages/login.php');
            }
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
    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php 
                        foreach ($data as $row) {
                            $marka = $row['Marka'];
                            $model = $row['Model'];
                            $price = $row['Cena'];
                            echo '
                                <h1 class="product-heading">'.$marka.' '.$model.'</h1>
                                <h2 class="product-price">'.$price.' PLN</h2>
                            ';
                        }

                    ?>
                </div>
                
                <div class="col-12 col-md-6">
                    <?php 
                        foreach ($photos as $photo) {
                            $url = $photo['Url_zdjecia'];
                            echo '
                                <img src="/public/img/'.$url.'" alt="" class=img-fluid>
                            ';
                        }

                    ?>
                </div>
                <div class="col-12 col-md-6">
                    <div class="product-info">
                        <div class="product-info-row">
                            <?php 
                                foreach ($data as $row) {
                                    $year = $row['Rok_Produkcji'];
                                    $fuel = $row['Rodzaj_Paliwa'];
                                    $capacity = $row['Pojemnosc'];

                                    echo '
                                        <p class="product-info-desc">Rok produckji: '.$year.'</p>
                                        <p class="product-info-desc">Rodzaj paliwa: '.$fuel.'</p>
                                        <p class="product-info-desc">Pojemność: '.$capacity.' cm&sup3;</p>
                                    ';
                                }

                            ?>
                        </div>
                        <div class="product-info-row">
                            <?php 
                                foreach ($data as $row) {
                                    $drive = $row['Naped'];
                                    $gearBox = $row['Skrzynia'];
                                    $mileage = $row['Przebieg'];

                                    echo '
                                        <p class="product-info-desc">Napęd: '.$drive.'</p>
                                        <p class="product-info-desc">Skrzynia biegów: '.$gearBox.'</p>
                                        <p class="product-info-desc">Przebieg: '.$mileage.' km</p>
                                    ';
                                }
                            ?>
                        </div>
                        <div class="product-info-row">
                            <?php 
                                foreach ($data as $row) {
                                    $description = $row['Opis'];

                                    echo '
                                        <p class="product-info-desc">'.$description.' km</p>
                                    ';
                                }
                            ?>
                        </div>
                            <?php
                                if($czyReserv) {
                                    echo '
                                        <form method="Post">
                                            <button class="main-button" name="reserve-btn" disabled>ZAREZERWOWANO</button>
                                            <p>Dokonano rezerwacji na 3 dni od: '.$date.'</p>
                                        </form>
                                    ';
                                } else {
                                    echo '
                                        <form method="Post">
                                            <button class="main-button" name="reserve-btn">ZAREZERWUUJ</button>
                                        </form>
                                ';
                                }
                            ?>
                    </div>
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
    <script src="/public/js/script.js"></script>
</body>
</html>