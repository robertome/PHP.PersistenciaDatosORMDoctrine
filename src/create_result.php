<?php
/**
 * PHP version 7.2
 * src\create_result.php
 *
 * @category Utils
 * @package  MiW\Results
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;
use MiW\Results\Service\ResultService;
use MiW\Results\Service\UserService;
use MiW\Results\Utils;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = Utils::loadEnvFile(__DIR__ . '/..');

$options = array_values(array_filter($argv, function($value) { return '--json' !== $value; }));
$options_size = count($options);
$jsonFlag = $argc != $options_size;
if ($options_size < 3 || $options_size > 4) {
    $fich = basename(__FILE__);
    echo "Usage: $fich <result> <userId> [<timestamp>] [--json]";

    exit(0);
}
$newResult = (int)$options[1];
$userId = (int)$options[2];
$newTimestamp = $options[3] ?? new DateTime('now');


/** @var User $user */
$userService = new UserService();
$user = $userService->findById($userId);
if (null === $user) {
    echo "Usuario $userId no encontrado" . PHP_EOL;
    exit(0);
}

$result = new Result($newResult, $user, $newTimestamp);
try {
    $resultService = new ResultService();
    $resultService->create($result);

    echo 'Creado Resultado:';
    if (!$jsonFlag) {
        echo $result . PHP_EOL;
    } else {
        echo json_encode($result, JSON_PRETTY_PRINT) . PHP_EOL;
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
