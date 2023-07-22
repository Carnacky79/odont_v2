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

})