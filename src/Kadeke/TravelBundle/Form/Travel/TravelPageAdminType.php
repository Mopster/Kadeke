<?php

namespace Kadeke\TravelBundle\Form\Travel;

use Kunstmaan\ArticleBundle\Form\AbstractArticlePageAdminType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * The admin type for Travel pages
 */
class TravelPageAdminType extends AbstractArticlePageAdminType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kadeke\TravelBundle\Entity\Travel\TravelPage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'TravelPage';
    }
}
