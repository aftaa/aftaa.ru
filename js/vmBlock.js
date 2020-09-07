import {vm} from "./vm.js";
import {vmLib} from "./vmLib.js";

export let vmBlock = new Vue({
    'el': '#appBlock',
    'data': {
        id: null,
        name: '',
        col_num: 0,
        sort: 0,
        private: false,
    },
    'methods': {
        load: function (id) {
            this.id = id;
            let api = vm.api + 'block/' + id;
            let t = this;
            $.post(api)
                .done(function (data) {

                    console.log(data);

                    t.name = data.name;
                    t.col_num = data.col_num;
                    t.sort = data.sort;
                    t.private = data.private;
                    $('#modalBlock, #modal-overlay').fadeIn('slow');
                })
                .fail(function (jsXHR) {
                    vm.consoleErrorReport(jsXHR.responseJSON);
                })
            ;
        },

        saveBlock: function(event) {
            if (null === this.id) {
                this.createBlock();
                event.preventDefault();
                return;
            }

            $.post(vm.api + 'block/save', {
                'name': this.name,
                'col_num': this.col_num,
                'sort': this.sort,
                'private': this.private || 0,
                'id': this.id,
            })
                .done(function (data) {
                    vm.loadAdminIndexData();
                    $('#modalBlock, #modal-overlay').hide();
                })
                .fail(function (jqXHR) {
                    vmLib.failMsg(save-jqXHR);
                })
            ;
            event.preventDefault();
        },

        addBlock: function (colNum) {
            this.id = null;
            this.col_num = colNum;
            this.name = '';
            this.sort = '';
            this.private = false;
            $('#modalBlock, #modal-overlay').slideDown('slow');
        },

        createBlock: function () {
            $.post(vm.api + 'block/add', {
                'name': this.name,
                'col_num': this.col_num,
                'sort': this.sort,
                'private': this.private || 0,
            })
                .done(function (data) {
                        vm.loadAdminIndexData();

                        let link = vmEditLink;
                        link.block_id = data.id;
                        link.addLink();

                        $('#modalBlock, #modal-overlay').slideUp('slow');
                })
                .fail(function (jqXHR) {
                    vmLib.failMsg(jqXHR);
                })
            ;
        },
    },
});
