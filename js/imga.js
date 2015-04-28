var inter;

$(document).ready(function(){
    inter  = setInterval(function(){
        $('.cut_oak_tree').append('<img src="http://www.pbpixels.com/x/images/oak.png"onclick="myFunction(this)">');
    },1000);
});

var counter = 0;

function myFunction(img) {
    counter++;
    document.getElementById('countervalue').innerHTML = counter;
    img.onclick = null;
    img.remove();
    if(counter === 20){
        clearInterval(inter);
    }
}