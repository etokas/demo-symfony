<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 27/10/2016
 * Time: 14:50
 */

namespace AppBundle\Manager;


use AppBundle\Entity\UserInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserManger
{
    /** @var  ObjectManager */
    private $manager;
    /**
     * UserManger constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    public function storeUser(UserInterface $user)
    {
        //$this->manager->persist($user);
    }
}
