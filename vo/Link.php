<?php

namespace vo;


/**
 * Class Link
 *
 * @package vo
 */
class Link implements LinkInterface
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $href = '';

    /** @var bool */
    public $private = false;

    /** @var Icon */
    public $icon;

    /**
     * Link constructor.
     * @param string $name
     * @param string $href
     * @param bool|null $private
     * @param IFavicon $icon
     */
    public function __construct(string $name, string $href, bool $private, IFavicon $icon)
    {
        $this->name = $name;
        $this->href = $href;
        $this->private = $private ?? $private;
        $this->icon = $icon->getHref();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->private;
    }

    /**
     * @return IFavicon|null
     */
    public function getIcon(): IFavicon
    {
        return $this->icon;
    }
}
