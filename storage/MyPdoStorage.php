<?php


namespace storage;


class MyPdoStorage extends PdoStorage
{
    /**
     * MyPdoStorage constructor.
     */
    public function __construct()
    {
        $filename = 'config/db_pdo.php';
        parent::__construct(new MyPdoConfig($filename));
    }
}
