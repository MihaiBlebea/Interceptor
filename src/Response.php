<?php

namespace Interceptor;

use Interceptor\Interfaces\ResponseInterface;


class Response implements ResponseInterface
{
    public static function asJson($response)
    {
        echo '<pre>'; echo json_encode($response, JSON_PRETTY_PRINT); echo '</pre>';
    }
}
