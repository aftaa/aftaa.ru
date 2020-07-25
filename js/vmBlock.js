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
            event.preventDefault();
        }
    }
});
