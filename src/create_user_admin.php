<?php
/**
 * PHP version 7.2
 * src\create_user_admin.php
 *
 * @category Utils
 * @package  MiW\Results
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\User;
use MiW\Results\Utils;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(
    __DIR__ . '/..',
    Utils::getEnvFileName(__DIR__ . '/..')
);
$dotenv->load();

$entityManager = Utils::getEntityManager();

$result = new User();
$result->setUsername($_ENV['ADMIN_USER_NAME']);
$result->setEmail($_ENV['ADMIN_USER_EMAIL']);
$result->setPassword($_ENV['ADMIN_USER_PASSWD']);
$result->setEnabled(true);
$result->setIsAdmin(true);

try {
    $entityManager->persist($result);
    $entityManager->flush();
    echo 'Created Admin User with ID #' . $result->getId() . PHP_EOL;
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
