$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$( window ).load(function() {
    var sideBarHeight = $('#content-area').height();
    $('.right-sidebar').css('height', sideBarHeight);
});