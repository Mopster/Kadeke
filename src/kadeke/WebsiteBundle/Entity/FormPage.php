<?php

namespace kadeke\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Kunstmaan\FormBundle\Entity\AbstractFormPage;
use kadeke\WebsiteBundle\Form\FormPageAdminType;
use kadeke\WebsiteBundle\PagePartAdmin\FormPagePagePartAdminConfigurator;
use kadeke\WebsiteBundle\PagePartAdmin\BannerPagePartAdminConfigurator;

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
                'class' => "kadeke\WebsiteBundle\Entity\ContentPage"
            ),
            array (
                'name' => 'FormPage',
                'class' => "kadeke\WebsiteBundle\Entity\FormPage"
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
        return "kadekeWebsiteBundle:FormPage:view.html.twig";
    }
}
