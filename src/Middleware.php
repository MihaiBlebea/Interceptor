<?php

namespace Interceptor;

use Closure;
use Interceptor\Interfaces\MiddlewareInterface;


class Middleware implements MiddlewareInterface
{
    private $closure;


    public static function apply(Closure $closure)
    {
        return new static($closure);
    }

    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    public function run($request)
    {
        if($this->closure !== null)
        {
            $closure = $this->closure;
            return $closure($request, true);
        }
    }
}
