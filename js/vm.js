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
            $.get('view', {id: id});
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
        loadAdminIndexData: function (data) {
            let t = this;

            $.get(t.api + 'data/admin-data', function (data) {
                if (data.success) {
                    t.columns = data.response.columns;
                }
            }).fail(function (jqXHR, testStatus) {
                t.consoleErrorReport(jqXHR.responseJSON, testStatus);
            });
        },

        /**
         * Get "deleted" elements.
         */
        loadAdminTrashData: function () {
            let t = this;

            $.get(t.api + 'data/trash-data', function (data) {
                if (data.success) {
                    t.trash = data.response.columns;
                }
            }).fail(function (jqXHR, testStatus) {
                t.consoleErrorReport(jqXHR.responseJSON, testStatus);
            });
        },

        /**
         * Drop link.
         * @param event
         */
        unlinkLink: function (event) {
            if (confirm('Sure?')) {
                let href = this.api + 'link/unlink-link';

                $.post(href, {id: event.target.dataset.id}, function (data) {
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
        recoveryLink: function (event) {
            let href = this.api + 'link/recovery-link';

            $.post(href, {id: event.target.dataset.id}, function (data) {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });
            event.preventDefault();
        },

        /**
         * Restore block.
         * @param event
         */
        unlinkBlock: function (event) {
            if (confirm('Sure?')) {
                let href = this.api + 'block/unlink-block';

                $.post(href, {id: event.target.dataset.id}, function (data) {
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
        recoveryBlock: function (event) {
            let href = this.api + 'block/recovery-block';

            $.post(href, {id: event.target.dataset.id}, function (data) {
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
