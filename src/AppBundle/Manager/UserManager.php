<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 27/10/2016
 * Time: 14:50
 */

namespace AppBundle\Manager;


use AppBundle\AppEvents;
use AppBundle\Entity\User;
use AppBundle\Events\GetUserEvent;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UserManager
{
    /** @var  ObjectManager */
    private $manager;

    /** @var  EventDispatcherInterface */
    private $dispatcher;

    /**
     * UserManger constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager, EventDispatcherInterface $dispatcher)
    {
        $this->manager = $manager;
        $this->dispatcher = $dispatcher;
    }


    public function storeUser(User $user)
    {
        $event = new GetUserEvent($user);
        $this->dispatcher->dispatch(AppEvents::PRE_PERSIST, $event);
        $this->manager->persist($event->getUser());
        $this->manager->flush();
    }
}
