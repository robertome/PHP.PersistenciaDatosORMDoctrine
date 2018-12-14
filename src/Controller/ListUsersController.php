<?php

namespace MiW\Results\Controller;


use MiW\Results\Service\UserService;

class ListUsersController implements Controller
{

    private $userService;

    /**
     * ListUsersController constructor.
     * @param $usersService
     */
    public function __construct()
    {
        $this->userService = new UserService();
    }

    function process($request, $response, $renderEngine, $vars): void
    {
        $data = array('users' => $this->userService->findAll());
        $response->setContent($renderEngine->render('list-users.html', $data));
    }
}