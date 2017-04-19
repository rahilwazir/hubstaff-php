<?php namespace Hubstaff\helper;

interface RequestInterface
{
    public function send($fields, $parameters, $url, $type = 0);
}
