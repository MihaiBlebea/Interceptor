<?php

namespace Interceptor;

use Closure;
use Interceptor\Interfaces\RouteInterface;
use Interceptor\Interfaces\MiddlewareInterface;
use Interceptor\Interfaces\RequestInterface;


class Route implements RouteInterface
{
    private $path;

    private $callback;

    private $method;


    public static function get(
        String $path,
        Closure $callback,
        MiddlewareInterface $middleware = null)
    {
        return new static ($path, $callback, 'GET', $middleware);
    }

    public static function post(
        String $path,
        Closure $callback,
        MiddlewareInterface $middleware = null)
    {
        return new static ($path, $callback, 'POST', $middleware);
    }

    public function __construct(
        String $path,
        Closure $callback,
        String $method,
        MiddlewareInterface $middleware = null)
    {
        $this->path       = $path;
        $this->callback   = $callback;
        $this->middleware = $middleware;
        $this->method     = $method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function before(MiddlewareInterface $middleware)
    {
        $this->middleware = $middleware;
    }

    public function applyMiddleware(RequestInterface $request)
    {
        if($this->hasMiddleware())
        {
            return $this->middleware->run($request);
        }
        return true;
    }

    public function hasMiddleware()
    {
        return $this->middleware !== null;
    }

    public function trigger($params)
    {
        return call_user_func_array($this->callback, $params);
    }
}
