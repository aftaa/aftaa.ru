<?php

require_once 'config/config.php';

use builder\LinkBlockJsonBuilder;
use helper\View;
use helper\Visitor;
use storage\LinkBlockPdoStorage;
use strategy\LinkPrivateStrategy;


try {
    $dbConfig = include('config/db_pdo.php');
    $dbh = new PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['password'], [
        PDO::ATTR_PERSISTENT => true,
    ]);
    $dbh->query('SET NAMES UTF8');
    $storage = new LinkBlockPdoStorage();
    $storage->setDbh($dbh);
    $links = $storage->getAll(new LinkBlockJsonBuilder(new LinkPrivateStrategy));
    $view = new View('links-column', []);// top N
    $topLinks = $storage->getTopN(23);
    $query = 'SELECT id, bank_name, card_no FROM bank_card ORDER BY sort';
    $cards = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
    $isAftaa = Visitor::isAftaa();
    $isAdmin = $isAftaa;

    $vueData = json_encode($links);

} catch (Exception $e) {
    ?>
    <h1>Exception <?php $e->getCode() ?></h1>
    <h2><?= $e->getMessage() ?></h2>
    <h3>File: <?= $e->getMessage() ?></h3>
    <h3>Line: <?= $e->getLine() ?></h3>
    <h4>Trace:</h4>
    <pre><?php print_r($e->getTrace()) ?></pre>
    <?php exit;
} ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    <script src="/js/vue.js"></script>

    <link rel="stylesheet" href="/css/aftaa.css">
    <script type="text/javascript" src="/js/aftaa.js"></script>
    <script type="text/javascript" src="/js/vm.js"></script>
    <title>Hello, aftaa!</title>
</head>
<body>
<main class="container" id="app">
    <div class="row">
        <div class="col col-lg-2 col-sm-3" v-if="seen">
            <div class="alert-info"
                 style="padding: 0 0 .5em 1em; border-radius: 1em;"><?php $view->render(['block' => $topLinks]) ?></div>
            <br>
            <a href="https://twitter.com/intent/tweet?button_hashtag=aftaa&ref_src=twsrc%5Etfw"
               class="twitter-hashtag-button" data-show-count="false">Tweet #aftaa</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>

        <div class="col col-lg-2 col-sm-3">
            <?php $view->render(['block' => $links['where I live']]) ?>
            <?php $view->render(['block' => $links['social networks']]) ?>
            <?php if ($isAftaa): ?>
                <?php $view->render(['block' => $links['my']]) ?>

                <div>
                    <br>
                    <div style="overflow:hidden;">
                        <input type="text" value="128.0.142.30" id="ip" onclick="this.select()"
                               style="color: #a163f5; font-size: 15px; width: 100px; border-color: #a163f5; text-align: center; border-width: 1px; border-radius: 5px;">
                    </div>
                </div>
            <?php endif ?>
        </div>
        <div class="col col-lg-2 col-sm-3">
            <?php $view->render(['block' => $links['music &amp; mixes']]) ?>
            <?php $view->render(['block' => $links['ICQ']]) ?>
            <?php $view->render(['block' => $links['Skype']]) ?>
            <?php $view->render(['block' => $links['telegram']]) ?>
            <?php if ($isAftaa): ?>
                <?php $view->render(['block' => $links['routers']]) ?>
            <?php endif ?>
        </div>
        <?php if ($isAftaa): ?>
            <div class="col col-lg-2 col-sm-3">
                <?php $view->render(['block' => $links['finance']]) ?>
                <?php $view->render(['block' => $links['lk']]) ?>
            </div>
            <div class="col col-lg-2 col-sm-3">
                <?php $view->render(['block' => $links['yandex']]) ?>
                <?php $view->render(['block' => $links['google']]) ?>
            </div>

            <div class="col col-lg-2 col-sm-3">
                <?php $view->render(['block' => $links['projects']]) ?>
                <?php $view->render(['block' => $links['shopping']]) ?>
                <?php $view->render(['block' => $links['other']]) ?>
            </div>
        <?php endif ?>
    </div>
    <br><br>
    <?php if (false && !$isAftaa): ?>
        <div class="container">
            <div class="col-sm-12 col-md-8 col-lg-6 col-sx-12">
                <a class="twitter-timeline" data-lang="ru" data-theme="light"
                   href="https://twitter.com/aftaa?ref_src=twsrc%5Etfw">Tweets by aftaa</a>
                <script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    <?php endif ?>
</main>
<footer class="navbar fixed-bottom">
    <div id="c">&copy; 1983&ndash;<?= date('Y') ?>
        <a href="mailto:after@aftaa.ru">after</a>
        сделал в <a href="http://kuba.moscow/" target="_blank" id="kuba-moscow">kuba.moscow</a>
    </div>
</footer>
<?php require_once 'yandex.metrika.html' ?>
</body>
</html>
