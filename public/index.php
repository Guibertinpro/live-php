<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Entity\User;
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

$user = new User();

$user->setName("BERTIN")
  ->setFirstname("Guillaume")
  ->setUsername("Bob sinclar")
  ->setPassword(password_hash('test', PASSWORD_BCRYPT))
  ->setEmail("bob@gmail.com")
  ->setBirthDate(new DateTime('1991-07-18'));

  var_dump($user);

  $entityManager->persist($user);
  $entityManager->flush();