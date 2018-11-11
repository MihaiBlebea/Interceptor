<?php

namespace Interceptor;


class Response
{
    public static function asJson($response)
    {
        echo '<pre>'; echo json_encode($response, JSON_PRETTY_PRINT); echo '</pre>';
    }
}
