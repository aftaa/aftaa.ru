<?php


namespace builder;


use entity\IndexPage;

class AdminIndexPageBuilder extends IndexPageBuilder
{
    /**
     * @return IndexPage
     */
    public function build(): IndexPage
    {
        return new IndexPage('Это админка, детка!');
    }
}