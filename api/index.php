<?php

use storage\MyPdoStorage;

try {
    require_once 'config.php';
    $sql = 'SELECT l.id, l.name AS link_name, b.name AS block_name, '
        . 'col_num, href, icon '
        . 'FROM link l JOIN link_block b ON l.block_id=b.id '
        . 'WHERE b.deleted = FALSE AND b.private = FALSE '
        . 'AND l.deleted = FALSE AND l.private = FALSE '
        . 'ORDER BY b.sort, l.name';
    $pdo = new MyPdoStorage;
    $rows = $pdo->query($sql, PDO::FETCH_OBJ);

    if (false === $rows) {
        throw new Exception(print_r($pdo->errorInfo(), true), $pdo->errorCode());
    }

    $data = [];
    while ($row = $rows->fetchObject()) {
        $link = (object)[
            'id'   => $row->id,
            'name' => $row->link_name,
            'href' => $row->href,
            'icon' => $row->icon,
        ];

        $data[$row->col_num][$row->block_name][] = $link;
    }

    echo json_encode((object)[
        'success' => true,
        'columns' => $data,
    ]);

} catch (Exception $e) {
    require_once 'include/exception.php';
}


