<?php

use storage\MyPdoStorage;

try {
    require_once 'config.php';
    $pdo = new MyPdoStorage;

    $sql = 'update link set deleted=false where id=:id';
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'id' => $_REQUEST['id'],
    ]);

    echo json_encode((object)[
        'success' => true,
    ]);

} catch (Exception $e) {
    echo json_encode((object)[
        'success'   => false,
        'exception' => $e->getMessage(),
    ]);
}
