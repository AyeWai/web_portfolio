<?php

namespace App\Entity;

use App\Repository\User2Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=User2Repository::class)
 */
class User2
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     * @Assert\Length(min=5)
     */
    private $username;

   

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\Length(max=8)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /*public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(?\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }*/

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
