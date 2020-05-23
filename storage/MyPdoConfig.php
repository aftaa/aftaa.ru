<?php


namespace storage;


class MyPdoConfig implements PdoStorageConfigInterface
{
    private array $pdoConfig;

    /**
     * MyPdoConfig constructor.
     * @param string $pdoConfigFilename
     */
    public function __construct(string $pdoConfigFilename)
    {
        $this->pdoConfig = include $pdoConfigFilename;
    }

    public function getDsn(): string
    {
        return $this->pdoConfig['dsn'];
    }

    public function getUser(): string
    {
        return $this->pdoConfig['user'];
    }

    public function getPassword(): string
    {
        return $this->pdoConfig['password'];
    }

    public function getOptions(): array
    {
        return $this->pdoConfig['options'];
    }
}