<?php namespace Hubstaff;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\helper\ClientInterface;

abstract class AbstractResource
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var DecodeDataInterface
     */
    protected $decoder;

    public function __construct(ClientInterface $client, DecodeDataInterface $decoder)
    {
        $this->client  = $client;
        $this->decoder = $decoder;
    }

    public function abstractResourceCall($authToken, $applicationToken, $url)
    {
        $fields               = [];
        $fields['Auth-Token'] = $authToken;
        $fields['App-token']  = $applicationToken;

        $parameters               = [];
        $parameters['Auth-Token'] = 'header';
        $parameters['App-token']  = 'header';

        return $this->returnDecodedData($url, $fields, $parameters);
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
