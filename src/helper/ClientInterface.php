<?php namespace Hubstaff\Helper;

interface ClientInterface
{
    public function send($fields, $parameters, $url, $type = 0);
}
