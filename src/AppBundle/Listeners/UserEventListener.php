<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 27/10/2016
 * Time: 14:10
 */

namespace AppBundle\Listeners;


use AppBundle\AppEvents;
use AppBundle\Events\UserEvent;
use AppBundle\Manager\UserManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserEventListener implements EventSubscriberInterface
{
    /** @var ContainerInterface  */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvents::APPLICANT_REGISTER => 'applicantRegister',
            AppEvents::SCHOOL_REGISTER => 'schoolRegister'
        ];
    }

    public function applicantRegister(UserEvent $event)
    {
        $activity = $event->getActivity();

        $user = $activity->getUser();

        $this->userManager()->storeUser($user);
    }

    public function schoolRegister(UserEvent $event)
    {
        $activity = $event->getActivity();

        $user = $activity->getUser();

        $this->userManager()->storeUser($user);
    }

    /**
     * @return UserManager
     */
    public function userManager()
    {
        return $this->container->get('user_manager');
    }

}
