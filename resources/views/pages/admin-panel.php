<?php
    session_start();

    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    if($connect) {
        $id = $_SESSION['logged'];
        $user = "SELECT Id_użytkownika FROM użytkownicy WHERE Id_klienta = '$id'";
        $use = mysqli_query($connect, $user);

        if(mysqli_num_rows($use) != 0) {
            if(isset($_POST['add-btn'])) {
                $rodzaj = $_POST['RodzajPojazdu'];
                $marka = $_POST['Marka'];
                $model = $_POST['Model'];
                $rok = $_POST['RokProdukcji'];
                $paliwo = $_POST['RodzajPaliwa'];
                $pojemnosc = $_POST['Pojemnosc'];
                $naped = $_POST['Naped'];
                $skrzynia = $_POST['SkrzyniaBiegow'];
                $przebieg = $_POST['Przebieg'];
                $cena = $_POST['Cena'];
                $opis = $_POST['Opis'];

                $sql = "INSERT INTO `produkty` (`Id_produktu`, `Rodzaj`, `Marka`, `Model`, `Rok_Produkcji`, `Rodzaj_Paliwa`, `Pojemnosc`, `Naped`, `Skrzynia`, `Przebieg`, `Opis`, `Cena`) VALUES (NULL, '$rodzaj', '$marka', '$model', '$rok', '$paliwo', '$pojemnosc', '$naped', '$skrzynia', '$przebieg', '$opis', '$cena')";
                mysqli_query($connect, $sql);
                header('location: /resources/views/pages/photos.php');
            } 

            $cars = "SELECT * FROM produkty";
            $res = mysqli_query($connect, $cars);
            $data = array();
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $data[] = $row;
            }

            $messages = "SELECT * FROM wiadomosci";
            $resMessage = mysqli_query($connect, $messages);
            $mess = array();
            while ($message = mysqli_fetch_array($resMessage, MYSQLI_ASSOC)) {
                $mess[] = $message;
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
                            <a href="/resources/views/partials/logout.php" class="loginIcon-link"><p class="loginIcon-desc">Wyloguj</p></a>
                        </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </header>
    <section class="panel">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="panel-heading">PANEL ADMINA</h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4 class="">Dodaj Pojazd</h4>
                        <form method="post" class="panel-form" enctype="multipart/form-data">
                            <label for="Rodzaj Pojazdu">Rodzaj pojazdu</label>
                            <input type="text" class="login-input" name="RodzajPojazdu">
                            <label for="Marka">Marka</label>
                            <input type="text" class="login-input" name="Marka">
                            <label for="Model">Model</label>
                            <input type="text" class="login-input" name="Model">
                            <label for="Rok Produkcji">Rok produkcji</label>
                            <input type="text" class="login-input" name="RokProdukcji">
                            <label for="Rodzaj Paliwa">Rodzaj paliwa</label>
                            <input type="text" class="login-input" name="RodzajPaliwa">
                            <label for="Pojemność">Pojemność</label>
                            <input type="text" class="login-input" name="Pojemnosc">
                            <label for="Napęd">Napęd</label>
                            <input type="text" class="login-input" name="Naped">
                            <label for="Przebieg">Przebieg</label>
                            <input type="text" class="login-input" name="Przebieg">
                            <label for="Skrzynia Biegów">Skrzynia Biegów</label>
                            <input type="text" class="login-input" name="SkrzyniaBiegow">
                            <label for="Cena">Cena</label>
                            <input type="text" class="login-input" name="Cena">
                            <label for="Opis">Opis</label>
                            <textarea class="login-input" name="Opis" id="" cols="30" rows="10"></textarea>
                            <button type="submit" class="main-button" name="add-btn">DODAJ PRODUKT</button>
                        </form>
                    </div>
                    <div class="col-12 col-md-6">
                    <?php
                            foreach ($data as $row) {
                                $idcar = $row['Id_produktu'];
                                $marka = $row['Marka'];
                                $model = $row['Model'];
                                $price = $row['Cena'];
                                $year = $row['Rok_Produkcji'];
                                $fuel = $row['Rodzaj_Paliwa'];
                                $drive = $row['Naped'];
                                $capacity = $row['Pojemnosc'];
                                $mileage = $row['Przebieg'];

                                echo '
                                    <div class="listing-item">
                                        <div class="listing-item-desc">
                                            <h3 class="listing-item-heading">'.$marka.' '.$model.'</h3>
                                            <h4 class="listing-item-price">'.$price.' PLN</h4>
                                            <div class="listing-item-info">
                                                <p class="listing-item-cycle">'.$year.'</p>
                                                <p class="listing-item-cycle">'.$fuel.'</p>
                                                <p class="listing-item-cycle">'.$mileage.' km</p>
                                                <p class="listing-item-cycle">'.$capacity.'  cm&sup3;</p>
                                            </div>
                                        </div>
                                        <a href="/resources/views/pages/delete.php?Id_produktu='.$idcar.'" class="listing-item-delete"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                ';
                            }

                        ?>
                    </div>
                    <div class="col-12">
                        <?php
                            foreach ($mess as $message) {
                                $idWiadomosci = $message['Id_wiadomosci'];
                                $subject = $message['Temat'];
                                $email = $message['Email'];
                                $tresc = $message['Tresc'];
                                echo '
                                    <div style="display: flex; align-items: center;">
                                        <div class="listing-item-message">
                                            <h3 class="listing-item-heading">'.$email.'</h3>
                                            <h3 class="listing-item-heading">'.$subject.'</h3>
                                            <div class="listing-item-info">
                                                <p class="listing-item-cycle">'.$tresc.'</p>
                                            </div>
                                        </div>
                                        <a href="/resources/views/pages/message.php?Id_wiadomosci='.$idWiadomosci.'" class="listing-item-delete" name="delete-btn"><i class="fas fa-trash-alt"></i></a>
                                    </div>

                                ';
                            }
                        ?>
                    </div>
                    <a href="/resources/views/pages/reservation.php" class="panel-heading"style="color: black;"><h3>Rezerwacje</h3></a>
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
    <script src="/public/js/swiper-bundle.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/script.js"></script>
</body>
</html>