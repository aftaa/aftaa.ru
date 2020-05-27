<?php

use helper\Visitor;
use storage\MyPdoStorage;

try {
    require_once 'config.php';

    if (!Visitor::isAftaa()) {
        header('HTTP/1.0 403 Forbidden', true, 403);
        exit;
    }

    $sql = 'SELECT l.id, l.name AS link_name, b.name AS block_name, '
        . 'col_num, href, icon '
        . 'FROM link l JOIN link_block b ON l.block_id=b.id '
        . 'WHERE b.deleted = FALSE '
        . 'AND l.deleted = FALSE '
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


