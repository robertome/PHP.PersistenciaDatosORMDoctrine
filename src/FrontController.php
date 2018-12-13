<?php declare(strict_types=1);

namespace MiW\Results;

require __DIR__ . '/../vendor/autoload.php';

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
 * send the response data to the browser
 */
foreach ($response->getHeaders() as $header) {
    header($header, false);
}
echo $response->getContent();