<?php
session_start();

$impianto = $_SESSION['nomeimp'];

$prefTxt = "db/pref.txt";

$tmpImp = "img/tmp/".$impianto.".png";

$prefImp = "img/pref/".$impianto.".png";

if (!copy($tmpImp, $prefImp)) {
    echo "Errore nel salvare l'impianto";
}else{
    clearstatcache();
    if(filesize($prefTxt)) {
        $prefFile = fopen($prefTxt, "a") or die("Unable to open file!");
        fwrite($prefFile, PHP_EOL.$prefImp);
        fclose($prefFile);
    }else{
        $prefFile = fopen($prefTxt, "w") or die("Unable to open file!");
        fwrite($prefFile, $prefImp);
        fclose($prefFile);
    }
}
