import {vmEditLink} from './vmEditLink.js';
import {vmBlock} from './vmBlock.js';

export let vm = new Vue({
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
        conversion(event) {
            let id = event.target.dataset.id;
            $.get(this.api + 'view/' + id);
        },

        /**
         * Get index elements for all.
         */
        loadIndexData() {
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
        loadExpertData() {
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
        loadAdminIndexData(data) {
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
        loadAdminTrashData() {
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
        unlinkLink(event) {
            vmEditLink.unlink(event.target.dataset.id);
            event.preventDefault();
        },

        /**
         * Recovery link.
         * @param event
         */
        recoveryLink(event) {
            vmEditLink.recovery(event.target.dataset.id);
            event.preventDefault();
        },

        /**
         * Restore block.
         * @param event
         */
        unlinkBlock(event) {
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
        recoveryBlock(event) {
            let href = this.api + 'block/restore/' + event.target.dataset.id;

            $.post(href, function (data) {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });
            event.preventDefault();
        },

        editLink(event) {
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
        addLink(event) {
            vmEditLink.addLink(event);
        },
        addBlock(event) {
            vmBlock.addBlock(event.target.dataset.colNum);
        },
        editBlock(event) {
            let id = event.target.dataset.id;
            vmBlock.load(id);
            event.preventDefault();
        },
        blockList() {
            let t = this;
            $.get(this.api + 'block/blocks-list', function (data) {
                // TODO
            }).fail(function (jqXHR) {
                t.consoleErrorReport(jqXHR.responseJSON);
            });
        },

        consoleErrorReport(response) {


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
        login() {
        },
    },
});
