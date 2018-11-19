<?php

use PHPUnit\Framework\TestCase;
use Interceptor\Request;


class RouteTest extends TestCase
{

    public function setUp()
    {
        $_SERVER['REQUEST_URI']    = 'http://www.foobar.com/admin/user?name=MihaiBlebea';
        $_SERVER['SCRIPT_NAME']    = 'http://www.foobar.com/';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_REFERER']   = 'http://www.google.com';
        $_GET['name']              = 'MihaiBlebea';
    }


}
