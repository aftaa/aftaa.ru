var vm = new Vue({
    el: '#app',
    data: {
        hrefs: [],
    },
    methods: {
        conversion: function(event) {
            let id = event.target.dataset.id;
            $.get('view.php', { id: id });
        }
    },
});

$.get('api', function (data) {
    vm.hrefs = data;
});
