<?php

namespace factory;


use vo\Favicon;
use vo\Icon;

class IconFactory
{
    /**
     * @param bool|string|null $icon
     * @param string           $href
     *
     * @return Icon|null
     */
    public static function getIcon($icon, string $href)
    {
        if ("auto" == $icon) {
            return new Favicon($href);
        }
        if ($icon) {
            return new Icon($icon);
        }
        return null;
    }

}