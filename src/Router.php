<?php

namespace Interceptor;


class Router
{
    private $request;

    public $routes = [];

    public $middlewares = [];


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function next()
    {
        return true;
    }

    public function run()
    {
        // Run the middlewares
        foreach($this->middlewares as $middleware)
        {
            if(!$middleware(true))
            {
                throw new \Exception('Middleware failed to pass $next', 1);
            }
        }

        if(count($this->routes) === 0)
        {
            throw new \Exception('No route found. You need to add some routes', 1);
        }

        $found_match = $this->match();
        if($found_match === null)
        {
            throw new \Exception('Could not find any mathing route', 1);
        }

        // Add Request to the callback params
        $route_params[] = $this->request;

        // Add binded values to the callback params
        $route_params = array_merge($route_params, $this->bind($found_match));

        // Trigger the callback and pass the params
        $this->trigger($found_match, array_values($route_params));
    }

    public function add(Route $route)
    {
        $this->routes[] = $route;
    }

    public function before($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function trigger(Route $route, Array $params)
    {
        $route->trigger($params);
    }

    public function getPath(Int $index)
    {
        return $this->routes[$index]->getPath();
    }

    public function getPaths()
    {
        return $this->routes;
    }

    public function match()
    {
        foreach($this->routes as $route)
        {
            $route_params = explode('/', $route->getPath());
            $url_params = $this->request->getUrlArray();

            $dinamic_params = [];

            if(count($route_params) === count($url_params) && $route->getMethod() === $this->request->getMethod())
            {
                foreach($route_params as $index => $route_param)
                {
                    if(strtolower($route_param) !== strtolower($url_params[$index]))
                    {
                        if(strpos($route_param, ':') === false)
                        {
                            continue 2;
                        }
                    }
                }
                return $route;
            }
        }
    }

    public function bind(Route $route)
    {
        $route_params = explode('/', $route->getPath());
        $url_params = $this->request->getUrlArray();

        if(count($route_params) !== count($url_params))
        {
            throw new \Exception('Index out of bound', 1);
        }

        $binded = [];
        foreach($route_params as $index => $route_param)
        {
            if(strpos($route_param, ':') !== false)
            {
                $binded[$route_param] = $url_params[$index];
            }
        }
        return $binded;
    }
}
