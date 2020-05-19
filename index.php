<?php

require 'config/config.php';

use builder\IndexPageBuilder;

/** IndexPage $thisPage */
$thisPage = (new IndexPageBuilder(include('config/db_pdo.php')))->build();

?><!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= $thisPage->getTitle() ?></title>
    <script src="js/vue.js"></script>
</head>
<body>
<main id="app">
    <div v-for="">

    </div>
</main>

<script src="js/vm.js"></script>
<script>
    vm.links = <?= $thisPage->getSectionAsJson() ?>
</script>
</body>
</html>
