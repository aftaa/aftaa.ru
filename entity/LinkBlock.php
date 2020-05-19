<?php

namespace entity;


use vo\LinkInterface;

class LinkBlock
{
    private $name = '';

    /** @var LinkInterface[] */
    protected $links = [];

    /**
     * LinkBlock constructor.
     *
     * @param string $name
     * @param LinkInterface[]|null $links
     */
    public function __construct(string $name, $links = null)
    {
        $this->name = $name;
        if (null !== $links) {
            $this->links = $links;
        }
    }


    /**
     * @param LinkInterface $link
     */
    public function addLink(LinkInterface $link)
    {
        $this->links[$link->getName()] = $link;
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
