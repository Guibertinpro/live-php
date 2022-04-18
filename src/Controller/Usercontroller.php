<?php

namespace App\Controller;

use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManager;

class UserController
{
  public function create(EntityManager $entityManager)
  {
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
  }

}