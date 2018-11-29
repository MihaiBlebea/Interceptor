<?php

namespace Interceptor\Interfaces;

use Closure;


interface RouteInterface
{
    public static function get(
        String $path,
        $callback,
        MiddlewareInterface $middleware = null);

    public static function post(
        String $path,
        $callback,
        MiddlewareInterface $middleware = null);

    public function __construct(
        String $path,
        $callback,
        String $method,
        MiddlewareInterface $middleware = null);

    public function getPath();

    public function getMethod();

    public function before(MiddlewareInterface $middleware);

    public function applyMiddleware(RequestInterface $request);

    public function hasMiddleware();

    public function trigger($params);
}
