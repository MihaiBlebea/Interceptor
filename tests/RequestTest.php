<?php

use PHPUnit\Framework\TestCase;
use Interceptor\Request;


class RequestTest extends TestCase
{

    public function setUp()
    {
        $_SERVER['REQUEST_URI']    = 'http://www.foobar.com/admin/user?name=MihaiBlebea';
        $_SERVER['SCRIPT_NAME']    = 'http://www.foobar.com/';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_REFERER']   = 'http://www.google.com';
        $_GET['name']              = 'MihaiBlebea';
    }

    public function testGetUrl()
    {
        $request = new Request();
        $this->assertEquals($request->getUrl(), 'admin/user?name=MihaiBlebea');
    }

    public function testGetRequestMethod()
    {
        $request = new Request();
        $this->assertEquals($request->getRequestMethod(), 'GET');
    }

    public function testRetriveParams()
    {
        $request = new Request();
        $this->assertEquals($request->retrive('name'), 'MihaiBlebea');
        $this->assertEquals($request->dump()['name'], 'MihaiBlebea');
    }

    public function testGetTrimmedUrl()
    {
        $request = new Request();
        $this->assertEquals($request->getTrimmedUrl(), 'admin/user');
    }

    public function testGetUrlArray()
    {
        $request = new Request();
        $this->assertContains('admin', $request->getUrlArray());
        $this->assertContains('user', $request->getUrlArray());
    }

    public function testGetPreviousPath()
    {
        $request = new Request();
        $this->assertEquals($request->getPreviousPath(), 'http://www.google.com');
    }
}
