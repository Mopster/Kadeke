<?php

namespace Kadeke\BlogBundle\Form;

use Kadeke\WebsiteBundle\Form\AbstractContentPageAdminType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogAdminType extends AbstractContentPageAdminType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kadeke\BlogBundle\Entity\Blog'
        ));
    }

    public function getName()
    {
        return 'blog';
    }
}