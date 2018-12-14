<?php declare(strict_types=1);

namespace MiW\Results\Controller;

return [
    ['GET', '/', new ListUsersController()],
    ['GET', '/list-users', new ListUsersController()],
    ['POST', '/create-user', new CreateUserController()],
    ['GET', '/list-results', new ListResultsController()],
];