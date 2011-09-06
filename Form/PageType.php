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
            ->add('author')
            ->add('title')
            ->add('body')
            ->add('unique_title')
            ->add('slug')
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
