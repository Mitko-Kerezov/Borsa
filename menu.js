$(function(){
    $("#msgs").hide();
    $("#administration").hide();
    $("#bookpages").hide();
    $("#footable").toggle();
    $("#footer").height("20px")
});
function slidemsg(){
    $("#msgs").slideToggle("slow");
    $("#administration").slideUp("slow");
    $("#bookpages").slideUp("slow");
}
function slideadm(){
    $("#administration").slideToggle("slow");
    $("#msgs").slideUp("slow");
    $("#bookpages").slideUp("slow");
}
function slidebook(){
    $("#bookpages").slideToggle("slow");
    $("#msgs").slideUp("slow");
    $("#administration").slideUp("slow");
}
function slidefooter(){
    if($("#footer").height() > "20"){
        $("#footable").hide();
        $("#footer").animate({height: "20px"}, "slow");
    }
    else{
        $("#footer").animate({height: "80px"}, "slow");
        $("#footable").show();
    }
}
function slidemenu(){
    if($("#menu").width() > "20"){
        $("#menucontent").toggle();
        $("#menu").animate({width: "20px"}, "slow");
        $("#right").animate({width: "970px"}, "slow");
    }
    else{
        $("#right").animate({width: "833px"}, "slow");
        $("#menu").animate({width: "157px"}, "slow");
        $("#menucontent").toggle();
    }
}