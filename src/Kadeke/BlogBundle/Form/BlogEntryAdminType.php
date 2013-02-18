<?php

namespace Kadeke\BlogBundle\Form;

use Kadeke\WebsiteBundle\Form\AbstractContentPageAdminType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogEntryAdminType extends AbstractContentPageAdminType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text');
        $builder->add('author');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kadeke\BlogBundle\Entity\BlogEntry'
        ));
    }

    public function getName()
    {
        return 'blogentry';
    }
}