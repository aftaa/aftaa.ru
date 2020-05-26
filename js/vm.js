var vm = new Vue({
    el: '#app',
    data: {
        columns: {},
    },
    methods: {
        conversion: function(event) {
            let id = event.target.dataset.id;
            $.get('view.php', { id: id });
        }
    },
});

$.get('api', function (data) {
    if (data.success) {
        vm.columns = data.columns;
    } else {
        // TODO обработать ошибки (в консоль?)
    }
});
