<?php


require 'config/config.php';

use builder\AdminIndexPageBuilder;use builder\IndexPageBuilder;
use helper\Visitor;

//if (!Visitor::isAftaa()) {
//    header('Location: 403.shtml');
//    exit;
//}

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

    <script src="js/aftaa.js"></script>
</head>
<body>

<?php require_once 'include/header.php' ?>

<!--<button type="button" data-toggle="modal" data-target="#myModal">Запустить модаль</button>-->

<div id="myModal" class="odal ade bs-example-modal-sm" tabindex="-1" role="" aria-labelledby="mySmallModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-header">Добавить ссылку</div>
        <div class="modal-content">
            <form class="form">

            </form>
        </div>
    </div>
</div>

<script>
    // $('#myModal').modal('show');
</script>

<?php if (\helper\Visitor::isAftaa()): ?>

    <main id="app">
        <div class="container">
            <div class="row">
                <div v-for="(column, colNum) in columns">
                    <div class="block col-sm-6 col-lg-4" v-for="(block, blockName) in column">

                        <div class="ui-icon ui-icon-key private" style="float: left;" v-if="block.private"></div>
                        <h3 class="mt-3">
                            <span v-html="blockName"></span>

                            <a href="#" v-bind:data-id="block.id" v-on:click="editBlock"
                               class="ui-icon ui-icon-pencil">
                            </a>

                            <a href="#" v-bind:data-id="block.id" v-on:click="unlinkBlock"
                               class="ui-icon ui-icon-trash">
                            </a>

                            <a href="#" v-bind:data-id="block.id" v-on:click="addBlock"
                               class="ui-icon ui-icon-plus">
                            </a>
                        </h3>

                        <table class="table-hover table-bordered">
                            <tr v-for="link in block.links">
                                <td>
                                    <a v-bind:href="link.icon" target="_blank">
                                        <img alt="" v-bind:src="link.icon" width="16" height="16">
                                    </a>&nbsp;

                                </td>
                                <td>
                                    <div class="ui-icon ui-icon-key private" v-if="link.private"></div>

                                    <a v-bind:href="link.href" target="_blank" v-html="link.name"
                                       v-bind:data-id="link.id" v-on:click="conversion"></a>
                                </td>
                                <td width="20">
                                    <a href="#" v-bind:data-id="link.id" v-on:click="editLink"
                                       class="ui-icon ui-icon-pencil">
                                    </a>
                                </td>
                                <td width="20">
                                    <a href="#" v-bind:data-id="link.id" v-on:click="unlinkLink"
                                       class="ui-icon ui-icon-trash">
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <a href="#" v-bind:data-id="block.id" v-on:click="addLink"
                           class="ui-icon ui-icon-plus">
                        </a>

                        <br>

                    </div>
                </div>
            </div>
        </div>

        <?php require_once 'include/admin-trash.php' ?>

    </main>

    <script src="js/vm.js"></script>
    <script>
        vm.loadAdminIndexData();
        vm.loadAdminTrashData();
        // vm.blockList();
    </script>

<?php endif ?>


<?php require_once 'include/footer.php' ?>

</body>
</html>