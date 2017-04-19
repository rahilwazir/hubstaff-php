<?php namespace Hubstaff;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\helper\RequestInterface;

abstract class AbstractResource
{
    /**
     * @var RequestInterface
     */
    protected $client;

    /**
     * @var DecodeDataInterface
     */
    protected $decoder;

    public function __construct(RequestInterface $client, DecodeDataInterface $decoder)
    {
        $this->client  = $client;
        $this->decoder = $decoder;
    }

    /**
     * Return the response result decoded
     *
     * @param string   $url
     * @param string[] $fields
     * @param string[] $parameters
     * @param int      $type
     *
     * @return mixed
     */
    public function returnDecodedData($url, $fields, $parameters, $type = 0)
    {
        return $this->decoder->decode($this->client->send($fields, $parameters, $url, $type));
    }
}
