<?php

namespace Kadeke\TravelBundle\Helper\Menu;

use Kunstmaan\AdminBundle\Helper\Menu\MenuAdaptorInterface;
use Kunstmaan\AdminBundle\Helper\Menu\MenuBuilder;
use Kunstmaan\AdminBundle\Helper\Menu\MenuItem;
use Kunstmaan\AdminBundle\Helper\Menu\TopMenuItem;
use Symfony\Component\HttpFoundation\Request;

class TravelMenuAdaptor implements MenuAdaptorInterface
{
    public function adaptChildren(MenuBuilder $menu, array &$children, MenuItem $parent = null, Request $request = null)
    {
        if (!is_null($parent) && 'KunstmaanAdminBundle_modules' == $parent->getRoute()) {
            // Page
            $menuitem = new TopMenuItem($menu);
            $menuitem->setRoute('KadekeTravelBundle_admin_travel_travelpage');
            $menuitem->setInternalName('Travel');
            $menuitem->setParent($parent);
            if (stripos($request->attributes->get('_route'), $menuitem->getRoute()) === 0) {
                $menuitem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuitem;
            // Author
            $menuitem = new TopMenuItem($menu);
            $menuitem->setRoute('KadekeTravelBundle_admin_travel_travelauthor');
            $menuitem->setInternalName('Travel Authors');
            $menuitem->setParent($parent);
            if (stripos($request->attributes->get('_route'), $menuitem->getRoute()) === 0) {
                $menuitem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuitem;
        }
    }
}
