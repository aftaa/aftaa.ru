<?php

use storage\MyPdoStorage;

try {
    require_once 'config.php';
    $sql = 'SELECT l.id AS link_id, b.id AS block_id, l.name AS link_name, b.name AS block_name, '
        . 'col_num, href, icon, b.private AS block_private, l.private AS link_private '
        . 'FROM link l JOIN link_block b ON l.block_id=b.id '
        . 'WHERE AND b.deleted = FALSE AND l.deleted = FALSE '
        . 'ORDER BY b.sort, l.name';
    $pdo = new MyPdoStorage;
    $rows = $pdo->query($sql, PDO::FETCH_OBJ);

    if (false === $rows) {
        throw new Exception(print_r($pdo->errorInfo(), true), $pdo->errorCode());
    }

    $data = [];
    while ($row = $rows->fetchObject()) {
        $link = (object)[
            'id'      => $row->id,
            'name'    => $row->link_name,
            'href'    => $row->href,
            'icon'    => $row->icon,
            'private' => $row->link_private
        ];

        if (!array_key_exists($row->block_name)) {
            $data[$row->col_num][$row->block_name] = (object)[
                'id'      => $row->block_id,
                'name'    => $row->block_name,
                'private' => $row->block_private,
                'links'   => [

                ],
            ];
        }

        $data[$row->col_num][$row->block_name]->links[] = $link;
    }

    echo json_encode((object)[
        'success' => true,
        'columns' => $data,
    ]);

} catch (Exception $e) {
    require_once 'include/exception.php';
}


