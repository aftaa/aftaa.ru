<?php

require 'config/config.php';

use builder\IndexPageBuilder;
use entity\IndexPage;

/** @var IndexPage $thisPage */
$thisPage = (new IndexPageBuilder(include('config/db_pdo.php')))->build();

?><!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= $thisPage->getTitle() ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/aftaa.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/vue-2.6.11.js"></script>
</head>
<body>
<main id="app">
    <div class="container">
        <div class="row">
            <div v-for="columns in hrefs">
                <div class="col col-lg-2 col-sm-3 section" v-for="section in columns">

                    <h3 class="mt-3" v-html="section.name"></h3>
                    <div class="mb-1" v-for="link in section.links">
                        <a v-bind:href="link.icon" target="_blank">
                            <img alt="" v-bind:src="link.icon" width="16" height="16">
                        </a>&nbsp;
                        <a v-bind:href="link.href" target="_blank" v-html="link.name"
                           v-bind:data-id="link.id" v-on:click="conversion"></a>
                    </div>
                </div>
            </div>
        </div>
</main>
<script src="js/vm.js"></script>
<footer class="navbar fixed-bottom">
    <div id="c">&copy; 1983&ndash;<?= date('Y') ?>
        <a href="mailto:after@aftaa.ru">after</a>
        <a href="http://kuba.moscow/" target="_blank" id="kuba-moscow">kuba.moscow</a>
    </div>
</footer>
<?php require_once 'include/yandex.metrika.html' ?>
</body>
</html>
