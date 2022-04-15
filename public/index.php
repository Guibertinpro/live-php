<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = ['src/Entity'];
$isDevMode = true;

$dbParams = [
  'driver'   => 'pdo_mysql',
  'host'     => '127.0.0.1',
  'port'     => '8889',
  'user'     => 'root',
  'password' => 'root',
  'dbname'   => 'live-php',
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);