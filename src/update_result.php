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
if ($options_size < 3 || $options_size > 4) {
    $fich = basename(__FILE__);
    echo "Usage: $fich <resultId> <result> [<timestamp>] [--json]";

    exit(0);
}
$resultId = $options[1];
$result = $options[2];
$timestamp = $options[3] ?? new DateTime('now');


$result = new Result($newResult, $result, $newTimestamp);
try {
    $resultService = new UserService();
    $resultService->update($resultId, $result);

    if (null === $result) {
        echo 'No existe Resultado con id: ' . $resultId;
        exit(0);
    }

    echo 'Actualizado Resultado:' . PHP_EOL;
    if (!$jsonFlag) {
        echo $result . PHP_EOL;
    } else {
        echo json_encode($result, JSON_PRETTY_PRINT) . PHP_EOL;
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

