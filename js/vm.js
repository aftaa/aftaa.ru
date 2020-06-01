var vm = new Vue({
    el: '#app',
    data: {
        api: 'http://api.aftaa.ru.local/api/',
        columns: {},
        trash: {},
        debug: true,
        requestDataFail: false,
        status: 200,
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
            $.get(this.api + 'data/index-data', function (data, textStatus, jqXHR) {
                if (data.success) {
                    vm.columns = data.response.columns;
                } else {
                    vm.consoleErrorReport(data);
                }
            });
        },

        /**
         * Get index elements for me.
         */
        loadExpertData: function () {
            let t = this;

            $.get(t.api + 'data/expert-data', function (data) {
                if (data.success) {
                    t.columns = data.response.columns;
                }
            }).fail(function (jqXHR, testStatus) {
                t.consoleErrorReport(jqXHR.responseJSON, testStatus);
            });
        },

        /**
         * Get admin index elements.
         */
        loadAdminIndexData: function () {
            if (data.success) {
                vm.columns = data.response.columns;
            } else {
                vm.consoleErrorReport(data);
            }
        },

        /**
         * Get deleted elements.
         */
        loadAdminTrashData: function () {
            if (data.success) {
                vm.columns = data.response.columns;
            } else {
                vm.consoleErrorReport(data);
            }
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
        },

        consoleErrorReport: function (response, textStatus) {



            if (response.exception) {
                if (500 == response.status) {
                    this.status = 500;
                }
                if (401 == response.status) {
                    this.status = 401;
                }

                console.log('PHP exception ', response.exception.code);
                console.log('Message:', response.exception.message);
                console.log('File:', response.exception.file);
                console.log('Line:', response.exception.line);
                console.log('Output:', response.output);
                console.log('API status:', response.status);
            }
        },
    },
});
