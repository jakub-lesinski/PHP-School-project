<?php 
    session_start();
    
    require_once "../partials/db.php";

    $connect = new mysqli($host, $db_user, $db_password, $db_name);

    if($connect) {
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
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-heading">KONTAKT</h2>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="map" id="gmap_canvas" src="https://maps.google.com/maps?q=Ogrodowa%2010%20prze%C5%BAmierowo&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://embedgooglemap.net/maps/6"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">google maps iframe options</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="contact-content">
                        <p class="contact-desc">62-081 Przeźmierowo</p>
                        <p class="contact-desc">Ogrodowa 10</p>
                        <div class="contact-cycle">
                        <p class="contact-desc">Godziny otwarcia:</p>
                        <p class="contact-desc">Pon-pt: 9-17</p>
                        </div>
                        <a href="tel:792-882-508" class ="contact-link">
                            <i class="fas fa-phone-alt"></i>
                            <p class="contact-desc">+48 792 882 508</p>
                        </a>
                        <a href="mailto:jakub.lesinski@uczen.zsk.poznan.pl" class="contact-link">
                            <i class="fas fa-envelope"></i>
                            <p class="contact-desc">jakub.lesinski@uczen.zsk.poznan.pl</p>
                        </a>

                        <h3 class="contact-form-heading">
                            Masz pytania?
                            </br>
                            Napisz do nas!
                        </h3>
                        <form method="post">
                            <div class="contact-form">
                                <label for="email"></label>
                                <input type="email" class="contact-input" name="email" placeholder="E-mail" oninvaild="this.classList.add='contact-input:invalid';" required>
                                <label for="subject"></label>
                                <input type="text" class="contact-input" placeholder="Temat" name="subject" required>
                                <label for="Message"></label>
                                <textarea class="textarea" placeholder="Treść wiadomości" name="message" required></textarea>
                            </div>
                            <button class="main-button contact-button" name="send-btn">WYŚLIJ</button>
                        </form>
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
    <script src="/public/js/swiper-bundle.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/script.js"></script>
</body>
</html>