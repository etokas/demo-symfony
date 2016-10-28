<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 27/10/2016
 * Time: 21:24
 */

namespace AppBundle\Listeners;


use AppBundle\AppEvents;
use AppBundle\Events\GetUserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            AppEvents::USER_REGISTER => 'onRegister'
        ];
    }

    public function onRegister(GetUserEvent $event)
    {
        $user = $event->getUser();

        // Authentifier l'utilisateur dans symfony
    }

}