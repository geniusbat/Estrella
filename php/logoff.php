<?php
    session_start();
    if (isset($_SESSION["admin"])) {
        $_SESSION["admin"]=0;
        header("refresh:1; url=../index.html");
    }
?>