$('#iframe-player').attr('src', $('.series-wrapper').find('.one-item:first').addClass('active').data('sound'));

$('.full-series a.one-item').click(function (e) {
//тут ещё всякое разное
    localStorage.setItem('stran', $(this).data('voice'));
});

var stran = localStorage.getItem('stran');

if (stran) {
    $('.series-wrapper .one-item').each(function () {
        var $this = $(this);
        if ($this.attr('data-voice').indexOf(stran) !== -1) {
            $('#iframe-player').attr('src', $this.addClass('active').data('sound'));
        }
    })

    if ($('.active').length > 2) {
        $('#iframe-player').attr('src', $('.series-wrapper').find('.one-item:first').removeClass('active').data('sound', ''));
    }
}