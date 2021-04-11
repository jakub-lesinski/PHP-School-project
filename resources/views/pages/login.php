<?php
    session_start();
    require_once "../partials/db.php";

    $emailErr = "";

    if(isset($_POST['login-btn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = hash('sha256', $password);
        $connect = new mysqli($host, $db_user, $db_password, $db_name);
        
        if($connect) {
            if(!empty($email) && !empty($password)) {

                $sql = "SELECT * FROM klienci WHERE Email = '$email' AND haslo = '$password'";
                $result = mysqli_query($connect, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if($email ==$row['Email']) {
                    if($password == $row['Haslo']) {
                        $_SESSION['logged'] = $row['Id_klienta'];
                        header('location: /index.php');
                    } else {
                        echo "złe hasło";
                    }
                } else {
                    echo "zły adres email";
                }
            } else {
                echo "Podaj dane do logowania";
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
                        <h2 class="login-heading">ZALOGUJ SIĘ</h2>
                        <label for="email"></label>
                        <span class="error"><?php echo $emailErr;?></span>
                        <input type="text" placeholder="Podaj email" class="login-input" name="email">
                        <label for="password"></label>
                        <input type="password" placeholder="Podaj hasło" class="login-input" name="password">
                        <button type="submit" value="zaloguj" name="login-btn" class="main-button">ZALOGUJ</button>
                        <a href="register.php" class="login-link"><p class="login-desc">Nie masz konta. Zarejestruj się tutaj.</p></a>
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