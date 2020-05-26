<?php

spl_autoload_register(function($class) {
    $class = str_replace('\\', '/', $class);
    $class = __DIR__ . "/../$class";
    $class .= '.php';
    try {
        require_once $class;
    } catch (Exception $e) {
        throw $e;
    }
});
