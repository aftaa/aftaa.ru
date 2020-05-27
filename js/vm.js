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
