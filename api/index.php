<?php

use storage\MyPdoStorage;

require_once 'config.php';

$sql = 'SELECT * FROM link l JOIN link_block b ON l.block_id=b.id, '
    . 'l.name AS link_name, b.name AS block_name'
    . 'WHERE b.deleted = FALSE AND b.private = FALSE '
    . 'AND l.deleted = FALSE AND l.private = FALSE '
    . 'ORDER BY b.sort, l.name';

$pdo = new MyPdoStorage;
$rows = $pdo->query($sql);

if (false === $rows) {
    throw new Exception($pdo->errorInfo(), $pdo->errorCode());
}

