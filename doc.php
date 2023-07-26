<?php
session_start();

if(isset($_SESSION['prefpath'])){
    $imgToAddPath = $_SESSION['prefpath'];
    $imgToAdd = substr($imgToAddPath, 9);
}

if(isset($_SESSION['nomeimp'])){
    $imgToAddPath = "img/tmp/".$_SESSION['nomeimp'].".png";
    $imgToAdd = $_SESSION['nomeimp'].".png";
}

$docFolder = "img/doc/".$imgToAdd;
$docTxt = "db/doc.txt";

if (!copy($imgToAddPath, $docFolder)) {
    echo "Errore nel salvare l'impianto nel documento";
}else{
    clearstatcache();
    if(filesize($docTxt)) {
        $docFile = fopen($docTxt, "a") or die("Unable to open file!");
        fwrite($docFile, PHP_EOL.$docFolder);
        fclose($docFile);
    }else{
        $docFile = fopen($docTxt, "w") or die("Unable to open file!");
        fwrite($docFile, $docFolder);
        fclose($docFile);
    }
}

