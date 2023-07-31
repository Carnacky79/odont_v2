<?php
session_start();
//session_destroy();
unset($_SESSION['nomeimp'], $_SESSION['prefpath']);
$prefDir = 'img/pref';
$prefImgs = array_diff(scandir($prefDir), array('..', '.'));
if(isset($_SERVER['HTTP_REFERER'])) {
    if (str_contains($_SERVER['HTTP_REFERER'], "docview")) {
        $file = fopen('db/doc.txt', 'w');
        ftruncate($file, 0);
        fclose($file);

        foreach (glob('img/doc' . '/*') as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        foreach (glob('img/tmp' . '/*') as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        unset($_SESSION['paziente']);
    }

}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/s4.png" type="image/x-icon">

    <title>Odont v.2</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
          rel="stylesheet"/>
    <!-- nice select -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
          integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous"/>
    <!-- datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet"/>
</head>

<body>
<div class="hero_area" style="min-height: 0">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.php">
                    <h3>
                        Odont v.2
                    </h3>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </nav>
        </div>
    </header>
    <!-- end header section -->

</div>


<section class="book_section layout_padding">
    <div class="container">
        <div class="flex-row" style="margin-bottom: 10px">
            <div class="col" style="display: flex; justify-content: center">
                    <img style="margin: auto; height: 140px" src="images/Logo_SNUC.png" />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post" action="immagine.php">
                    <h4>
                        <span class="design_dot"></span>
                        <span style="font-variant: small-caps">Preferiti</span>
                    </h4>
                    <?php
                        if($prefImgs){
                            foreach ($prefImgs as $i){
                                echo <<<HTML
                    <div class="form-row ">
                        <div class="form-group col-6">
                            <a href="imgpreferiti.php?img=$i">$i</a>
                        </div>
                    </div>
HTML;
                            }
                        }else{
                            echo <<<HTML
                    <div class="form-row ">
                        <div class="form-group col-lg-6">
                            Non sono presenti impianti preferiti
                        </div>
                    </div>
HTML;

                        }
                    ?>
                    <?php
                    if(!isset($_SESSION['paziente'])){
                    ?>

                    <div class="form-row" style="margin-top: 20px; border-top: 1px solid black;padding-top: 5px"">
                        <div class="form-group col-lg-4 offset-lg-4" style="padding-top:15px;">
                            <label for="paziente">Nome Paziente</label>
                            <input type="text" class="form-control" id="paziente" name="paziente" required="required">
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <h4 style="margin-top: 20px; border-top: 1px solid black;padding-top: 5px">
                        <span class="design_dot"></span>
                        <span style="font-variant: small-caps">Scegli Impianto</span>
                    </h4>
                    <div class="form-row ">
                        <div class="form-group col-lg-6">
                            <label for="nomeimp">Nome Impianto</label>
                            <input type="text" class="form-control" id="nomeimp" name="nomeimp" required="required">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-lg-3">
                            <label for="offset">Offset</label>
                            <input type="text" class="form-control" id="offset" name="offset" required="required">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="diametro">Diametro</label>
                            <input type="text" class="form-control" id="diametro" name="diametro" required="required">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="apex">Apex</label>
                            <input type="text" class="form-control" id="apex" name="apex" required="required">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="lunghezza">Lunghezza</label>
                            <input type="text" class="form-control" id="lunghezza" name="lunghezza" required="required">
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-lg-4 custom-control-inline custom-checkbox"
                             style="justify-content: center; margin-right: 0">
                            <input class="custom-control-input" type="checkbox" id="tissue" name="tissue" value="1" checked="checked">
                            <label class="custom-control-label" for="tissue">Tissue Punch</label>
                        </div>
                        <div class="col-lg-4 custom-control-inline custom-checkbox"
                             style="justify-content: center; margin-right: 0">
                            <input class="custom-control-input" type="checkbox" id="bone" name="bone" value="1" checked="checked">
                            <label class="custom-control-label" for="bone">Bone Flattener</label>
                        </div>
                        <div class="col-lg-4 custom-control-inline custom-checkbox"
                             style="justify-content: center; margin-right: 0">
                            <input class="custom-control-input" type="checkbox" id="start" name="start" value="1" checked="checked">
                            <label class="custom-control-label" for="start">Start</label>
                        </div>
                    </div>
                    <fieldset style="border: 1px solid dodgerblue; padding-bottom: 25px">
                        <legend style="width: auto">Pilot</legend>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="pilot6" name="pilot[]" value="6">
                                <label class="custom-control-label" for="pilot6">Pilot 6</label>
                            </div>
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="pilot8" name="pilot[]" value="8">
                                <label class="custom-control-label" for="pilot8">Pilot 8</label>
                            </div>
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="pilot10" name="pilot[]"
                                       value="10">
                                <label class="custom-control-label" for="pilot10">Pilot 10</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="pilot12" name="pilot[]"
                                       value="12">
                                <label class="custom-control-label" for="pilot12">Pilot 12</label>
                            </div>
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="pilot14" name="pilot[]"
                                       value="14">
                                <label class="custom-control-label" for="pilot14">Pilot 14</label>
                            </div>
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="pilot16" name="pilot[]" value="16">
                                <label class="custom-control-label" for="pilot16">Pilot 16</label>
                            </div>
                        </div>
                        <div class="form-row" id="reset-pilot">
                            <div class="col custom-control-inline"
                                 style="justify-content: center; margin-right: 0; margin-top: 20px;">
                                <button type="button" class="btn-outline-info" id="btn-pilot" onclick="resetCheck('pilot[]', this)">Reset Pilot</button>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset style="border: 1px solid dodgerblue; padding-bottom: 25px">
                        <legend style="width: auto">Tip</legend>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-2906" name="tip"
                                       value="gttd-2906">
                                <label class="custom-control-label" for="gttd-2906">GTTD-2906</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-2908" name="tip"
                                       value="gttd-2908">
                                <label class="custom-control-label" for="gttd-2908">GTTD-2908</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-2910" name="tip"
                                       value="gttd-2910">
                                <label class="custom-control-label" for="gttd-2910">GTTD-2910</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3206" name="tip"
                                       value="gttd-3206">
                                <label class="custom-control-label" for="gttd-3206">GTTD-3206</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3208" name="tip"
                                       value="gttd-3208">
                                <label class="custom-control-label" for="gttd-3208">GTTD-3208</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3210" name="tip"
                                       value="gttd-3210">
                                <label class="custom-control-label" for="gttd-3210">GTTD-3210</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3506" name="tip"
                                       value="gttd-3506">
                                <label class="custom-control-label" for="gttd-3506">GTTD-3506</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3508" name="tip"
                                       value="gttd-3508">
                                <label class="custom-control-label" for="gttd-3508">GTTD-3508</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3510" name="tip"
                                       value="gttd-3510">
                                <label class="custom-control-label" for="gttd-3510">GTTD-3510</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3806" name="tip"
                                       value="gttd-3806">
                                <label class="custom-control-label" for="gttd-3806">GTTD-3806</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3808" name="tip"
                                       value="gttd-3808">
                                <label class="custom-control-label" for="gttd-3808">GTTD-3808</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-3810" name="tip"
                                       value="gttd-3810">
                                <label class="custom-control-label" for="gttd-3810">GTTD-3810</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-4006" name="tip"
                                       value="gttd-4006">
                                <label class="custom-control-label" for="gttd-4006">GTTD-4006</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-4008" name="tip"
                                       value="gttd-4008">
                                <label class="custom-control-label" for="gttd-4008">GTTD-4008</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-4010" name="tip"
                                       value="gttd-4010">
                                <label class="custom-control-label" for="gttd-4010">GTTD-4010</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-4506" name="tip"
                                       value="gttd-4506">
                                <label class="custom-control-label" for="gttd-4506">GTTD-4506</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-4508" name="tip"
                                       value="gttd-4508">
                                <label class="custom-control-label" for="gttd-4508">GTTD-4508</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" id="gttd-4510" name="tip"
                                       value="gttd-4510">
                                <label class="custom-control-label" for="gttd-4510">GTTD-4510</label>
                            </div>
                        </div>
                        <div class="form-row" id="reset-tip">
                            <div class="col custom-control-inline"
                                 style="justify-content: center; margin-right: 0; margin-top: 20px;">
                                <button type="button" class="btn-outline-info" id="btn-tip" onclick="resetCheck('tip', this)">Reset Tip</button>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset style="border: 1px solid dodgerblue; padding-bottom: 25px">
                        <legend style="width: auto">Final S</legend>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-2906"
                                       id="gtd-2906">
                                <label class="custom-control-label" for="gtd-2906">GTD-2906</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-2908"
                                       id="gtd-2908">
                                <label class="custom-control-label" for="gtd-2908">GTD-2908</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-2910"
                                       id="gtd-2910">
                                <label class="custom-control-label" for="gtd-2910">GTD-2910</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3206"
                                       id="gtd-3206">
                                <label class="custom-control-label" for="gtd-3206">GTD-3206</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3208"
                                       id="gtd-3208">
                                <label class="custom-control-label" for="gtd-3208">GTD-3208</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3210"
                                       id="gtd-3210">
                                <label class="custom-control-label" for="gtd-3210">GTD-3210</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3506"
                                       id="gtd-3506">
                                <label class="custom-control-label" for="gtd-3506">GTD-3506</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3508"
                                       id="gtd-3508">
                                <label class="custom-control-label" for="gtd-3508">GTD-3508</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3510"
                                       id="gtd-3510">
                                <label class="custom-control-label" for="gtd-3510">GTD-3510</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3806"
                                       id="gtd-3806">
                                <label class="custom-control-label" for="gtd-3806">GTD-3806</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3808"
                                       id="gtd-3808">
                                <label class="custom-control-label" for="gtd-3808">GTD-3808</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-3810"
                                       id="gtd-3810">
                                <label class="custom-control-label" for="gtd-3810">GTD-3810</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-4006"
                                       id="gtd-4006">
                                <label class="custom-control-label" for="gtd-4006">GTD-4006</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-4008"
                                       id="gtd-4008">
                                <label class="custom-control-label" for="gtd-4008">GTD-4008</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-4010"
                                       id="gtd-4010">
                                <label class="custom-control-label" for="gtd-4010">GTD-4010</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-4506"
                                       id="gtd-4506">
                                <label class="custom-control-label" for="gtd-4506">GTD-4506</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-4508"
                                       id="gtd-4508">
                                <label class="custom-control-label" for="gtd-4508">GTD-4508</label>
                            </div>

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final10" value="gtd-4510"
                                       id="gtd-4510">
                                <label class="custom-control-label" for="gtd-4510">GTD-4510</label>
                            </div>
                        </div>
                        <div class="form-row" id="reset-final10">
                            <div class="col custom-control-inline"
                                 style="justify-content: center; margin-right: 0; margin-top: 20px;">
                                <button type="button" class="btn-outline-info" id="btn-final10" onclick="resetCheck('final10', this)">Reset Final 10</button>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset style="border: 1px solid dodgerblue; padding-bottom: 25px">
                        <legend style="width: auto">Final L</legend>
                        <div class="form-row ">

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-2910"
                                       id="16-gtd-2910">
                                <label class="custom-control-label" for="16-gtd-2910">GTD-2910</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-2912"
                                       id="16-gtd-2912">
                                <label class="custom-control-label" for="16-gtd-2912">GTD-2912</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-2914"
                                       id="16-gtd-2914">
                                <label class="custom-control-label" for="16-gtd-2914">GTD-2914</label>
                            </div>
                        </div>
                        <div class="form-row ">

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-2916"
                                       id="16-gtd-2916">
                                <label class="custom-control-label" for="16-gtd-2916">GTD-2916</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3210"
                                       id="16-gtd-3210">
                                <label class="custom-control-label" for="16-gtd-3210">GTD-3210</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3212"
                                       id="16-gtd-3212">
                                <label class="custom-control-label" for="16-gtd-3212">GTD-3212</label>
                            </div>
                        </div>
                        <div class="form-row ">

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3214"
                                       id="16-gtd-3214">
                                <label class="custom-control-label" for="16-gtd-3214">GTD-3214</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3216"
                                       id="16-gtd-3216">
                                <label class="custom-control-label" for="16-gtd-3216">GTD-3216</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3510"
                                       id="16-gtd-3510">
                                <label class="custom-control-label" for="16-gtd-3510">GTD-3510</label>
                            </div>
                        </div>
                        <div class="form-row ">

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3512"
                                       id="16-gtd-3512">
                                <label class="custom-control-label" for="16-gtd-3512">GTD-3512</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3514"
                                       id="16-gtd-3514">
                                <label class="custom-control-label" for="16-gtd-3514">GTD-3514</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3516"
                                       id="16-gtd-3516">
                                <label class="custom-control-label" for="16-gtd-3516">GTD-3516</label>
                            </div>
                        </div>
                        <div class="form-row ">

                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3810"
                                       id="16-gtd-3810">
                                <label class="custom-control-label" for="16-gtd-3810">GTD-3810</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3812"
                                       id="16-gtd-3812">
                                <label class="custom-control-label" for="16-gtd-3812">GTD-3812</label>
                            </div>


                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3814"
                                       id="16-gtd-3814">
                                <label class="custom-control-label" for="16-gtd-3814">GTD-3814</label>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-lg-4 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="final16" value="gtd-3816"
                                       id="16-gtd-3816">
                                <label class="custom-control-label" for="16-gtd-3816">GTD-3816</label>
                            </div>
                        </div>
                        <div class="form-row" id="reset-final16">
                            <div class="col custom-control-inline"
                                 style="justify-content: center; margin-right: 0; margin-top: 20px;">
                                <button type="button" class="btn-outline-info" id="btn-final16" onclick="resetCheck('final16', this)">Reset Final 16</button>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset style="border: 1px solid dodgerblue; padding-bottom: 25px">
                        <legend style="width: auto">MOUNT</legend>
                        <div class="form-row ">


                            <div class="col-12 custom-control-inline custom-control custom-switch" style="justify-content: center; margin-right: 0; margin-bottom: 20px;">
                                <input type="checkbox" class="custom-control-input" id="mountToggle" name="mountToggle" value="1" onclick="toggleDis('mount', 4)">
                                <label class="custom-control-label" for="mountToggle">MOUNT YES/NO</label>
                            </div>

                        </div>
                        <div class="form-row ">

                            <div class="col-lg-3 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="mount" value="9"
                                       id="mnt-9">
                                <label class="custom-control-label" for="mnt-9">Mount 9</label>
                            </div>


                            <div class="col-lg-3 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="mount" value="10"
                                       id="mnt-10">
                                <label class="custom-control-label" for="mnt-10">Mount 10</label>
                            </div>


                            <div class="col-lg-3 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="mount" value="11"
                                       id="mnt-11">
                                <label class="custom-control-label" for="mnt-11">Mount 11</label>
                            </div>

                            <div class="col-lg-3 custom-control-inline custom-checkbox"
                                 style="justify-content: center; margin-right: 0">
                                <input class="custom-control-input" type="checkbox" name="mount" value="13"
                                       id="mnt-13">
                                <label class="custom-control-label" for="mnt-13">Mount 13</label>
                            </div>



                        </div>
                        <div class="form-row" id="reset-mount">
                            <div class="col custom-control-inline"
                                 style="justify-content: center; margin-right: 0; margin-top: 20px;">
                                <button type="button" class="btn-outline-info" id="btn-mount" onclick="resetCheck('mount', this)">Reset Mount</button>
                            </div>
                        </div>
                    </fieldset>

                    <div class="btn-box">
                        <button type="submit" class="btn ">Invia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- end book section -->


<!-- map section -->

<!--<section class="map_section">
    <div class="map">
        <div id="googleMap"></div>
    </div>
</section>-->

<!-- end map section -->

<!-- info section -->
<!--<section class="info_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="info_menu">
                    <h5>
                        QUICK LINKS
                    </h5>
                    <ul class="navbar-nav  ">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html"> About </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="service.html"> Services </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointment.html"> Appointment </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_course">
                    <h5>
                        Thrine Hospital
                    </h5>
                    <p>
                        There are many variations of passages of Lorem Ipsum available,
                        but the majority have suffered alteration in some form, by
                        injected humou
                    </p>
                </div>
            </div>

            <div class="col-md-5 offset-md-1">
                <div class="info_news">
                    <h5>
                        FOR ANY QUERY, PLEASE WRITE TO US
                    </h5>
                    <div class="info_contact">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i> Location
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i> demo@gmail.com
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i> Call : +01 1234567890
                        </a>
                    </div>
                    <form action="">
                        <input type="text" placeholder="Enter Your email"/>
                        <button>
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>-->

<!-- end info section -->

<!-- footer section -->
<footer class="container-fluid footer_section">
    <div class="container">
        <p>
            &copy; <span id="displayYear"></span> All Rights Reserved By ME
        </p>
    </div>
</footer>
<!-- footer section -->

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- nice select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
        integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js/form.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->
</body>

</html>
