<?php namespace Hubstaff\Decoder;

class JsonDecoderData implements DecodeDataInterface
{
    public function decode($data)
    {
        return json_decode($data, true);
    }
}