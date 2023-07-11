$( document ).ready(function() {
    var resetPilotsDiv = $("#reset-pilot");
    resetPilotsDiv.hide();

    var resetTipsDiv = $("#reset-tip");
    resetTipsDiv.hide();

    var resetFinal10Div = $("#reset-final10");
    resetFinal10Div.hide();

    var resetFinal16Div = $("#reset-final16");
    resetFinal16Div.hide();

    var pilots = $("input[name='pilot']");
    var tips = $("input[name='tip']");
    var final10 = $("input[name='final10']");
    var final16 = $("input[name='final16']");

    pilots.on("click", function(){
        selectPilots(pilots, $(this));
        resetPilotsDiv.show();
    });
    tips.on("click", function(){
        selectTips(tips);
        resetTipsDiv.show();
    });
    final10.on("click", function(){
        selectFinal(final10, 18);
        resetFinal10Div.show();
    });
    final16.on("click", function(){
        selectFinal(final16, 16);
        resetFinal16Div.show();
    });
});

function selectPilots(pilots, item){
    var current = parseInt(item.val());
    for(var i = 0; i < 6; i++){
        var compare = parseInt(pilots[i].value);
        var pilot = pilots[i];
        if(compare < current){
            pilot.checked = true;
            pilot.disabled = true;
        }else{
            pilot.disabled = true;
        }
    }
}

function selectTips(tips){
    for(var i = 0; i < 18; i++){
        var tip = tips[i];
        tip.disabled = true;
    }
}

function selectFinal(finals, num){
    for(var i = 0; i < num; i++){
        var final = finals[i];
        final.disabled = true;
    }
}

function resetCheck(stringa, e){
    const elements = document.querySelectorAll(`input[name="`+stringa+`"]`);

    elements.forEach(function(item){
        item.checked = false;
        item.disabled = false;
    });

    var resetDiv = $("#reset-"+stringa);
    resetDiv.hide();
}


