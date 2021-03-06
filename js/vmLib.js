import {vm} from './vm.js';

export let vmLib = {
    hideModal: function () {
        $('#modalLink, #modal-overlay').fadeOut('slow');
    },

    reloadIndex: function(){
        vm.loadAdminIndexData();
        vmLib.hideModal();
    },

    failMsg: function(jqXHR) {
        $('#error').html(jqXHR.responseText);
    }

};
