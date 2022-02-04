// var boxForm = document.getElementById('checkboxForm')
import ("../../node_modules/sweetalert2/dist/sweetalert2.css");
import ("../../node_modules/@fortawesome/fontawesome-free/css/fontawesome.css");
import ("../../node_modules/@fortawesome/fontawesome-free/css/brands.css");
import ("../../node_modules/@fortawesome/fontawesome-free/css/solid.css");

var boxes = document.getElementsByClassName('markCompleted')
for (var i=0; i < boxes.length; i++) {
    let fm = boxes[i].form
    console.log(fm)
    boxes[i].addEventListener('change', function (){
        fm.submit();
     })
    console.log('doing');
}

