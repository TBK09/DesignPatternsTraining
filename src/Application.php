<?php

use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Class Application
 */
class Application implements HttpKernelInterface
{
    private $router;

    public function __construct(UrlMatcherInterface $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        try {
            $route = $this->router->match($request->getPathInfo());
        } catch (ResourceNotFoundException $e) {
            return new Response('Not found', 404);
        }

        return new Response(sprintf('Route matched: %s ' . "\n", $route['_route']));
    }


}