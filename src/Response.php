<?php

namespace Interceptor;

use Interceptor\Interfaces\ResponseInterface;


class Response implements ResponseInterface
{
    public static function code(Int $code = 200)
    {
        http_response_code($code);
        return new static;
    }

    public static function asJson($response)
    {
        echo json_encode($users);
    }

    public static function asNiceJson()
    {
        echo '<pre>'; echo json_encode($response, JSON_PRETTY_PRINT); echo '</pre>';
    }

    public static function asFile(String $file_path)
    {
        return readfile($file_path);
    }
}
