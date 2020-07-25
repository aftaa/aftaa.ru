$(function () {
    $('.close').parent().fadeOut();

    var ms = function (text) {
        $('div.system-message span.text').html(text).slideDown();
    }
    var me = function (text) {
        $('div.system-message.error span.text').html(text).slideDown();
    }
});
