<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Applicant;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View as FOSView;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class DefaultController extends FOSRestController
{
    /**
     * @View()
     * @POST("/user")
     * @param Request $request
     */
    public function userAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->submit($request->request->all());

        if ($form->isValid()){

            return $user;
        }

        return $form;
    }
}
