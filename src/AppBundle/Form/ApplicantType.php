<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 27/10/2016
 * Time: 13:45
 */

namespace AppBundle\Form;


use AppBundle\Entity\Applicant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('name');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Applicant::class
            ]);
    }

}