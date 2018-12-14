<?php

namespace MiW\Results\Controller;


use MiW\Results\Service\ResultService;

class ListResultsController implements Controller
{

    private $resultService;

    /**
     * ListResultsController constructor.
     * @param $resultService
     */
    public function __construct()
    {
        $this->resultService = new ResultService();
    }

    function process($request, $response, $renderEngine, $vars): void
    {
        $data = array('results' => $this->resultService->findAll());
        $response->setContent($renderEngine->render('list-results.html', $data));
    }
}