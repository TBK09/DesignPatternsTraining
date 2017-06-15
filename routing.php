<?php
/**
 * Class ${NAME}
 */

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Aura\Router\RouterContainer;
use Symfony\Component\HttpFoundation\RequestStack;
use Routing\AuraUrlMatcherAdapter;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;

$request = Request::create('/');

$routes = new RouteCollection();
$routes->add('homepage', new Route('/'));
$routes->add('articles', new Route('/articles'));

$context = new RequestContext();
$context->fromRequest($request);
$router = new UrlMatcher($routes, $context);

$requestStack = new RequestStack();
$requestStack->push($request);
$container = new RouterContainer();
$router = new AuraUrlMatcherAdapter($routes, new DiactorosFactory(), $container, $requestStack);


(new Application($router))
    ->handle($request)
    ->prepare($request)
    ->send()
;