$('.task_operation').on('click', function (event) {
    $(this).parent().find('.dropdown').toggleClass('open');
});

$('.close_dropdown').on('click', function (event) {
    $(this).parent().parent().parent().toggleClass('open');
});
