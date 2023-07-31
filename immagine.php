<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

/*
 * offset 9 - y 230
 * offset 10 - y 207
 * offset 11 - y 184
 */
use PHPImageWorkshop\ImageWorkshop;

$_SESSION['paziente'] = $_REQUEST['paziente'];
$lunghezza = $_REQUEST['lunghezza'];
$lunghezzaText = ImageWorkshop::initTextLayer("Lunghezza: ".$lunghezza, "img/arial_bold.ttf",20, "000000");
$impiantoPath = "img/impianto_" . (int)$lunghezza . "@4x.png";
$impiantoLayer = ImageWorkshop::initFromPath($impiantoPath);

$offset = $_REQUEST['offset'];
$offsetText = ImageWorkshop::initTextLayer("Offset:         ".$offset, "img/arial_bold.ttf",20, "000000");

$apexText = ImageWorkshop::initTextLayer("Apex:          ".$_REQUEST['apex'], "img/arial_bold.ttf",20, "000000");

$diamText = ImageWorkshop::initTextLayer("Diametro:    ".$_REQUEST['diametro'], "img/arial_bold.ttf",20, "000000");

$textGroupDesc = ImageWorkshop::initVirginLayer(300, 250, null);

$textGroupDesc->addLayer(1, $offsetText, 0, 20);
$textGroupDesc->addLayer(1, $diamText, 0, 60);
$textGroupDesc->addLayer(1, $apexText, 0, 100);
$textGroupDesc->addLayer(1, $lunghezzaText, 0, 140);

$pilots = $_REQUEST['pilot'];

$pilotGroup = ImageWorkshop::initVirginLayer(1015, 850);

$textGroup = ImageWorkshop::initVirginLayer(2480, 275, null);

$layerLevel = 1;
$positionX = 0;
foreach($pilots as $p){
    $pilotPath = "img/PILOT_" . $p . "@4x.png";
    $pilotLayer = ImageWorkshop::initFromPath($pilotPath);
    $pilotGroup->addLayer($layerLevel, $pilotLayer, $positionX);


    $pilotText = ImageWorkshop::initTextLayer("PILOT\n   ".$p, "img/arial.ttf",26, "000000");
    $textGroup->addLayer($layerLevel++, $pilotText, $positionX + 770);

    $positionX += 175;
}

$mountToggle = $_REQUEST['mountToggle'];
if($mountToggle == 1){
    $mText = " MOUNT\n";
    $mount = $_REQUEST['mount'];
    switch ((int)$mount){
        case 9:
            $mountPath = "img/MOUNT_9@4x.png";
            $mText .= "GM-M 9";
            break;
        case 10:
            $mountPath = "img/MOUNT_10@4x.png";
            $mText .= "GM-M 10";
            break;
        case 11:
            $mountPath = "img/MOUNT_11@4x.png";
            $mText .= "GM-M 11";
            break;
        case 13:
            $mountPath = "img/MOUNT_13@4x.png";
            $mText .= "GM-M 13";
            break;
    }

    $layerMount = ImageWorkshop::initFromPath($mountPath);
    $mountText = ImageWorkshop::initTextLayer($mText, "img/arial.ttf",26, "000000");
    $textGroup->addLayer(10, $mountText, 2320);
}

switch((int)$offset){
    case 9:
        $offsetPath = "img/Offset_9@4x.png";
        $offsetY = 230;
        $pilotY = 115;
        $tissueY = 113;
        $boneY = $startY = 112;
        $tipY = $finalSY = 18;
        $finalLY = -27;
        break;
    case 10:
        $offsetPath = "img/Offset_10@4x.png";
        $offsetY = 207;
        $pilotY = 92;
        $tissueY = 90;
        $boneY = $startY = 89;
        $tipY = $finalSY = -6;
        $finalLY = -52;
        break;
    case 11:
        $offsetPath = "img/Offset_11@4x.png";
        $offsetY = 184;
        $pilotY = 69;
        $tissueY = 67;
        $boneY = $startY = 66;
        $tipY = $finalSY = -27;
        $finalLY = -72;
        break;
    case 13:
        $offsetPath = "img/Offset_13@4x.png";
        $offsetY = 139;
        $pilotY = 23;
        $tissueY = 21;
        $boneY = $startY = 20;
        $tipY = $finalSY = -73;
        $finalLY = -118;
        break;
}

$offsetXGen = 156;
$offsetYGen = 274;
$document = ImageWorkshop::initVirginLayer(2700, 1150, "ffffff");

$layerTessuto = ImageWorkshop::initFromPath("img/Tessuto_Gengivale@4x.png");

$document->addLayer(-1, $layerTessuto, $offsetXGen, $offsetYGen);

$layerBase = ImageWorkshop::initFromPath("img/Schema_Base@4x.png");

$layerOffset = ImageWorkshop::initFromPath($offsetPath);

if(isset($_REQUEST['tip'])) {
    $tip = $_REQUEST['tip'];
    $tipInt = (int)substr($tip, strlen($tip)-2);
    $tipLayer = ImageWorkshop::initFromPath("img/TIP@4x.png");
    switch ($tipInt) {
        case 6:
            break;
        case 8:
            $tipY += 43;
            break;
        case 10:
            $tipY += 88;
            break;
    }

    $tText = "      TIP\n".strtoupper($tip);
    $tipText = ImageWorkshop::initTextLayer($tText, "img/arial.ttf",26, "000000");
    $textGroup->addLayer(10, $tipText, 1780, 40);
}

if(isset($_REQUEST['final10'])) {
    $finalS = $_REQUEST['final10'];
    $finalSInt = (int)substr($finalS, strlen($finalS)-2);
    $finalSLayer = ImageWorkshop::initFromPath("img/FINAL_Short@4x.png");
    switch ($finalSInt) {
        case 6:
            break;
        case 8:
            $finalSY += 43;
            break;
        case 10:
            $finalSY += 88;
            break;
    }

    $fsText = " FINAL  S\n".strtoupper($finalS);
    $finalSText = ImageWorkshop::initTextLayer($fsText, "img/arial.ttf",26, "000000");
    $textGroup->addLayer(10, $finalSText, 1970);
}

if(isset($_REQUEST['final16'])) {
    $finalL = $_REQUEST['final16'];
    $finalLInt = (int)substr($finalL, strlen($finalL)-2);
    $finalLLayer = ImageWorkshop::initFromPath("img/FINAL_Long@4x.png");
    switch ($finalLInt) {
        case 10:
            break;
        case 12:
            $finalLY += 45;
            break;
        case 14:
            $finalLY += 90;
            break;
        case 16:
            $finalLY += 135;
            break;
    }

    $flText = " FINAL  L\n".strtoupper($finalL);
    $finalLText = ImageWorkshop::initTextLayer($flText, "img/arial.ttf",26, "000000");
    $textGroup->addLayer(10, $finalLText, 2140, 40);
}


if(isset($mountToggle) && $mountToggle == 1)
    $document->addLayer(2, $layerMount, 2180 + $offsetXGen, 112 + $offsetYGen);

$document->addLayer(4, $pilotGroup, 615 + $offsetXGen, $pilotY + $offsetYGen);

$document->addLayer(5, $impiantoLayer, 2193 + $offsetXGen, 465 + $offsetYGen);

if(isset($_REQUEST['tissue']) && $_REQUEST['tissue'] == 1) {
    $tissueLayer = ImageWorkshop::initFromPath("img/PUNCH@4x.png");
    $document->addLayer(6, $tissueLayer, 110 + $offsetXGen, $tissueY + $offsetYGen);
    $punchText = ImageWorkshop::initTextLayer("PUNCH", "img/arial.ttf",26, "000000");
    $textGroup->addLayer(10, $punchText, 240, 120);
}

if(isset($_REQUEST['bone']) && $_REQUEST['bone'] == 1) {
    $boneLayer = ImageWorkshop::initFromPath("img/BONE_FLATTENER@4x.png");
    $document->addLayer(7, $boneLayer, 275 + $offsetXGen, $boneY + $offsetYGen);
    $boneText = ImageWorkshop::initTextLayer("     BONE\nFLATTENER", "img/arial.ttf",26, "000000");
    $textGroup->addLayer(10, $boneText, 380, 40);
}

if(isset($_REQUEST['start']) && $_REQUEST['start'] == 1) {
    $startLayer = ImageWorkshop::initFromPath("img/START@4x.png");
    $document->addLayer(7, $startLayer, 442 + $offsetXGen, $startY + $offsetYGen);
    $startText = ImageWorkshop::initTextLayer("START", "img/arial.ttf",26, "000000");
    $textGroup->addLayer(10, $startText, 590);
}

if(isset($_REQUEST['tip']))
    $document->addLayer(8, $tipLayer, 1660 + $offsetXGen, $tipY + $offsetYGen);

if(isset($_REQUEST['final10']))
    $document->addLayer(9, $finalSLayer, 1840 + $offsetXGen, $finalSY + $offsetYGen);

if(isset($_REQUEST['final16']))
    $document->addLayer(10, $finalLLayer, 2020 + $offsetXGen, $finalLY + $offsetYGen);

$document->addLayer(11, $layerOffset, 0 + $offsetXGen, $offsetY + $offsetYGen);
$document->addLayer(20, $layerBase, $offsetXGen, $offsetYGen);
$document->addLayer(30, $textGroup, 0, 80);
$document->addLayer(40, $textGroupDesc, 10, 0, "LT");

$nomeImpianto = $_REQUEST['nomeimp'];
$impiantoText = ImageWorkshop::initTextLayer("Impianto: ".strtoupper($nomeImpianto), "img/arial.ttf",30, "000000");
$document->addLayer(40, $impiantoText, -($impiantoText->getWidth()/2), 10, "MT");

$image = $document->getResult("ffffff");


$_SESSION['nomeimp'] = $nomeImpianto;
$dirPath = "img/tmp";
$filename =  $nomeImpianto . ".png";
$createFolders = true;
$backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
$imageQuality = 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

$document->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

//header('Content-type: image/jpeg');

//imagejpeg($image, null, 95); // We choose to show a JPEG with a quality of 95%
header("location: download.php");




