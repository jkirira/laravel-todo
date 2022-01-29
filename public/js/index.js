
var box = document.getElementById('markCompleted')
var boxForm = document.getElementById('checkboxForm')

box.addEventListener('change', function (){
    boxForm.submit();
})

