<?php
require_once __DIR__ . '/vendor/autoload.php';

$nomePaziente = $_REQUEST['paziente'];
$posizione = $_REQUEST['pos'];
$immagine = $_REQUEST['img'];
$note = $_REQUEST['note'];

var_dump($nomePaziente);
var_dump($posizione);
var_dump($immagine);
var_dump($note);

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Paziente:'.$nomePaziente.'</h1>');

$arrayL = count($posizione);
$html = "";
for($i = 0; $i < $arrayL; $i++){
    $html .= <<<HTML
<div>
<h2>Posizione Impianto: $posizione[$i]</h2>
<img src="$immagine[$i]" />
<p>$note[$i]</p>
</div>
<hr style="border:1px solid black; margin-bottom:15px;" />
HTML;
}

$mpdf->WriteHTML($html);

$mpdf->Output();
