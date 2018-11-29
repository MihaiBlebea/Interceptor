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
        $callback,
        MiddlewareInterface $middleware = null)
    {
        return new static ($path, $callback, 'GET', $middleware);
    }

    public static function post(
        String $path,
        $callback,
        MiddlewareInterface $middleware = null)
    {
        return new static ($path, $callback, 'POST', $middleware);
    }

    public function __construct(
        String $path,
        $callback,
        String $method,
        MiddlewareInterface $middleware = null)
    {
        if(!is_callable($callback) && !is_string($callback))
        {
            throw new \Exception('Callback attribute must be a closure or a string describing a class and method', 1);
        }
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
        if(is_callable($this->callback))
        {
            return call_user_func_array($this->callback, $params);

        } elseif(is_string($this->callback)) {

            if(strpos($this->callback, '@') == false)
            {
                throw new \Exception('String passed as Controller@method is invalid', 1);
            }

            $callback_parts = explode('@', $this->callback);
            $class  = new $callback_parts[0]();
            $method = $callback_parts[1];

            return call_user_func_array(array($class, $method), $params);
        } else {
            throw new \Exception('Could not trigger route. You must pass a callback or a controller class', 1);
        }
    }
}
