<?php

namespace Kadeke\WebsiteBundle\PagePartAdmin;

use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;

class ContentPagePagePartAdminConfigurator extends AbstractPagePartAdminConfigurator
{

    /**
     * @var array
     */
    protected $pagePartTypes;

    /**
     * @param array $pagePartTypes
     */
    public function __construct(array $pagePartTypes = array())
    {
        $this->pagePartTypes = array_merge(
            array(
                array(
                    'name' => 'Header',
                    'class'=> 'Kunstmaan\PagePartBundle\Entity\HeaderPagePart'
                ),
                array(
                    'name' => 'Text',
                    'class'=> 'Kunstmaan\PagePartBundle\Entity\TextPagePart'
                ),
                array(
                    'name' => 'Line',
                    'class'=> 'Kunstmaan\PagePartBundle\Entity\LinePagePart'
                ),
                array(
                    'name' => 'TOC',
                    'class'=> 'Kunstmaan\PagePartBundle\Entity\TocPagePart'
                ),
                array(
                    'name' => 'Link',
                    'class'=> 'Kunstmaan\PagePartBundle\Entity\LinkPagePart'
                ),
                array(
                    'name' => 'To Top',
                    'class'=> 'Kunstmaan\PagePartBundle\Entity\ToTopPagePart'
                ),
                array(
                    'name' => 'Image',
                    'class'=> 'Kunstmaan\MediaPagePartBundle\Entity\ImagePagePart'
                ),
                array(
                    'name' => 'Download',
                    'class'=> 'Kunstmaan\MediaPagePartBundle\Entity\DownloadPagePart'
                ),
                array(
                    'name' => 'Slide',
                    'class'=> 'Kunstmaan\MediaPagePartBundle\Entity\SlidePagePart'
                ),
                array(
                    'name' => 'Video',
                    'class'=> 'Kunstmaan\MediaPagePartBundle\Entity\VideoPagePart'
                )
            ), $pagePartTypes
        );

    }

    /**
     * @return array
     */
    function getPossiblePagePartTypes()
    {
        return $this->pagePartTypes;
    }

    /**
     * @return string
     */
    function getName()
    {
        return "Page parts";
    }

    /**
     * @return string
     */
    function getContext()
    {
        return "main";
    }
}
