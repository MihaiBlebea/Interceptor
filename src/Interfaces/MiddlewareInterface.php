<?php

namespace Interceptor\Interfaces;

use Closure;


interface MiddlewareInterface
{
    public static function apply(Closure $closure);

    public function __construct(Closure $closure);

    public function run($request);
}
