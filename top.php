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

    <div class="container"><br>
        <h1><img src="image/reports.jpg" width="64" height="64" alt=""> Daily Reports</h1>
        <hr size="1">

        <div v-if="listSeen">
            <a href="expert.php">back 2 expert data</a>

            <table>
                <tr v-for="date in reports">
                    <td><a href="#" @click="loadLinks(date.date)">{{ date.date }}</a></td>
                </tr>
            </table>
        </div>

        <div v-if="linksSeen">

            <a href="#" @click="loadReports()">back 2 reports list</a>

            <div v-for="subLinks in links">
                <div v-for="link in subLinks" class="col">
                    <img alt="" v-bind:src="link.icon" width="16" height="16">
                    {{ link.name }}
                    ({{ link.position }})
                </div>
            </div>


        </div>
    </div>

    <br><br><br><br>
</main>

<script type="module">
    import {topApp} from '/js/vm.top.js';
    topApp.loadReports();
</script>

<?php require_once 'include/footer.php' ?>
<?php require_once 'include/yandex.metrika.html' ?>

</body>
</html>
