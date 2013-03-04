<?php

namespace Kadeke\BlogBundle\Form;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * The type for TestEntity
 */
class BlogCommentAdminType extends AbstractType {

    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting form the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text');
        $builder->add('name');
        $builder->add('email');
        $builder->add('website');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    function getName() {
        return "blogcomment_form";
    }

}