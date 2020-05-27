var vm = new Vue({
    el: '#app',
    data: {
        columns: {},
    },
    methods: {
        conversion: function (event) {
            let id = event.target.dataset.id;
            $.get('view.php', {id: id});
        },
        unlink: function (event) {
            let id = event.target.dataset.id;
            let href = event.target.href;
            $.get(href, {id: id}, function () {
                $(event.target).fadeOut('slow');
            })
            return false;
        },
    },
});
