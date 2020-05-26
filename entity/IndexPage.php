<?php


namespace entity;

/**
 * Class IndexPage
 * @package entity
 */
class IndexPage
{
    public $title = 'Hello, aftaa!';

    /** @var array */
    public $creditCards = [];

    /**
     * IndexPage constructor.
     * @param $title
     * @param array $creditCards
     */
    public function __construct($title, array $creditCards = [])
    {
        $this->title = $title;
        $this->creditCards = $creditCards;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return IndexPage
     */
    public function setTitle(string $title): IndexPage
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return array
     */
    public function getCreditCards(): array
    {
        return $this->creditCards;
    }

    /**
     * @param array $creditCards
     * @return IndexPage
     */
    public function setCreditCards(array $creditCards): IndexPage
    {
        $this->creditCards = $creditCards;
        return $this;
    }
}
