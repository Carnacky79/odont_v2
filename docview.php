<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();

$docFile = fopen("db/doc.txt", "r") or die("Unable to open file!");

while (!feof($docFile)) {
    $files[] = fgets($docFile);
}
fclose($docFile);

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

<body class="sub_page">
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.php">
                    <h3>
                        Odont v.2 - PDF
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

<!-- about section -->
<section class="about_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Generazione PDF
            </h2>
        </div>
        <div class="row">
            <div class="col">
                <form method="post" action="docdownload.php">
                    <h4 style="margin-top: 20px; border-top: 1px solid black;padding-top: 15px">
                        <span style="font-variant: small-caps">Aggiungi Info e genera PDF</span>
                    </h4>
                    <hr style="border:1px solid black" />
                    <?php
                    if(!isset($_SESSION['paziente'])){
                        echo <<<HTML
<div class="form-row" style="margin-top: 10px; border-bottom: 1px solid black;padding-top: 5px;padding-bottom:10px;">
                        <div class="form-group col-lg-4 offset-lg-4" style="padding-top:15px;">
                            <label for="paziente">Nome Paziente</label>
                            <input type="text" class="form-control" id="paziente" name="paziente" required="required">
                        </div>
                    </div>
HTML;

                    }

                    $count = 0;
                    foreach ($files as $f){
                        if(strlen($f)>2){
                            echo <<<HTML
<div class="form-row ">
                        <div class="col-lg-4 offset-lg-4 form-group"
                             style="justify-content: center; margin-right: 0; margin-top: 30px;">
                             <label for="pos$count">Posizione Impianto</label>
                             <input class="form-control" type="text" id="pos$count" name="pos[]" required="required">
                            
                        </div>
                        <div class="col-lg-8 offset-lg-2 form-group"
                             style="justify-content: center; margin-right: 0">
                             <div class="img-box b2">
                                <img src="$f" />
                             </div>
                             <input type="hidden" id="img$count" name="img[]" value="$f">
                            
                        </div>
                        <div class="col-lg-4 offset-lg-4 form-group"
                             style="justify-content: center; margin-right: 0;">
                             <label for="note$count">Note</label>
                             <input class="form-control" type="text" id="note$count" name="note[]" required="required">
                            
                        </div>
</div>
<hr style="border:1px solid black; margin-bottom:15px;" />
HTML;
                        $count++;
                        }
                    }

                    ?>
                    <div class="btn-box">
                        <button type="submit" class="btn btn-info">Scarica PDF</button>
                    </div>

                </form>
                <div class="btn-box" style="margin-top: 30px;">
                    <button type="button" id="backFromPDF" class="btn btn-success">Ricomincia</button>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- end about section -->

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script src="js/ajax.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->
</body>

</html>
