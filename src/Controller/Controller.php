<?php

namespace MiW\Results\Controller;


interface Controller
{
    function process($request, $response, $renderEngine, $vars): void;
}