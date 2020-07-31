let vmBlock = new Vue({
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
            let api = vm.api + 'block/load-block';
            let t = this;
            $.post(api, {id: id})
                .done(function (data) {
                    data = data.response;
                    t.name = data.name;
                    t.col_num = data.col_num;
                    t.sort = data.sort;
                    t.private = parseInt(data.private);

                    $('#modalBlock, #modal-overlay').show();
                })
                .fail(function (jsXHR) {
                    vm.consoleErrorReport(jsXHR.responseJSON);
                })
            ;
        },

        saveBlock: function(event) {
            if (null === this.id) {
                this.createBlock();
            }

            $.post(vm.api + 'block/save-block', {
                'name': this.name,
                'col_num': this.col_num,
                'sort': this.sort,
                'private': this.private || 0,
                'id': this.id,
            })
                .done(function (data) {
                    if (data.success) {
                        vm.loadAdminIndexData();
                        $('#modalBlock, #modal-overlay').hide();
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

        addBlock: function () {
            this.id = null;
            this.col_num = '';
            this.name = '';
            this.sort = '';
            this.private = false;
            $('#modalBlock, #modal-overlay').slideDown('slow');
        },

        createBlock: function () {
            $.post(vm.api + 'block/add-block', {
                'name': this.name,
                'col_num': this.col_num,
                'sort': this.sort,
                'private': this.private || 0,
            })
                .done(function (data) {
                    if (data.success) {
                        vm.loadAdminIndexData();
                        $('#modalBlock, #modal-overlay').slideUp('slow');
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
    },
});
