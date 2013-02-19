<?php

namespace Kadeke\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BlogAuthorAdminType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    function getName() {
        return "blogauthor_form";
    }

}