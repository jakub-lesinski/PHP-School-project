<?php
    session_start();
    $_SESSION['logged'] = '';
    session_destroy();
    header('location: /index.php');
    ?>
