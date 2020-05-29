<?php
    //Manage session
    $id = $_REQUEST["id"];
    session_start();
    if (isset($_SESSION["cesta"])) {
        $cesta = $_SESSION["cesta"];
        $cesta = array_diff($cesta,[$id]);
        $_SESSION["cesta"]=$cesta;
    }
    header("refresh:0; url=../cesta.php");
?>