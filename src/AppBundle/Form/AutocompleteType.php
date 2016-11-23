<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 23/11/2016
 * Time: 22:23
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class AutocompleteType extends AbstractType
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router= $router;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $route = $options['route'];

        $view->vars['route'] = $this->router->generate($route);
        $view->vars['include_js'] = $options['include_js'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('route');

        $resolver->setDefaults([
            'include_js' => false,
            'route' => ''
        ]);

        $resolver->setAllowedTypes('route', 'string');
    }

    public function getBlockPrefix()
    {
        return 'auto_complete';
    }

    public function getParent()
    {
        return TextType::class;
    }

}