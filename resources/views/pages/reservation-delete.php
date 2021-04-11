<?php
    session_start();

    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

        $id = $_SESSION['logged'];
        $user = "SELECT Id_użytkownika FROM użytkownicy WHERE Id_klienta = '$id'";
        $use = mysqli_query($connect, $user);

    if($connect) {
        if(mysqli_num_rows($use) != 0) {
           if(isset($_POST['nie'])) {
                header('location: /resources/views/pages/admin-panel.php');
           }

           if(isset($_POST['tak'])) {
                $id = $_GET['Id_rezerwacji'];
                $sql = "DELETE FROM rezerwacje WHERE Id_rezerwacji = '$id'";
                mysqli_query($connect, $sql);
                header('location: /resources/views/pages/reservation.php');

           }
        } else {
            if(isset($_POST['nie'])) {
                header('location: /resources/views/pages/admin-panel.php');
           }

           if(isset($_POST['tak'])) {
                $id = $_GET['Id_rezerwacji'];
                $sql = "DELETE FROM rezerwacje WHERE Id_rezerwacji = '$id'";
                mysqli_query($connect, $sql);
                header('location: /resources/views/pages/panel.php');

           }
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
        <a href="/index.php" class="logo"><h2 class="logo-heading">LES<span>CAR</span></h2></a>
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
    </header>
    <form method="POST">
    <h2>Czy usunąć produkt?</h2>
    <button class="main-button" name="tak">TAK</button>
    <button class="main-button" name="nie">NIE</button>
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