<?php namespace Hubstaff\Helper;

interface ClientInterface
{
    public function send($method, $url, $parameters = [], $headers);
}
