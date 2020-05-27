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

    const LOGIN = 'root';
    const PASSWORD = 'gabi';

    public static function basicAuth()
    {
        if (!empty($_SERVER['AUTH_TYPE'])) {
            if ('Basic' == $_SERVER['AUTH_TYPE']) {
                $login = $_SERVER['PHP_AUTH_USER'];
                $password = $_SERVER['PHP_AUTH_PW'];

                if (self::LOGIN == $login && self::PASSWORD == $password) {
                    return true;
                }
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public static function isAftaa()
    {
        $isAdmin = self::basicAuth();
        //$isAdmin &= !empty($_REQUEST[self::GET_KEY]);
        $isAdmin &= self::checkIPs();
        return $isAdmin;
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
