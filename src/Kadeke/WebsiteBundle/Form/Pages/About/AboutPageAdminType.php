<?php

namespace Kadeke\WebsiteBundle\Form\Pages\About;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kadeke\WebsiteBundle\Form\AbstractContentPageAdminType;

/**
 * The admin type for content pages
 */
class AboutPageAdminType extends AbstractContentPageAdminType
{

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kadeke\WebsiteBundle\Entity\Pages\About\AboutPage'
        ));
    }

}