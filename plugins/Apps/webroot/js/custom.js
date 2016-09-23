$( ".dropdown-menu" ).mouseover(function() {

});

var loaderHeight = $('.long_loader').height();
var loaderHContentHeight = $('.loader_content').height();
var contentPosition = (loaderHeight - loaderHContentHeight) / 2;
$('.loader_content').css('top', contentPosition);
console.log(loaderHeight);
console.log(loaderHContentHeight);