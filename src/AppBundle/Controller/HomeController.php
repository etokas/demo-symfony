<?php

namespace AppBundle\Controller;


use AppBundle\AppEvents;
use AppBundle\Entity\User;
use AppBundle\Events\UserEvent;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends CRUDController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function homeAction()
    {
        return $this->render('AppBundle:CRUD:new.html.twig');
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/demandeur", name="register_applicant")
     */
    public function applicantAction(Request $request)
    {
        /** @var FormFactory $factory */
        $factory = $this->get('form.factory');

        $user = new User();

        $form = $factory->createNamed(User::APPLICANT, RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isValid() && $request->isMethod('post')) {

            $dispatcher = $this->getDispatcher();
            $event = new UserEvent($user->getApplicant());
            $dispatcher->dispatch(AppEvents::APPLICANT_REGISTER, $event);
        }

        return $this->render('AppBundle:CRUD:applicant.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/ecole", name="register_school")
     */
    public function schoolAction(Request $request)
    {
        /** @var FormFactory $factory */
        $factory = $this->get('form.factory');

        $user = new User();

        $form = $factory->createNamed(User::SCHOOL, RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isValid() && $request->isMethod('post')) {

            $dispatcher = $this->getDispatcher();
            $event = new UserEvent($user->getSchool());
            $dispatcher->dispatch(AppEvents::SCHOOL_REGISTER, $event);
        }

        return $this->render('AppBundle:CRUD:school.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @return EventDispatcher
     */
    public function getDispatcher()
    {
        return $this->get('event_dispatcher');
    }
}
