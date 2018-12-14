<?php
/**
 * Created by PhpStorm.
 * User: rmartine
 * Date: 14/12/2018
 * Time: 4:14
 */

namespace MiW\Results\Controller;


use MiW\Results\Entity\User;
use MiW\Results\Service\UserService;

class CreateUserController implements Controller
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
        $username = $request->getParameter('username');
        $email = $request->getParameter('email');
        $password = $request->getParameter('password');
        $enabled = !empty($request->getParameter('enabled', false));

        $user = new User($username, $email, $password, $enabled, false);
        $this->userService->create($user);

        $data = array('users' => $this->userService->findAll());
        $response->setContent($renderEngine->render('list-users.html', $data));
    }
}