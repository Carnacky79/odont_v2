$( document ).ready(function() {
    var btnPref = $("#pref");

    btnPref.click(function(){
        $.ajax( "preferiti.php" )
            .done(function(msg) {
                alert( "Immagine aggiunta ai preferiti" );
            })
            .fail(function() {
                alert( "Errore" );
            })
    });

    var btnDoc = $("#doc");

    btnDoc.click(function(){
        $.ajax( "doc.php" )
            .done(function(msg) {
                $("#docModal").modal('show');
            })
            .fail(function() {
                alert( "Errore" );
            })
    });

    var btnBack = $("#back");

    btnBack.click(function() {
        window.location.href = "index.php";
    });

    $("#backFromModal").click(function() {
        window.location.href = "index.php";
    });

    $("#backFromPDF").click(function() {
        var ask = window.confirm("Hai scaricato prima il PDF?");
        if (ask) {
            window.location.href = "index.php";
        }
    });

    $("#docDownload").click(function() {
        window.location.href = "docview.php";
    });

    var btnDelPref = $("#delpref");

    btnDelPref.click(function() {
        window.location.href = "delpref.php";
    });

})
