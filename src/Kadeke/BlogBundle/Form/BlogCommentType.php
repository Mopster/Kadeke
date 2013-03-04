<?php

namespace Kadeke\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BlogCommentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text');
        $builder->add('name');
        $builder->add('email');
        $builder->add('website');
    }

    public function getName()
    {
        return "blogcomment_user_form";
    }

}
