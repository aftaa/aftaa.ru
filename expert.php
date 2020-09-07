<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Hello, aftaa!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="css/aftaa.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="js/vue-2.6.11.js"></script>
</head>

<?php //require_once 'include/header.php' ?>

<main id="app">
    <div class="container" v-if="seen">
        <?php //require 'include/login.php' ?>
        <div class="row">
            <div class="col col-sm-12 col-md-6 col-lg-2">
                <div class="alert-info"
                     style="padding: 0 0 .5em 1em; border-radius: 1em;">
                    <h3 class="mt-3">my top</h3>
                    <div style="white-space: nowrap;" class="mb-1" v-for="link in topColumns">
                        <a v-bind:href="link.icon" target="_blank">
                            <img alt="" v-bind:src="link.icon" width="16" height="16">
                        </a>&nbsp;
                        <a v-bind:href="link.href" target="_blank" v-html="link.link_name"
                           v-bind:data-id="link.id" v-on:click="conversion"></a>
                    </div>
                </div>
                <br>
                <!--                    <a href="https://twitter.com/intent/tweet?button_hashtag=aftaa&ref_src=twsrc%5Etfw"-->
                <!--                       class="twitter-hashtag-button" data-show-count="false">Tweet #aftaa</a>-->
                <!--                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>-->

                <input type="text" value="128.0.142.30" id="ip" onclick="this.select()"
                       style="color: #a163f5; font-size: 12px; width: 100px; border-color: #a163f5; text-align: center; border-width: 1px; border-radius: 5px;">
            </div>


            <div v-for="(column, colNum) in columns">
                <div class="block col col-sm-12 col-md-6 col-lg-2" v-for="(links, blockName) in column">
                    <h3 class="mt-3" v-html="blockName"></h3>
                    <div class="mb-1" v-for="link in links">
                        <a v-bind:href="link.icon" target="_blank">
                            <img alt="" v-bind:src="link.icon" width="16" height="16">
                        </a>&nbsp;
                        <a v-bind:href="link.href" target="_blank" v-html="link.link_name"
                           v-bind:data-id="link.id" v-on:click="conversion"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
</main>

<script type="module">
    import {vm} from '/js/vm.js';
    vm.loadExpertData();
</script>

<?php require_once 'include/footer.php' ?>
<?php require_once 'include/yandex.metrika.html' ?>

</body>
</html>
