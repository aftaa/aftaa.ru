<?php


namespace entity;

/**
 * Class IndexPage
 * @package entity
 */
class IndexPage
{
    public $title = 'Hello, aftaa!';

    /** @var LinkBlockDb[] */
    public $sections = [];

    /** @var array */
    public $creditCards = [];

    /**use builder\IndexPageBuilder;


     * IndexPage constructor.
     * @param string $title
     * @param array|LinkBlockDb[] $sections
     * @param array $creditCards
     */
    public function __construct(string $title, $sections, array $creditCards)
    {
        $this->title = $title;
        $this->sections = $sections;
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
     * @return LinkBlockDb[]
     */
    public function getSections(): array
    {
        return $this->sections;
    }

    /**
     * @param LinkBlockDb[] $sections
     * @return IndexPage
     */
    public function setSections(array $sections): IndexPage
    {
        $this->sections = $sections;
        return $this;
    }

    /**
     * @return false|string
     */
    public function getSectionAsJson()
    {
        $sections = $this->getSections();
        $sections = json_encode($sections);
        return $sections;
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
