<?php
session_start();
$tmpPref = $_SESSION['prefpath'];

$prefFile = fopen("db/pref.txt", "r") or die("Unable to open file!");

while (!feof($prefFile)) {
    $lines[] = fgets($prefFile);
}
fclose($prefFile);

foreach ($lines as $l){
echo $l . "<br>" . strlen(trim($l)) . "<hr>";
    if(strcmp(trim($l), trim($tmpPref)) == 0){
        //unlink($tmpPref);
    }else{
        if(strlen($l)>2)
            $newLines[] = $l;
    }
}

$prefFile = fopen("db/pref.txt", "w") or die("Unable to open file!");
foreach($newLines as $n){
    fwrite($prefFile, $n);
}
fclose($prefFile);

//$prefFile = fopen("db/pref.txt", "w") or die("Unable to open file!");
//fwrite($prefFile, $newText);
//fclose($prefFile);
