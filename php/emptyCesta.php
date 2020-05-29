<?php 
    session_start();
    if (isset($_SESSION["cesta"])) {
            unset($_SESSION['cesta']);
    }
    header("refresh:2; url=../index.html");
?>