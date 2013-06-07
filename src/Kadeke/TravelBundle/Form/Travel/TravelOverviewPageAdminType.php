<?php

namespace Kadeke\TravelBundle\Form\Travel;

use Kunstmaan\ArticleBundle\Form\AbstractArticleOverviewPageAdminType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * The admin type for Traveloverview pages
 */
class TravelOverviewPageAdminType extends AbstractArticleOverviewPageAdminType
{

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kadeke\TravelBundle\Entity\Travel\TravelOverviewPage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'TravelOverviewPage';
    }
}
