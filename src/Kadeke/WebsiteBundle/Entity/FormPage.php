<?php

namespace Kadeke\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Kunstmaan\FormBundle\Entity\AbstractFormPage;
use Kadeke\WebsiteBundle\Form\FormPageAdminType;
use Kadeke\WebsiteBundle\PagePartAdmin\FormPagePagePartAdminConfigurator;
use Kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;

/**
 * FormPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="kd_form_pages")
 */
class FormPage extends AbstractFormPage
{

    /**
     * Returns the default backend form type for this form
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new FormPageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            array(
                'name' => 'ContentPage',
                'class' => "Kadeke\WebsiteBundle\Entity\ContentPage"
            ),
            array (
                'name' => 'FormPage',
                'class' => "Kadeke\WebsiteBundle\Entity\FormPage"
            )
        );
    }

    /**
     * @return array
     */
    public function getPagePartAdminConfigurations()
    {
        return array(
            new FormPagePagePartAdminConfigurator(),
            new BannerPagePartAdminConfigurator()
        );
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "KadekeWebsiteBundle:FormPage:view.html.twig";
    }
}
