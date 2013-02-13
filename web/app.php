<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Use APC for autoloading to improve performance
$loader = new ApcClassLoader('kadeke', $loader);
$loader->register(true);

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
if (!isset($_SERVER['HTTP_SURROGATE_CAPABILITY']) || false === strpos($_SERVER['HTTP_SURROGATE_CAPABILITY'], 'ESI/1.0')) {
    require_once __DIR__.'/../app/AppCache.php';
    $kernel = new AppCache($kernel);
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
