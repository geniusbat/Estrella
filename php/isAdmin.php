<?php 

function isAdmin() {
    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"]==1){
            return true;

        }
        else {
            header("refresh:0; url=../index.html");
            return false;
        }
    }
    else {
        $_SESSION["admin"]=0;
        header("refresh:0; url=../index.html");
        return false;
    }
}
?>