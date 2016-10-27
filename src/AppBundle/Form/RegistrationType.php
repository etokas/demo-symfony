<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 27/10/2016
 * Time: 13:21
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('name')
            ->add('firstname')
            ->add('lastname')
            ->add('birthday')
            ->add('city')
            ->add('postcode');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            $form = $event->getForm();
           switch ($form->getConfig()->getName()) {
               case User::APPLICANT:
                   $form->add(User::APPLICANT, ApplicantType::class);
                   break;
               case User::SCHOOL:
                   $form->add(User::SCHOOL, SchoolType::class);
                   break;
           }

           $form->add('Envoyer', SubmitType::class);

        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}