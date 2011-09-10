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
            ->add('user')
            ->add('title')
            ->add('body')
            ->add('unique_title')
            ->add('home')
            ->add('status')
            ->add('pageCategory')
        ;
    }

    public function getName()
    {
        return 'msi_cms_bundle_ContentBundle_pagetype';
    }
}
