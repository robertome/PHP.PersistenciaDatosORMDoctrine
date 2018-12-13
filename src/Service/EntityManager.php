<?php
/**
 * Created by PhpStorm.
 * User: rmartine
 * Date: 13/12/2018
 * Time: 0:38
 */

namespace MiW\Results\Service;


use MiW\Results\Utils;

class EntityManager
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = Utils::getEntityManager();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

}