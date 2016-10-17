$( ".dropdown-menu" ).mouseover(function() {

});

var loaderHeight = $('.long_loader').height();
var loaderHContentHeight = $('.loader_content').height();
var contentPosition = (loaderHeight - loaderHContentHeight) / 2;
$('.loader_content').css('top', contentPosition);

var contentHeight = $('.content-area').height() + 50;
console.log(contentHeight);
console.log(11);
$('#page-content-wrapper').css('height', contentHeight);