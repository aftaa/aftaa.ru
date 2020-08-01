let vmEditLink = new Vue({
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
        init: function (id, response) {
            this.id = id;
            this.block_id = response.block_id;
            this.name = response.name;
            this.href = response.href;
            this.icon = response.icon;
            this.private = parseInt(response.private);

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
            $.post(vm.api + 'link/add-link', {
                'block_id': this.block_id,
                'name': this.name,
                'href': this.href,
                'icon': this.icon,
                'private': this.private || 0,
            })
                .done(function (data) {
                    if (data.success) {
                        vm.loadAdminIndexData();
                        $('#modalLink, #modal-overlay').slideUp('slow');
                    } else {
                        console.log(data.exception)
                        vm.consoleErrorReport(data);
                    }
                })
                .fail(function (jqXHR) {
                    vm.consoleErrorReport(jqXHR.responseJSON);
                })
            ;
        },

        saveLink: function (event) {

            if (null === this.id) {
                this.createLink();
            }

            $.post(vm.api + 'link/save-link', {
                'block_id': this.block_id,
                'name': this.name,
                'href': this.href,
                'icon': this.icon,
                'private': this.private || 0,
                'id': this.id,
            })
                .done(function (data) {
                    if (data.success) {
                        vm.loadAdminIndexData();
                        vmLib.hideModal();
                    } else {
                        console.log(data.exception)
                        vm.consoleErrorReport(data);
                    }
                })
                .fail(function (jqXHR) {
                    vm.consoleErrorReport(jqXHR.responseJSON);
                })
            ;


            event.preventDefault();
        },


        unlink: function (id) {
            let href = vm.api + 'link/unlink-link';
            $.post(href, {id: id}, function () {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });

        },


        recovery: function (id) {
            let href = vm.api + 'link/recovery-link';
            $.post(href, {id: id}, function () {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });

        },


        _loadBlocks: function () {
            let t = this;

            $.get(vm.api + 'block/blocks-list')
                .done(function (data) {
                    t.blocks = data.response;
                })
                .fail(function (jqXHR) {
                    vm.consoleErrorReport(jqXHR.responseJSON);
                })
        },

        loadFavicon: function (event) {
            let url = vm.api + 'link/get-favicon';
            let t = this;
            $.post(url, {name: this.name, origin: this.icon})
                .done(function (data) {
                    if (data.success) {
                        t.icon = data.response;
                        t.saveLink(event);
                        vm.loadAdminIndexData();
                    } else {
                        console.log(data.exception)
                        vm.consoleErrorReport(data);
                    }

                })
                .fail(function (jqXHR) {
                    vm.consoleErrorReport(jqXHR.responseJSON);
                })
            event.preventDefault();
        }
    },
});
