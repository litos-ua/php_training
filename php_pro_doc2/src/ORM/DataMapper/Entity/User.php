<?php

namespace Doctor\PhpPro\ORM\DataMapper\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctor\PhpPro\ORM\DataMapper\Repositories\UserRepository;


#[ORM\Entity(repositoryClass:UserRepository::class)]
#[ORM\Table(name: 'users')]
class User
{
    const STATUS_DISABLED =1;
    const STATUS_ACTIVE =0;
    const STATUS_VIP =2;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(length: 12)]
    private string $login;

    #[ORM\Column(length: 32)]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Phone::class , fetch: 'EAGER')]
    private Collection $phones;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $status =0;

    #[ORM\Column(type: Types::INTEGER, nullable:true)]
    private ?int $age =0;

    /**
     * User constructor.
     * @param string $login
     * @param string $password
     * @param int $status
     */
    public function __construct($login, $password, int $status = self::STATUS_DISABLED)
    {
        $this->login = $login;
        $this->changePassword($password);
        $this->status = $status;
        $this->phones = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param mixed $login
     */
    public function changeLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function changePassword(string $password): void
    {
        $this->password = md5($password);
    }

}
