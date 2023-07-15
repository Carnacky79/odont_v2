<?php
require __DIR__ . '/vendor/autoload.php';
/*
 * offset 9 - y 230
 * offset 10 - y 207
 * offset 11 - y 184
 */
use PHPImageWorkshop\ImageWorkshop;

$lunghezza = $_REQUEST['lunghezza'];
$impiantoPath = "img/impianto_" . $lunghezza . "@4x.png";
$impiantoLayer = ImageWorkshop::initFromPath($impiantoPath);

$offset = $_REQUEST['offset'];
$offset = (int)$offset;

$pilots = $_REQUEST['pilot'];

$pilotGroup = ImageWorkshop::initVirginLayer(1015, 850);

$layerLevel = 1;
$positionX = 0;
foreach($pilots as $p){
    $pilotPath = "img/PILOT_" . $p . "@4x.png";
    $pilotLayer = ImageWorkshop::initFromPath($pilotPath);
    $pilotGroup->addLayer($layerLevel++, $pilotLayer, $positionX);
    $positionX += 175;
}

$mountToggle = $_REQUEST['mountToggle'];
if($mountToggle == 1){
    $mount = $_REQUEST['mount'];
    switch ((int)$mount){
        case 9:
            $mountPath = "img/MOUNT_9@4x.png";
            break;
        case 10:
            $mountPath = "img/MOUNT_10@4x.png";
            break;
        case 11:
            $mountPath = "img/MOUNT_11@4x.png";
            break;
        case 13:
            $mountPath = "img/MOUNT_13@4x.png";
            break;
    }

    $layerMount = ImageWorkshop::initFromPath($mountPath);

}

switch($offset){
    case 9:
        $offsetPath = "img/Offset_9@4x.png";
        $offsetY = 230;
        $pilotY = 115;
        break;
    case 10:
        $offsetPath = "img/Offset_10@4x.png";
        $offsetY = 207;
        $pilotY = 92;
        break;
    case 11:
        $offsetPath = "img/Offset_11@4x.png";
        $offsetY = 184;
        $pilotY = 69;
        break;
    case 13:
        $offsetPath = "img/Offset_13@4x.png";
        $offsetY = 139;
        $pilotY = 23;
        break;
}

$document = ImageWorkshop::initFromPath("img/Tessuto_Gengivale@4x.png");

$layerBase = ImageWorkshop::initFromPath("img/Schema_Base@4x.png");

$layerOffset = ImageWorkshop::initFromPath($offsetPath);


$document->addLayer(1, $layerBase);
if($mountToggle == 1)
    $document->addLayer(2, $layerMount, 2180, 112);

$document->addLayer(4, $pilotGroup, 630, $pilotY);
$document->addLayer(3, $layerOffset, 0, $offsetY);
$document->addLayer(5, $impiantoLayer, 2193, 465);

$image = $document->getResult("ffffff");

header('Content-type: image/jpeg');

imagejpeg($image, null, 95); // We choose to show a JPEG with a quality of 95%




