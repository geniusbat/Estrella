<?php
    //Manage session
    $id = $_POST["id"];
    session_start();
    echo $id;
    if (!isset($_SESSION["cesta"])) {
        $cesta = array($id);
        $_SESSION["cesta"]=$cesta;
    }
    else {
        $cesta = $_SESSION["cesta"];
        array_push($cesta,$id);
        $_SESSION["cesta"]=$cesta;
    }
    echo "     ELEMENTOS:  ";
    foreach($cesta as $ele) {
        echo($ele);
        echo",";
    }
    header("refresh:2; url=../productos.php");
?>