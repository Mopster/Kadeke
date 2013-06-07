<?php

namespace Kadeke\TravelBundle\Form\Travel;

use Kunstmaan\ArticleBundle\Form\AbstractAuthorAdminType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TravelAuthorAdminType extends AbstractAuthorAdminType {

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kadeke\TravelBundle\Entity\Travel\TravelAuthor'
        ));
    }

    /**
     * @return string
     */
    function getName() {
        return "Travelauthor_form";
    }

}