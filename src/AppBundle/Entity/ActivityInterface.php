<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 27/10/2016
 * Time: 13:03
 */

namespace AppBundle\Entity;


interface ActivityInterface
{
    /**
     * @return User
     */
    public function getUser();
}