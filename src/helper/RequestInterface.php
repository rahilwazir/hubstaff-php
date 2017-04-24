<?php namespace Hubstaff\Helper;

interface RequestInterface
{
    public function send($fields, $parameters, $url, $type = 0);
}
