<?php
    session_start();
if (isset($_SESSION["cesta"])) {

    $cesta = $_SESSION["cesta"];
    echo "     ELEMENTOS:  ";
    foreach($cesta as $ele) {
        echo($ele);
        echo",";
    }
}
?>