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
        '127.0.0.1',
        '192.168.1.21',
        '172.16.1.2,'
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
        if ('172.16.1.2' == $ip) {
            return true;
        }
        return in_array($ip, self::MY_IPS);
    }
}
