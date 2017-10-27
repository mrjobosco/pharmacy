$(document).ready(function(){

$('#sandbox-container input').datepicker({
    format: "dd/mm/yyyy",
    startView: 1,
    clearBtn: true
});


var h = $(window).height();
var w  = $(window).width();


$('.chat-box').css("height", h);



});