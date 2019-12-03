$(function () {
    $('#toTop').on('click', function () {
        $('html').animate({
            scrollTop: 0,
        }, 500);
    })
});

$('.nav-link').on('click', function () {
    let id = this.href.replace(/^[^#]+/, '');
    let $id = $(id);
    $('html').animate({
        scrollTop: $id.offset().top,
    }, 500);
    return false;
})