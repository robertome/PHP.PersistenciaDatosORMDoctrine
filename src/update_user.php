<?php
/**
 * PHP version 7.2
 *
 * @category Scripts
 */

use MiW\Results\Entity\User;
use MiW\Results\ParamsUtils;
use MiW\Results\Service\UserService;
use MiW\Results\Utils;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = Utils::loadEnvFile(__DIR__ . '/..');

$options = array_values(array_filter($argv, function($value) { return '--json' !== $value; }));
$options_size = count($options);
$jsonFlag = $argc != $options_size;
if ($options_size < 5 || $options_size > 6) {
    $fich = basename(__FILE__);
    echo "Usage: $fich <userId> <username> <email> <password> [<enabled (true|false)>] [--json]";

    exit(0);
}
$userId = $options[1];
$username = $options[2];
$email = $options[3];
$password = $options[4];
$enabled = !empty($options[5]) ? ($options[5] === 'true') : false;


$user = new User($username, $email, $password, $enabled, false);
try {
    $userService = new UserService();
    $userService->update($userId, $user);

    if (null === $user) {
        echo 'No existe Usuario con id: ' . $userId;
        exit(0);
    }

    echo 'Actualizado Usuario:' . PHP_EOL;
    if (!$jsonFlag) {
        echo $user . PHP_EOL;
    } else {
        echo json_encode($user, JSON_PRETTY_PRINT) . PHP_EOL;
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

