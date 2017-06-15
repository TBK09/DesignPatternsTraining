<?php

namespace Routing;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Aura\Router\RouterContainer;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;


/**
 * Class AuraUrlMatcherAdapter
 */
class AuraUrlMatcherAdapter implements UrlMatcherInterface
{
    /**
     * @var RouterContainer
     */
    private $aura;

    private $requestStack;

    private $routes;

    private $factory;

    private $initialized;

    public function __construct(
        RouteCollection $routes,
        DiactorosFactory $factory,
        RouterContainer $aura,
        RequestStack $requestStack
    ) {
        $this->aura = $aura;
        $this->requestStack = $requestStack;
        $this->routes = $routes;
        $this->factory = $factory;
        $this->initialized = false;
    }

    public function setContext(RequestContext $context)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function getContext()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function match($pathinfo)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        $request = $this->factory->createRequest($this->requestStack->getCurrentRequest());
        $matcher = $this->aura->getMatcher();
        if (!$route = $matcher->match($request)) {
            throw new ResourceNotFoundException('Unable to match route.');
        }

        return array_merge(['_route' => $route->name], $route->attributes);
    }

    private function initialize()
    {
        $map = $this->aura->getMap();
        foreach ($this->routes as $name => $route) {
            $map->route($name, $route->getPath())
                ->secure(in_array('https', $route->getSchemes()))
                ->attributes($route->getDefaults())
                ->allows($route->getMethods())
            ;
        }

        $this->initialized = true;
    }
}
