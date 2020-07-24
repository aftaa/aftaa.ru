let vmEditLink = new Vue({
    el: '#appEditLink',
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




        saveLink: function (event) {

            $.post(vm.api + 'link/save-link', {
                'block_id': this.block_id,
                'name': this.name,
                'href': this.href,
                'icon': this.icon,
                'private': this.private,
                'id': this.id,
            })
                .done(function () {
                    vm.loadAdminIndexData();
                    $('#modalLink, #modal-overlay').hide();
                })
                .fail(function (jqXHR) {
                    vm.consoleErrorReport(jqXHR.responseJSON);
                })
            ;


            event.preventDefault();
        },





        unlink: function(id) {
            let href = vm.api + 'link/unlink-link';
            $.post(href, {id: id}, function () {
                vm.loadAdminIndexData();
                vm.loadAdminTrashData();
            });

        },


        recovery: function(id) {
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
        }
    },
});
