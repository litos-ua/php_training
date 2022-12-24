<?php


namespace Doctor\PhpPro\ORM\DataMapper\Repositories;

use Doctor\PhpPro\ORM\DataMapper\Entity\Phone;
use Doctor\PhpPro\ORM\DataMapper\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;
use UnexpectedValueException;
use function Doctrine\ORM\leftJoin;


/**
 * @var UserRepository $userRepository
 */

class UserRepository extends EntityRepository
{
        public function findActiveUser()
        {
          return $this->findBy(['status' => User::STATUS_ACTIVE]);
        }

        public function getUserAllDateById(int $id): User
        {
            /**
             * @var User $user
             */
         $user = $this->findOneBy(['id' => $id]);
         $user->getPhones()->count();
         return $user;
        }

        public function getUserAllDateById2(int $id): User
        {
          $qb = $this->createQueryBuilder('u')
                     ->leftJoin(Phone::class,'p','WITH', 'p.user = u.id')
                     ->where('u.id = id:')
                     ->setParameter('id',$id)
                     ->setMaxResults(1);
          $sql = $qb->getQuery()->getSQL();
          $a=1;
          return $qb;
        }


        public function getByLogin (string  $logName)
        {
            $qb = $this->createQueryBuilder('u')
                ->where('u.login = :login')
                ->setParameter('login',$logName)
                ->orderBy('u.login', 'ASC');
            $query = $qb->getQuery();
            $sql = $query->getSQL();
            return $query->getResult();
        }

        public function getBanList()
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.status = :status')
            ->setParameter('status',1)
            ->orderBy('u.login', 'ASC');
        $query = $qb->getQuery();
        $sql = $query->getSQL();
        return $query->getResult();
    }

//    $qb->where('u.id = :id')
//    ->setParameter('id',10)
//    ->orderBy('u.login', 'ASC');
//    $query = $qb->getQuery();
//    $res=$query->getResult();
}