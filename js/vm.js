var vm = new Vue({
    el: '#app',
    data: {
        api: 'https://api.aftaa.ru/api/',
        columns: {},
        trashColumns: {},
        topColumns: {},

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
                    vm.consoleErrorReport(data, textStatus);
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
            }).fail(function (jqXHR) {
                t.consoleErrorReport(jqXHR.responseJSON);
            });

            // load top columns
            $.get(this.api + 'link/top-links')
                .done(function (data) {
                    if (data.success) {
                        t.topColumns = data.response.columns;
                    }
                })
                .fail(function (jqXHR) {
                    t.consoleErrorReport(jqXHR.responseJSON);
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
            }).fail(function (jqXHR) {
                t.consoleErrorReport(jqXHR.responseJSON);
            });
        },

        /**
         * Get "deleted" elements.
         */
        loadAdminTrashData: function () {
            let t = this;

            $.get(t.api + 'data/trash-data', function (data) {
                if (data.success) {
                    t.trashColumns = data.response.columns;
                }
            }).fail(function (jqXHR) {
                t.consoleErrorReport(jqXHR.responseJSON);
            });
        },

        /**
         * Drop link.
         * @param event
         */
        unlinkLink: function (event) {
            let href = this.api + 'link/unlink-link';
            let id = event.target.dataset.id;

            $.post(href, {id: id}, function (data) {
                $(event.target).parent().parent().fadeOut('slow');
                vm.loadAdminTrashData();
            });
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
            let href = this.api + 'block/unlink-block';

            $.post(href, {id: event.target.dataset.id}, function (data) {
                $(event.target).parent().parent().fadeOut('slow');
                vm.loadAdminTrashData();
            });
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

        editLink: function (event) {
        },
        addLink: function (event) {
        },
        addBlock: function (event) {
        },
        editBlock: function (event) {
        },
        blockList: function () {
            let t = this;
            $.get(this.api + 'block/blocks-list', function (data) {
                // TODO
            }).fail(function (jqXHR) {
                t.consoleErrorReport(jqXHR.responseJSON);
            });
        },

        consoleErrorReport: function (response, textStatus) {


            if (response.exception) {
                if (500 == response.status) {
                    this.status = 500;
                }
                if (401 == response.status) {
                    this.status = 401;
                }

                console.error('PHP exception ', response.exception.code);
                console.error('Message:', response.exception.message);
                console.error('File:', response.exception.file);
                console.error('Line:', response.exception.line);
                console.error('Output:', response.output);
                console.error('API status:', response.status);
            }
        },
    },
});
