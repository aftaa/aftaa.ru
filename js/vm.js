var vm = new Vue({
    el: '#app',
    data: {
        columns: {},
        trash: {},
    },
    methods: {
        conversion: function (event) {
            let id = event.target.dataset.id;
            $.get('view.php', {id: id});
        },

        /**
         * Get index elements for all.
         */
        loadIndexData: function () {
            $.get('api/index-data.php', function (response) {
                vm.columns = response.columns;
            });
        },

        /**
         * Get index elements for me.
         */
        loadExpertData: function () {
            $.get('api/expert-data.php', function (response) {
                vm.columns = response.columns;
            });
        },

        /**
         * Get admin index elements.
         */
        loadAdminIndexData: function () {
            $.get('api/admin/index-data.php', function (response) {
                vm.columns = response.columns;
            });
        },

        /**
         * Get deleted elements.
         */
        loadAdminTrashData: function () {
            $.get('api/admin/trash-data.php', function (response) {
                vm.trash = response.columns;
            });
        },

        /**
         * Drop link.
         * @param event
         */
        unlink: function (event) {
            if (confirm('Sure?')) {
                $.post(event.target.href, {id: event.target.dataset.id}, function (data) {
                    $(event.target).parent().parent().fadeOut('slow');
                    vm.loadAdminTrashData();
                });
            }
            event.preventDefault();
        },

        /**
         * Recovery link.
         * @param event
         */
        recovery: function (event) {
            $.post(event.target.href, {id: event.target.dataset.id}, function (data) {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });
            event.preventDefault();
        },

        /**
         * Restore block.
         * @param event
         */
        dropBlock: function (event) {
            if (confirm('Sure?')) {
                $.post(event.target.href, {id: event.target.dataset.id}, function (data) {
                    $(event.target).parent().parent().fadeOut('slow');
                    vm.loadAdminTrashData();
                });
            }
            event.preventDefault();
        },

        /**
         *
         * @param event
         */
        restore: function (event) {
            $.post(event.target.href, {id: event.target.dataset.id}, function (data) {
                $(event.target).parent().parent().fadeOut();
                vm.loadAdminIndexData();
            });
            event.preventDefault();
        }
    },
});
