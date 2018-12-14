<?php declare(strict_types=1);

namespace MiW\Results;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = Utils::loadEnvFile(__DIR__ . '/..');

error_reporting(E_ALL);

$environment = 'development';

/*
 * Register the error handler
 */
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

/*
 * sets up the Request and Response objects that you can use in your other classes
 */
$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse;



/*
 * conf Router
 */
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Controller/Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

/*
 * conf Render Engine Moustache
 *
$renderEngine = new \Mustache_Engine([
    ':options' => [
        'loader' => new \Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
            'extension' => '.html',
        ]),
    ]);
*/

$loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
$renderEngine = new \Twig_Environment($loader, []);

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $controller = $routeInfo[1];
        $vars = $routeInfo[2];
        $controller->process($request, $response, $renderEngine, $vars);
        break;
}



/*
 * send the response data to the browser
 */
foreach ($response->getHeaders() as $header) {
    header($header, false);
}
echo $response->getContent();