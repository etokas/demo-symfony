<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 28/10/2016
 * Time: 22:15
 */

namespace AppBundle\Listeners;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class DoctrineSubscriber implements EventSubscriber
{

    public function getSubscribedEvents()
    {
        return [
            'postPersist',
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {

    }
}