<?php

namespace entity;


use vo\LinkInterface;

class LinkBlock
{
    public $name = '';

    /** @var LinkInterface[] */
    public $links = [];

    /** @var int */
    public $count = 0;

    /** @var int  */
    public $colNum = 0;

    /**
     * LinkBlock constructor.
     * @param string $name
     * @param null $links
     */
    public function __construct($name, $colNum, $links = null)
    {
        $this->name = $name;
        $this->colNum = $colNum;
        if (null !== $links) {
            $this->count = count($links);
        }
    }


    /**
     * @param LinkInterface $link
     */
    public function addLink(LinkInterface $link)
    {
        $this->links[$link->getName()] = $link;
        $this->count++;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Link[]
     */
    public function getLinks(): array
    {
        return $this->ksort();
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return count($this->links);
    }

    /**
     * @return Link[]
     */
    private function ksort(): array
    {
        $links = $this->links;
        ksort($links);
        return $links;
    }
}
