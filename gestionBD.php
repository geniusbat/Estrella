<?php 
function iniciaConexion() {
    try {
        //Set up connection
        $conDB = new PDO("oci:dbname=localhost/XE","GUSMOLAGU","root");
        $conDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conDB;
    }
    catch (PDOException $e) {
        $f = fopen("/etc/errors.txt","w");
        fwrite($f,$e->getMessage());
        fclose($f);
    }
}

function cierraConexion($conDB) {
    $conDB = null;
}
?>