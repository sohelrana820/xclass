$('.task_operation').on('click', function (event) {
    $(this).parent().find('.dropdown').toggleClass('open');
});

$('.close_dropdown').on('click', function (event) {
    $(this).parent().parent().parent().toggleClass('open');
    console.log(1111);
});


$('.close_dropdown').on('mouseleave', function (event) {
    console.log(11);
});


$('ul.nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});