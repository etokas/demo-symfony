<?php

namespace AppBundle\Controller;


use AppBundle\AppEvents;
use AppBundle\Entity\User;
use AppBundle\Events\UserEvent;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request)
    {

        if ($request->isMethod('post')){


        }

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
            $dispatcher->dispatch(AppEvents::USER_REGISTER, $event);

            if (null != $response = $event->getResponse()){
                return $response;
            }
        }

        return $this->render('AppBundle:CRUD:applicant.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @param Request $request
     * @Route("/some/router", name="some_route")
     */
    public function someRouteAction(Request $request)
    {
        return $this->json('success');
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
            $dispatcher->dispatch(AppEvents::USER_REGISTER, $event);

            if (null != $response = $event->getResponse()){
                return $response;
            }
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
