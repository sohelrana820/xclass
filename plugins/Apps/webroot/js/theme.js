$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

var docHeight = $( document ).height();
var contentHeight = $('.content-area').height() + 50;

console.log(docHeight);
console.log(contentHeight);

if(docHeight > contentHeight)
{
    $('#page-content-wrapper').css('min-height', docHeight);
}

else{
    $('#page-content-wrapper').css('min-height', contentHeight);
}