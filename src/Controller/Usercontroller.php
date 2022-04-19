<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Twig\Environment;

class UserController
{
  public function create(EntityManager $em)
  {
    $user = new User();

    $user->setName("BERTIN")
      ->setFirstname("Guillaume")
      ->setUsername("Bob sinclar")
      ->setPassword(password_hash('test', PASSWORD_BCRYPT))
      ->setEmail("bob@gmail.com")
      ->setBirthDate(new DateTime('1991-07-18'));

      var_dump($user);

      $em->persist($user);
      $em->flush();
  }

  public function list(Environment $twig, UserRepository $userRepository)
  {
    // Récupérer tous les utilisateurs
    $users = $userRepository->findAll();


    // Transmettre la liste à la vue
    echo $twig->render('users/list.html.twig', ['users' => $users]);
  }

}