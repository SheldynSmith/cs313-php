function clickFunction() {
    alert("Clicked!");
}

function changeColor() {
    //alert("in changeColor");
    
    var aColor = document.getElementById("new-color").value;
    document.getElementById("div-1").style.backgroundColor = aColor;
    console.log(aColor);
}

function changeColorJQ() {
    var color = $("#new-color2").val();
    $("#div-2").css("background-color", color);
}

function fade() {
    console.log("fade");
    $("#div-3").fadeToggle();
}