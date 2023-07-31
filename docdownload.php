<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$nomePaziente = $_SESSION['paziente'] ?? $_REQUEST['paziente'];
$posizione = $_REQUEST['pos'];
$immagine = $_REQUEST['img'];
$note = $_REQUEST['note'];

var_dump($nomePaziente);
var_dump($posizione);
var_dump($immagine);
var_dump($note);

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h2 style="margin-bottom:0">Paziente: '.$nomePaziente.'</h2>');

$arrayL = count($posizione);
$html = "";
for($i = 0; $i < $arrayL; $i++){
    $html .= <<<HTML
<div>
<h3 style="margin-top:15px;">Posizione Impianto: $posizione[$i]</h3>
<img src="$immagine[$i]" />
<p>$note[$i]</p>
</div>
<hr style="border:1px solid black; margin-bottom:15px;" />
HTML;
}

$mpdf->WriteHTML($html);

$mpdf->Output();
