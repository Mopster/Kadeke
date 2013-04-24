<?php

namespace Kadeke\TripBundle\Form\Pages\Trip;

use Kunstmaan\ArticleBundle\Form\AbstractArticlePageAdminType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * The admin type for Trip pages
 */
class TripPageAdminType extends AbstractArticlePageAdminType
{

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kadeke\TripBundle\Entity\Pages\Trip\TripPage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'TripPage';
    }
}
