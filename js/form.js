$( document ).ready(function() {
    var pilots = $("input[name='pilot']");
    var tips = $("input[name='tip']");
    var final10 = $("input[name='final10']");
    var final16 = $("input[name='final16']");

    pilots.on("click", function(){selectPilots(pilots, $(this))});
    tips.on("click", function(){selectTips(tips)});
    final10.on("click", function(){selectFinal(final10, 18)});
    final16.on("click", function(){selectFinal(final16, 16)});
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


