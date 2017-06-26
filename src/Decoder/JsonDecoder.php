<?php namespace Hubstaff\Decoder;

class JsonDecoder implements DecodeDataInterface
{
    public function decode($data)
    {
        return json_decode($data, true);
    }
}
