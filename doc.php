<?php
session_start();

if(isset($_SESSION['prefpath'])){
    $imgToAdd = $_SESSION['prefpath'];
}

if(isset($_SESSION['nomeimp'])){
    $imgToAdd = "img/tmp/".$_SESSION['nomeimp'].".png";
}

echo $imgToAdd;
