<?php
    session_start();

    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    $id = $_SESSION['logged'];

    if(isset($_POST['name-change']) && isset($_POST['name'])) {
        $name = $_POST['name'];
        if($connect) {
            if(!empty($name)) {
                $sql = "UPDATE klienci SET Imie = '$name' WHERE Id_klienta = '$id'";
                $result = mysqli_query($connect, $sql);
            } else {
                echo "Wpisz Imię";
            }
        
        } else {
            echo "Error: $connect->connect_errno";
        }
    }

    if(isset($_POST['surname-change'])) {
        $surname = $_POST['surname'];
        if($connect) {
            if(!empty($surname)) {
                $sql = "UPDATE klienci SET Nazwisko = '$surname' WHERE Id_klienta = '$id'";
                $result = mysqli_query($connect, $sql);
            } else {
                echo "Wpisz Nazwisko";
            }
        
        } else {
            echo "Error: $connect->connect_errno";
        }
    }

    if(isset($_POST['email-change'])) {
        $email = $_POST['email'];
        if($connect) {
            if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "UPDATE klienci SET Email = '$email' WHERE Id_klienta = '$id'";
                $result = mysqli_query($connect, $sql);
            } else {
                echo "Wpisz adres Email";
            }
        
        } else {
            echo "Error: $connect->connect_errno";
        }
    }

    if(isset($_POST['idNumber-change'])) {
        $idNumber = $_POST['idNumber'];
        if($connect) {
            if(!empty($idNumber)) {
                $sql = "UPDATE klienci SET Pesel = '$idNumber' WHERE Id_klienta = '$id'";
                $result = mysqli_query($connect, $sql);
            } else {
                echo "Wpisz Numer Pesel";
            }
        
        } else {
            echo "Error: $connect->connect_errno";
        }
    }

    if(isset($_POST['delete-button'])) {
        if($connect) {
            $sql = "DELETE FROM klienci USING klienci WHERE Id_klienta = '$id'";
            $sqlres = "DELETE FROM rezerwacje WHERE Id_klienta = '$id'";
            $result = mysqli_query($connect, $sqlres);
            $result = mysqli_query($connect, $sql);
            $_SESSION['logged'] = '';
            session_destroy();
            header('location: /index.php');
        } else {
            echo "Error: $connect->connect_errno";
        }
    }

    if($connect) {
        $sql = "SELECT * FROM rezerwacje WHERE Id_klienta = '$id'";
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
                        <h2 class="panel-heading">PANEL UŻYTKOWNIKA</h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php
                            $connect = new mysqli($host, $db_user, $db_password, $db_name);
                            if($connect) {

                                $id = $_SESSION['logged'];
                                $sql = "SELECT * FROM klienci WHERE Id_klienta = '$id'";
                                $result = mysqli_query($connect, $sql);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                echo <<<"text"
                                    <p class="panel-cycle">Imię:</p>
                                    <form method="post" class="panel-row">
                                        <input type="text" value="{$row['Imie']}" class="panel-desc" name="name">
                                        <button class="panel-button" name="name-change">Zmień dane</button>
                                    </form>
                                    <p class="panel-cycle">Nazwisko:</p>
                                    <form method="post" class="panel-row">
                                        <input type="text" value="{$row['Nazwisko']}" class="panel-desc" name="surname">
                                        <button class="panel-button" name="surname-change">Zmień dane</button>
                                    </form>
                                    <p class="panel-cycle">Adres Email:</p>
                                    <form method="post" class="panel-row">
                                        <input type="text" value="{$row['Email']}" class="panel-desc" name="email">
                                        <button class="panel-button" name="email-change">Zmień dane</button>
                                    </form>
                                    <p class="panel-cycle">Pesel:</p>
                                    <form method="post" class="panel-row">
                                        <input type="text" value="{$row['Pesel']}" class="panel-desc" name="idNumber">
                                        <button class="panel-button" name="idNumber-change">Zmień dane</button>
                                    </form>
                                text;

                                $connect->close();
                            } else {
                                echo "Error: $connect->connect_errno";
                            }
                        ?>
                    </div>
                    <div class="col-12 col-md-6">
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
                    </div>
                    <div class="col-12">
                            <form method="post">
                                <button class="main-button" name="delete-button">USUŃ KONTO</button>
                            </form>
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
    <script src="/public/js/swiper-bundle.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/script.js"></script>
</body>
</html>