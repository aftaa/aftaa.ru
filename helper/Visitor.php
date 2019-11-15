<?php

namespace helper;


/**
 * Class Visitor
 *
 * @package helper
 */
class Visitor
{
    const GET_KEY = 'aftaa';
    const MY_IPS = [
        '128.0.142.30',
		'51.158.124.216', // FR
        // '95.165.213.226', //softmg
        // '37.228.89.179',  //softmg
//        '127.0.0.1',
//        '77.120.106.94',
//        '212.224.118.16', //Germany VPN
//        '51.158.124.216', //Fornex VPN
    ];

    /**
     * @return bool
     */
    public static function isAftaa()
    {
        $isAftaa = !empty($_REQUEST[self::GET_KEY]);
        $isAftaa = $isAftaa && self::checkIPs();
        return $isAftaa;
    }

    /**
     * @return bool
     */
    private static function checkIPs(): bool
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        return in_array($ip, self::MY_IPS);
    }
}
