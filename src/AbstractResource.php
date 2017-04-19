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
        $this->client = $client;
        $this->decoder = $decoder;
    }
}