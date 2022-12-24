<?php


namespace Doctor\PhpPro\ORM\DataMapper\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctor\PhpPro\ORM\DataMapper\Repositories\UserRepository;

#[ORM\Entity()]
#[ORM\Table(name: 'phones')]
class Phone
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'phones')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id' )]
    private User $user;


    #[ORM\Column(length: 12)]
    private string $phone;

    /**
     * Phone constructor.
     * @param User $user
     * @param string $phone
     */
    public function __construct(User $user,string $phone)
    {
     $this->user =$user;
     $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}