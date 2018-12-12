<?php
/**
 * PHP version 7.2
 * src/list_results.php
 *
 * @category Scripts
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\Result;
use MiW\Results\Utils;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = Utils::loadEnvFile(__DIR__ . '/..');

$resultService = new \MiW\Results\Service\ResultService();
$results = $resultService->findAll();

if ($argc === 1) {
    $items = 0;
    echo PHP_EOL
        . sprintf('%3s - %3s - %s - %22s', 'Id', 'res', 'time', 'username')
        . PHP_EOL;

    /* @var Result $result */
    foreach ($results as $result) {
        echo sprintf('%3s - %3s - %s - %22s',
                $result->getId(),
                $result->getResult(),
                $result->getUser()->getUsername(),
                $result->getTimeFormatted()) . PHP_EOL;
        $items++;
    }
    echo PHP_EOL . "Total: $items results.";
} elseif (in_array('--json', $argv, true)) {
    echo json_encode($results, JSON_PRETTY_PRINT);
}
