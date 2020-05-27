<?php

require 'config/config.php';

use builder\AdminIndexPageBuilder;
use entity\IndexPage;

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
</head>
<body>

<?php require_once 'include/header.php' ?>

<main id="app">
    <div class="container">
        <div class="row">
            <div v-for="(column, colNum) in columns">
                <div class="block glyphicon glyphicon-pencil col-sm-6 col-lg-4" v-for="(block, blockName) in column">
                    <h3 class="mt-3" v-html="blockName"></h3>

                    <table class="table-bordered table-hover">
                        <tr v-for="link in block.links">
                            <td>
                                <a v-bind:href="link.icon" target="_blank">
                                    <img alt="" v-bind:src="link.icon" width="16" height="16">
                                </a>&nbsp;

                            </td>
                            <td>
                                <a v-bind:href="link.href" target="_blank" v-html="link.name"
                                   v-bind:data-id="link.id" v-on:click="conversion"></a>
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<script src="js/vm.js"></script>
<script>
    $.get('api/admin', function (data) {
        if (data.success) {
            vm.columns = data.columns;
        } else {
            // TODO обработать ошибки (в консоль?)
        }
    });
</script>

<?php require_once 'include/footer.php' ?>
<?php require_once 'include/yandex.metrika.html' ?>

</body>
</html>
