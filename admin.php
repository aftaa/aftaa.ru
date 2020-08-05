<?php


require 'config/config.php';

use builder\AdminIndexPageBuilder;use builder\IndexPageBuilder;

$thisPage = (new AdminIndexPageBuilder(include('config/db_pdo.php')))->build();

?><!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= $thisPage->getTitle() ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/aftaa.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/vue-2.6.11.js"></script>
    <script src="js/bootstrap.js"></script>

    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css">
    <script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="css/jquery-ui-themes-1.12.1/themes/le-frog/jquery-ui.css">
    <link rel="stylesheet" href="css/jquery-ui-themes-1.12.1/themes/le-frog/theme.css">

    <link rel="stylesheet" href="css/modal.css">

    <script src="js/aftaa.js"></script>
</head>
<body>

<?php require_once 'include/header.php' ?>

<div id="error" class="error"></div>

<main id="app">
    <div class="container">
        <div class="row">
            <div v-for="(column, colNum) in columns">
                <div class="block col-sm-6 col-lg-4" v-for="(block, blockName) in column">

                    <div class="ui-icon ui-icon-key private" style="float: left;" v-if="block.block_private"></div>
                    <h3 class="mt-3">
                        <span v-html="blockName"></span>

                        <a href="#" v-bind:data-id="block.block_id" v-on:click="editBlock"
                           class="ui-icon ui-icon-pencil">
                        </a>

                        <a href="#" v-bind:data-id="block.block_id" v-on:click="unlinkBlock"
                           class="ui-icon ui-icon-trash">
                        </a>

                        <a href="#" v-bind:data-col-num="colNum" v-on:click="addBlock"
                           class="ui-icon ui-icon-plus">
                        </a>
                    </h3>

                    <table class="table-hover table-striped">
                        <tr v-for="link in block.links">
                            <td>
                                <a v-bind:href="link.icon" target="_blank">
                                    <img alt="" v-bind:src="link.icon" width="16" height="16">
                                </a>&nbsp;

                            </td>
                            <td>
                                <div class="ui-icon ui-icon-key private" v-if="link.link_private"></div>

                                <a v-bind:href="link.href" target="_blank" v-html="link.link_name"
                                   v-bind:data-id="link.link_id" v-on:click="conversion" v-bind:title="link.id"></a>
                            </td>
                            <td width="20">
                                <a href="#" v-bind:data-id="link.link_id" v-on:click="editLink"
                                   class="ui-icon ui-icon-pencil">
                                </a>
                            </td>
                            <td width="20">
                                <a href="#" v-bind:data-id="link.link_id" v-on:click="unlinkLink"
                                   class="ui-icon ui-icon-trash">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <a href="#" v-bind:data-block-id="block.block_id" v-on:click="addLink"
                       class="ui-icon ui-icon-plus">
                    </a>

                    <br>

                </div>
            </div>
        </div>
    </div>

    <?php require_once 'include/admin-trash.php' ?>

</main>

<?php require_once 'include/footer.php' ?>
<?php require_once 'include/modal-link.php' ?>
<?php require_once 'include/modal-block.php' ?>
<div class="modal-overlay" id="modal-overlay"></div>

<script src="js/vm.js"></script>
<script src="js/vmLib.js"></script>
<script src="js/vmEditLink.js"></script>
<script src="js/vmBlock.js"></script>
<script>
    vm.loadAdminIndexData();
    vm.loadAdminTrashData();
    // vm.blockList();
</script>

<script>
    $('#modal-overlay').on('click', function () {
        $('.modal, #modal-overlay').fadeOut('slow');
    });

    $(document).on('keydown', function (e) {
        if (e.keyCode == 27) {
            $('.modal, #modal-overlay').hide();
        }
    });
</script>

</body>
</html>
