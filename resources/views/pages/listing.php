<?php
    session_start();

    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    if($connect) {
        $sql = "SELECT * FROM produkty";
        $result = mysqli_query($connect, $sql);
        $data = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }

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
    <section class="listing">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <button class="accordion">Filtry szczegółowe</button>
                    <div class="panel">
                        <form action="" class="listing-filtr">
                            <div class="listing-filtr-line">
                                <label for="type"></label>
                                <select class="listing-select" name="type" id="type">
                                    <option value="" class="default-option">Rodzaj samochodu</option>
                                    <option value="">Sportowe</option>
                                    <option value="">Suv</option>
                                    <option value="">Miejskie</option>
                                    <option value="">Cabrio</option>
                                    <option value="">Sedan</option>
                                </select>
                                <label for="brand"></label>
                                <select class="listing-select" name="brand" id="brand">
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
                                <select class="listing-select" name="model" id="model">
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
                                <select class="listing-select" name="yearFrom" id="yearFrom">
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
                                <select class="listing-select" name="yearTo" id="yearTo">
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
                                <label for="fuel"></label>
                                <select class="listing-select" name="fuel" id="fuel">
                                    <option value="" class="default-option">Rodzaj Paliwa</option>
                                    <option value="">Benzyna</option>
                                    <option value="">Diesel</option>
                                </select>
                            </div>
                            <div class="listing-filtr-line">
                                <label for="capacityFrom"></label>
                                <select class="listing-select" name="capacityFrom" id="capacityFrom">
                                    <option value="" class="default-option">Pojemność od</option>
                                    <?php
                                        foreach ($data as $row) {
                                            $capacity = $row['Pojemnosc'];
                                            echo '
                                                <option class="">'.$capacity.'</option>
                                            ';
                                        }
                                    ?>
                                </select>
                                <label for="capacityTo"></label>
                                <select class="listing-select" name="capacityTo" id="capacityTo">
                                    <option value="" class="default-option">Pojemność do</option>
                                    <?php
                                        foreach ($data as $row) {
                                            $capacity = $row['Pojemnosc'];
                                            echo '
                                                <option class="">'.$capacity.'</option>
                                            ';
                                        }
                                    ?>
                                </select>
                                <label for="drive"></label>
                                <select class="listing-select" name="drive" id="drive">
                                    <option value="" class="default-option">Napęd</option>
                                    <option value="">Przód</option>
                                    <option value="">Tył</option>
                                    <option value="">4x4</option>
                                </select>
                                <label for="transmissione"></label>
                                <select class="listing-select" name="transmission" id="transmission">
                                    <option value="" class="default-option">Skrzynia biegów</option>
                                    <option value="">Manualna</option>
                                    <option value="">Automatyczna</option>
                                </select>
                                <label for="priceFrom"></label>
                                <select class="listing-select" name="priceFrom" id="priceFrom">
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
                                <select class="listing-select" name="priceTo" id="priceTo">
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
                            <button class="main-button"name="search-btn">SZUKAJ</button>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <?php
                        foreach ($data as $row) {
                            $idProduktu = $row['Id_produktu'];
                            $marka = $row['Marka'];
                            $model = $row['Model'];
                            $price = $row['Cena'];
                            $year = $row['Rok_Produkcji'];
                            $fuel = $row['Rodzaj_Paliwa'];
                            $drive = $row['Naped'];
                            $capacity = $row['Pojemnosc'];
                            $mileage = $row['Przebieg'];

                            $sqlimg = "SELECT * FROM produkty_zdjęcia WHERE Id_produktu = $idProduktu";
                            $resultimg = mysqli_query($connect, $sqlimg);
                            $photos = array();
                            while ($photo = mysqli_fetch_array($resultimg, MYSQLI_ASSOC)) {
                                $photos[] = $photo;
                            }

                            foreach ($photos as $photo) {
                                $url = $photo['Url_zdjecia'];
                            }

                            echo '
                                <a href="/resources/views/pages/product.php?Id_produktu='.$idProduktu.'" class="listing-item">
                                <div class="container-fluid">
                                    <div class="row">
                                    
                                            <div class="col-12 col-md-3">
                                                <div class="listing-item-img">
                                                    <img src="/public/img/'.$url.'" alt="" class=img-fluid>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <div class="listing-item-desc">
                                                    <h3 class="listing-item-heading">'.$marka.' '.$model.'</h3>
                                                    <h4 class="listing-item-price">'.$price.' PLN</h4>
                                                    <div class="listing-item-info">
                                                    <p class="listing-item-cycle">'.$year.'</p>
                                                    <p class="listing-item-cycle">'.$fuel.'</p>
                                                    <p class="listing-item-cycle">'.$mileage.' km</p>
                                                    <p class="listing-item-cycle">'.$capacity.' cm&sup3;</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            ';
                        }
                    ?>
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
    <?php
         $connect->close();
    ?>
    <script src="/public/js/script.js"></script>
</body>
</html>