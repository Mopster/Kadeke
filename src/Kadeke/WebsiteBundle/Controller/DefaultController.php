<?php

namespace Kadeke\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="kadekewebsitebundle_default")
     *
     * @return Response
     */
    public function indexAction()
    {
        $request = $this->getRequest();

        $locale = $request->cookies->get('kd_language');

        // check if the current locale is in the accepted languages.
        if ($this->isLanguageAllowed($locale)) {
            // if so redirect to the page in the requested language.
            return $this->redirect($this->generateUrl('_slug', array('_locale' => $locale)), 302);
        }

        return $this->render('KadekeWebsiteBundle:LanguageChooser:view.html.twig');
    }

    /**
     * @param $locale
     * @return boolean
     */
    private function isLanguageAllowed($locale) {
        $acceptedLanguages = explode('|', $this->container->getParameter('requiredlocales'));
        return in_array($locale, $acceptedLanguages);
    }
}
