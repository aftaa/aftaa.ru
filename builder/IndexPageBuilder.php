<?php

namespace builder;

use PDO;
use entity\IndexPage;
use storage\LinkBlockPdoStorage;
use strategy\LinkPrivateStrategy;

class IndexPageBuilder
{
    /**
     * @return IndexPage
     */
    public function build(): IndexPage
    {
        return new IndexPage('Hello, aftaa!');

//        $view = new View('links-column', []);// top N
//        $topLinks = $storage->getTopN(23);
//        $query = 'SELECT id, bank_name, card_no FROM bank_card ORDER BY sort';
//        $cards = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
//        $isAftaa = Visitor::isAftaa();
//        $isAdmin = $isAftaa;
    }
}