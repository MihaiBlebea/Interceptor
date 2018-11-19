<?php

namespace Interceptor\Interfaces;


interface RequestInterface
{
    public function __construct();

    public function jsonSerialize();

    public function getUrl();

    public function getRequestMethod();

    public function retrive(String $element);

    public function getTrimmedUrl();

    public function getUrlArray();

    public function getMethod();

    public function dump();

    public function getPreviousPath();
}
