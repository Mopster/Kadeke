<?php

namespace Kadeke\WebsiteBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent,
    Symfony\Component\HttpKernel\Event\FilterResponseEvent,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Cookie;

/*
 * Intercept all requests and sets the language in a session when the URL contains a language.
 *
 * Splash page redirection is still done in the DefaultController because it doesn't rewrite the URL's.
 * If it's possible to do the same through a FilterControllerEvent Listener it should be done here.
 */
class LanguageListener
{
    private $acceptedLanguages = array('nl', 'en');

    /**
     * Write the language to a cookie so the language is kept even when the session cache is reset.
     * Basically keeps the cookie in sync with the language session, except that
     * if the session language is empty the cookie will remain.
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event) {
        $request = $event->getRequest();
        $locale = $request->getLocale();
        $cookielocale = $request->cookies->get('kd_language');

        if ($locale != $cookielocale && $this->localeInAcceptedLanguages($locale, $this->acceptedLanguages)) {
            $response = $event->getResponse();
            $response->headers->setCookie(new Cookie('kd_language', $locale, date('Y-m-d', strtotime(date("Y-m-d", time()) . " + 365 day"))));
            $event->setResponse($response);
        }
    }

    /**
     * @param string $locale
     * @return boolean
     */
    private function localeInAcceptedLanguages($locale) {
        return in_array($locale, $this->acceptedLanguages);
    }
}