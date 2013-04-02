<?php

namespace Kadeke\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogEntryAdminType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text');
        $builder->add('author');
        $builder->add(
            'date',
            'datetime',
            array(
                'required' => true,
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'date_format' => 'dd/MM/yyyy'
            )
        );
        $builder->add('tags', 'kunstmaan_taggingbundle_tags');

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