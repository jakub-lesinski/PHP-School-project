<?php
    session_start();

    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    if($connect) {
        $id = $_SESSION['logged'];
        $user = "SELECT Id_użytkownika FROM użytkownicy WHERE Id_klienta = '$id'";
        $use = mysqli_query($connect, $user);

        if(mysqli_num_rows($use) != 0) {
            $sql = "SELECT * FROM rezerwacje";
            $result = mysqli_query($connect, $sql);
            $data = array();
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = $row;
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
    <section class="reservation">
        <?php
            foreach ($data as $row) {
                $idRezerwacji = $row['Id_rezerwacji'];
                $idKlienta = $row['Id_klienta'];
                $idProduktu = $row['Id_produktu'];
                $kiedy = $row['Czas_rezerwacji'];
                echo '
                    <div class="listing-item">
                        <div class="listing-item-desc">
                            <p class="listing-item-heading">ID Rezerwacji: '.$idRezerwacji.'</p>
                            <div class="listing-item-info">
                                <p class="listing-item-cycle">Id Klienta: '.$idKlienta.'</p>
                                <p class="listing-item-cycle">ID Pojazdu: '.$idProduktu.'</p>
                                <p class="listing-item-cycle">Kiedy nastąpiła rezerwacja: '.$kiedy.'</p>
                            </div>
                        </div>
                        <a href="/resources/views/pages/reservation-delete.php?Id_rezerwacji='.$idRezerwacji.'" class="listing-item-delete"><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';
            }
        ?>
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