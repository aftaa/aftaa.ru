<?php

namespace builder;

use PDO;
use entity\IndexPage;
use storage\LinkBlockPdoStorage;
use strategy\LinkPrivateStrategy;

class IndexPageBuilder
{
    /** @var PDO */
    private $pdo;

    /**
     * IndexPageBuilder constructor.
     * @param array $pdoConfig
     */
    public function __construct(array $pdoConfig)
    {
        $this->pdo = new PDO(
            $pdoConfig['dsn'],
            $pdoConfig['user'],
            $pdoConfig['password']
        );

        $this->pdo->query('SET NAMES UTF8');
    }

    /**
     * @return IndexPage
     */
    public function build(): IndexPage
    {
        $storage = new LinkBlockPdoStorage();
        $storage->setDbh($this->pdo);
        $blocks = $storage->getAll(new LinkBlockJsonBuilder(new LinkPrivateStrategy));
        $blocksByColumn = $storage->getAllByColNum($blocks);
        return new IndexPage('Hello, aftaa!', $blocksByColumn, []);


//        $view = new View('links-column', []);// top N
//        $topLinks = $storage->getTopN(23);
//        $query = 'SELECT id, bank_name, card_no FROM bank_card ORDER BY sort';
//        $cards = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
//        $isAftaa = Visitor::isAftaa();
//        $isAdmin = $isAftaa;
    }
}