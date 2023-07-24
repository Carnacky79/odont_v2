<?php
session_start();
$tmpPref = $_SESSION['prefpath'];

$prefFile = fopen("db/pref.txt", "r") or die("Unable to open file!");

while (!feof($prefFile)) {
    $lines[] = fgets($prefFile);
}
fclose($prefFile);

foreach ($lines as $l){

    if(strcmp(trim($l), trim($tmpPref)) == 0){
        //unlink($tmpPref);
    }else{
        $newLines[] = $l;
    }
}

$newText = "";
foreach($newLines as $n){

        $newText .= $n."\n";
}

var_dump($newText);

/*
$prefFile = fopen("db/pref.txt", "w") or die("Unable to open file!");
fwrite($prefFile, $newText);
fclose($prefFile);
*/