import {vm} from "./vm.js";
import {vmLib} from "./vmLib.js";

export let vmEditLink = new Vue({
    el: '#appEditLink', // include/modal-link.php
    data: {
        'id': null,

        'block_id': 0,
        'name': '',
        'href': '',
        'icon': '',
        'private': false,


        'blocks': {},
    },

    methods: {
        init: function (id, link) {
            this.id = id;
            this.block_id = link.block_id;
            this.name = link.name;
            this.href = link.href;
            this.icon = link.icon;
            this.private = link.private;

            this._loadBlocks();
        },


        addLink: function (event) {

            if (event) {
                this.block_id = event.target.dataset.blockId;
            }

            this.id = null;
            this._loadBlocks();
            this.name = this.href = this.icon = '';
            this.private = false;
            $('#modalLink, #modal-overlay').slideDown('slow');
        },


        createLink: function () {
            $.post(vm.api + 'link/add', {
                'block_id': this.block_id,
                'name': this.name,
                'href': this.href,
                'icon': this.icon,
                'private': this.private || 0,
            })
                .done(function () {
                    vm.loadAdminIndexData();
                    vmLib.hideModal();
                })
                .fail(function (jqXHR) {
                    vmLib.failMsg(jqXHR);
                })
            ;
        },

        saveLink: function (event) {

            if (null === this.id) {
                this.createLink();
                event.preventDefault();
                return;
            }

            $.post(vm.api + 'link/save', {
                'block_id': this.block_id,
                'name': this.name,
                'href': this.href,
                'icon': this.icon,
                'private': this.private || 0,
                'id': this.id,
            })
                .done(function () {
                    vm.loadAdminIndexData();
                    $('#modalLink, #modal-overlay').fadeOut('slow');
                })
                .fail(function (jqXHR) {
                    $('#error').html(jqXHR.responseText);
                })
            ;


            event.preventDefault();
        },


        unlink: function (id) {
            let href = vm.api + 'link/remove/' + id;
            $.post(href, function () {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });

        },


        recovery: function (id) {
            let href = vm.api + 'link/restore/' + id;
            $.post(href, function () {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });

        },


        _loadBlocks: function () {
            let t = this;

            $.get(vm.api + 'blocks')
                .done(function (data) {
                    t.blocks = data;
                })
                .fail(function (jqXHR) {
                    vm.consoleErrorReport(jqXHR.responseJSON);
                })
        },

        loadFavicon: function (event) {
            let url = vm.api + 'favicon/import';
            let t = this;
            $.post(url, {name: this.name, origin: this.icon})
                .done(function (data) {
                    t.icon = data;
                    t.saveLink(event);
                    vm.loadAdminIndexData();
                })
                .fail(function (jqXHR) {
                    vmLib.failMsg(jqXHR);
                })
            event.preventDefault();
        }
    },
});
