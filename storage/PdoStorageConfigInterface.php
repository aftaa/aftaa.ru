<?php


namespace storage;


interface PdoStorageConfigInterface
{
    public function getDsn(): string;
    public function getUser(): string;
    public function getPassword(): string;
    public function getOptions(): array;
}