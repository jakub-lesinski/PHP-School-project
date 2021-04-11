<?php
    session_start();

    require_once "../partials/db.php";

    $emailErr = "";

    if(isset($_POST['register-btn'])) {

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $idNumber = $_POST['idNumber'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        $connect = new mysqli($host, $db_user, $db_password, $db_name);

        if($connect && !empty($name) && !empty($surname) && !empty($email) && !empty($name) && !empty($idNumber) && !empty($password) && !empty($password2)) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql_email = "SELECT * FROM klienci WHERE Email = '$email'";
                $res_email = mysqli_query($connect, $sql_email);
                if(mysqli_num_rows($res_email) == 0) {
                    if($password == $password2) {
                        if($uppercase && $lowercase && $number && strlen($password) >= 8) {
                            $password = hash('sha256', $password);
                            $sql = "INSERT INTO `klienci` (`Id_klienta`, `Imie`, `Nazwisko`, `Pesel`, `Email`, `Haslo`) VALUES (NULL, '$name', '$surname', '$idNumber', '$email', '$password')";
                            mysqli_query($connect, $sql);
                            $_SESSION['message'] = "Pomyślnie zarejestrowano";
                            header('location: /index.php');
                            // echo $connect->affected_rows;
                            // echo $sql;
                            $_SESSION['email'] = $email;
                        } else {
                            $_SESSION['message'] = "Hasła muszą zawierać przynajmniej jedną dużą oraz małą literę, oraz muszą zawierać co najmniej jedną cyfrę";
                            echo "Hasła muszą zawierać przynajmniej jedną dużą oraz małą literę, oraz muszą zawierać co najmniej jedną cyfrę";
                        }
                    } else {
                        $_SESSION['message'] = "Hasła nie pasują";
                        echo "Hasła nie pasują";
                    }
                } else {
                    $emailErr = "Taki adres email już istnieje";
                }
            } else {
                $emailErr = "Wpisz poprawną formę adresu email";
            }
            $connect->close();
        } else {
            echo "Error: $connect->connect_errno";
        }
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
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="post" class="login-form">
                        <h2 class="login-heading">ZAREJESTRUJ SIĘ</h2>
                        <label for="name"></label>
                        <input type="text" placeholder="Podaj imię" class="login-input" name="name">
                        <label for="surname"></label>
                        <input type="text" placeholder="Podaj nazwisko" class="login-input" name="surname">
                        <label for="idNumber"></label>
                        <input type="text" placeholder="Podaj pesel" class="login-input" name="idNumber">
                        <label for="email"></label>
                        <input type="email" placeholder="Podaj email" class="login-input" name="email"><span class="error"><?php echo $emailErr;?></span>
                        <label for="password"></label>
                        <input type="password" placeholder="Podaj hasło" class="login-input"  name="password">
                        <label for="password2"></label>
                        <input type="password" placeholder="Podaj ponownie hasło" class="login-input"  name="password2">
                        <button type="submit" name="register-btn" class="main-button">ZAREJESTRUJ</button>
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
    <script src="/public/js/script.js"></script>
</body>
</html>