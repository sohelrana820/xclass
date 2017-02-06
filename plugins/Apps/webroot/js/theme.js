$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$( window ).load(function() {
    var sideBarHeight = $('#wrapper').height();
    $('.right-sidebar').css('height', sideBarHeight);
});