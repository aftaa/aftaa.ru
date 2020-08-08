let vm = new Vue({
    el: '#app',
    data: {
        api: 'https://v2.api.aftaa.ru/',
        columns: {},
        trashColumns: {},
        topColumns: {},

        debug: true,
        requestDataFail: false,
        status: 200,

        seen: true,
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
            let url = this.api + 'data/index';
            $.get(url)
                .done(function (response) {
                    vm.columns = response.data;
                })
            ;
        },

        /**
         * Get index elements for me.
         */
        loadExpertData: function () {
            let t = this;

            // load top columns
            $.get(this.api + 'data/expert/top')
                .done(function (response) {
                    t.topColumns = response.data;
                    $.get(t.api + 'data/expert', function (response) {
                        t.columns = response.data;
                    }).fail(function (jqXHR) {
                        //$('#error').html(jqXHR.responseText)
                        $
                    })
                    ;
                })
                .fail(function (jqXHR) {
                    t.seen = false;
                    t.consoleErrorReport(jqXHR.responseJSON);
                    // t.login();
                });


        },

        /**
         * Get admin index elements.
         */
        loadAdminIndexData: function (data) {
            let t = this;

            $.get(t.api + 'data/admin', function (response) {
                t.columns = response.data;

            }).fail(function (jqXHR) {
                t.seen = false;
                t.consoleErrorReport(jqXHR.responseJSON);
            });
        },

        /**
         * Get "deleted" elements.
         */
        loadAdminTrashData: function () {
            let t = this;

            $.get(t.api + 'data/admin/trash', function (response) {
                t.trashColumns = response.data;
            }).fail(function (jqXHR) {
                t.seen = false;
                t.consoleErrorReport(jqXHR.responseJSON);
            });
        },

        /**
         * Drop link.
         * @param event
         */
        unlinkLink: function (event) {
            vmEditLink.unlink(event.target.dataset.id);
            event.preventDefault();
        },

        /**
         * Recovery link.
         * @param event
         */
        recoveryLink: function (event) {
            vmEditLink.recovery(event.target.dataset.id);
            event.preventDefault();
        },

        /**
         * Restore block.
         * @param event
         */
        unlinkBlock: function (event) {
            let href = this.api + 'block/remove/' + event.target.dataset.id;

            $.post(href, function (data) {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });
            event.preventDefault();
        },

        /**
         *
         * @param event
         */
        recoveryBlock: function (event) {
            let href = this.api + 'block/restore/' + event.target.dataset.id;

            $.post(href, function (data) {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });
            event.preventDefault();
        },

        editLink: function (event) {
            let t = this;
            let id = event.target.dataset.id;
            $.post(this.api + 'link/' + id)
                .done(function (link) {
                    vmEditLink.init(id, link);
                    $('#modalLink, #modal-overlay').show();
                })
                .fail(function (jqXHR) {
                    t.consoleErrorReport(jqXHR.responseJSON);
                })
            ;
            event.preventDefault();
        },
        addLink: function (event) {
            vmEditLink.addLink(event);
        },
        addBlock: function (event) {
            vmBlock.addBlock(event.target.dataset.colNum);
        },
        editBlock: function (event) {
            let id = event.target.dataset.id;
            vmBlock.load(id);
            event.preventDefault();
        },
        blockList: function () {
            let t = this;
            $.get(this.api + 'block/blocks-list', function (data) {
                // TODO
            }).fail(function (jqXHR) {
                t.consoleErrorReport(jqXHR.responseJSON);
            });
        },

        consoleErrorReport: function (response) {


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

        /**
         * log in
         */
        login: function () {
        },
    },
});
