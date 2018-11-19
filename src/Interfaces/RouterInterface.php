<?php

namespace Interceptor\Interfaces;


interface RouterInterface
{
    public function __construct(RequestInterface $request);

    public function next();

    public function run();

    public function add(RouteInterface $route, MiddlewareInterface $middleware = null);

    public function before(MiddlewareInterface $middleware);

    public function trigger(RouteInterface $route, Array $params);

    public function getPath(Int $index);

    public function getPaths();

    public function match();

    public function bind(RouteInterface $route);
}
