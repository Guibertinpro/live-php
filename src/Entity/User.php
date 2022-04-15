<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */

class User {

  /** 
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
  */
  private int $id;

  /** 
   * @ORM\Column(type="string", length=255)
  */
  private string $name;

  /** 
   * @ORM\Column(type="string", length=255)
  */
  private string $firstname;

  /** 
   * @ORM\Column(type="string", length=255)
  */
  private string $username;

  /** 
   * @ORM\Column(type="string", length=255)
  */
  private string $password;

  /** 
   * @ORM\Column(type="string", length=255)
  */
  private string $email;

  /** 
   * @ORM\Column(type="datetime", nullable=true)
  */
  private DateTime $birthDate;

  
  public function getId()
  {
    return $this->id;
  } 

  
  public function getName()
  {
    return $this->name;
  }

  
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  
  public function getFirstname()
  {
    return $this->firstname;
  }

   
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;

    return $this;
  }

 
  public function getUsername()
  {
    return $this->username;
  }

 
  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

   
  public function getPassword()
  {
    return $this->password;
  }

  
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

   
  public function getEmail()
  {
    return $this->email;
  }

  
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  
  public function getBirthDate()
  {
    return $this->birthDate;
  }

 
  public function setBirthDate($birthDate)
  {
    $this->birthDate = $birthDate;

    return $this;
  }
}