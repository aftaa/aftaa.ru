<?php


namespace storage;


use PDO;

class PdoStorage extends PDO
{

    /**
     * PdoStorage constructor.
     * @param PdoStorageConfigInterface $config
     */
    public function __construct(PdoStorageConfigInterface $config)
    {
        parent::__construct(
            $config->getDsn(),
            $config->getUser(),
            $config->getPassword(),
            $config->getOptions(),
        );
    }
}