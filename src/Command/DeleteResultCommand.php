<?php
/**
 * Created by PhpStorm.
 * User: rmartine
 * Date: 12/12/2018
 * Time: 0:01
 */

namespace MiW\Results\Command;


class CreateResultCommand
{
    private $argv;

    /**
     * CreateResultCommand constructor.
     * @param $argv
     */
    public function __construct(array $argv)
    {
        $this->argv = $argv;
    }


    public function run()
    {

    }

}