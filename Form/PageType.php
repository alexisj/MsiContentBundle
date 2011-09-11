<?php

namespace Msi\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('layout')
            ->add('title')
            ->add('body')
            ->add('unique_title')
            ->add('homepage', null, array('required' => false))
            ->add('published', null, array('required' => false))
            ->add('pageCategory')
        ;
    }

    public function getName()
    {
        return 'page';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Msi\ContentBundle\Entity\Page',
        );
    }
}
