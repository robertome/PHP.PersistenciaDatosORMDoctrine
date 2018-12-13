<?php
/**
 * PHP version 7.2
 *
 * @category Scripts
 */

use MiW\Results\Entity\Result;
use MiW\Results\Service\ResultService;
use MiW\Results\Utils;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = Utils::loadEnvFile(__DIR__ . '/..');

$options = array_values(array_filter($argv, function ($value) {
    return '--json' !== $value;
}));
$options_size = count($options);
$jsonFlag = $argc != $options_size;
if ($options_size < 3 || $options_size > 4) {
    $fich = basename(__FILE__);
    echo "Usage: $fich <resultId> <result> [<dateTime (YYYY-MM-DDTHH:mm:ss)>] [--json]";

    exit(0);
}
$resultId = (int)$options[1];
$newResult = (int)$options[2];
$dateTime = new DateTime('now');
try {
    $dateTime = !empty($options[3]) ? new DateTime($options[3]) : $dateTime;
} catch (Exception $exception) {
    echo 'Formato del parametro <dateTime> inesperado: ' . $exception->getMessage() . PHP_EOL;
    exit(0);
}


$result = new Result($newResult, null, $dateTime);
try {
    $resultService = new ResultService();
    $result = $resultService->update($resultId, $result);

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

