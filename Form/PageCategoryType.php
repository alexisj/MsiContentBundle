<?php

namespace Msi\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageCategoryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('status')
            ->add('created')
            ->add('updated')
        ;
    }

    public function getName()
    {
        return 'msi_cms_bundle_ContentBundle_pagecategorytype';
    }
}
