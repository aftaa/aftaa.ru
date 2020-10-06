<?php

$allTime = 0;

if (!empty($_POST)) {
    $data = $_POST['data'];
    $rows = explode("\n", $data);


    foreach ($rows as $row) {
        $row = explode("\t", $row);
        if (!empty($row[1])) {
            $dateTime = new \DateTime($row[1]);
            $allTime += $dateTime->format('H') * 60
                + $dateTime->format('i');
        }
    }
}

$allTime = date('H:i', $allTime * 60 - 3 * 3600);
?>

<h1><?= $allTime ?? '' ?></h1>

<form method="post">
    <textarea name="data" style="width: 100%; height: 50%"><?= htmlspecialchars($data ?? '') ?></textarea>
    <br>
    <br>
    <input type="submit">
</form>

