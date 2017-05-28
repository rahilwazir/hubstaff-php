<?php namespace Hubstaff;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\helper\ClientInterface;
/*
 * client
 * decoder
 * url ( baseURI, resourceURI )
 * method
 * parameters
 * query
 */
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

    /**
     * @var string
     */
    protected $appToken = 'string';

    /**
     * @var string
     */
    protected $authToken = 'string';

    /**
     * @var string
     */
    protected $url = 'string';

    /**
     * @param ClientInterface $client
     * @param DecodeDataInterface $decoder
     */
    public function __construct(ClientInterface $client, DecodeDataInterface $decoder)
    {
        $this->client = $client;
        $this->decoder = $decoder;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @return array
     */
    public function abstractResourceCall($method = 'GET', $url, $parameters = [])
    {
        return $this->returnDecodedData($method, $url, $parameters, $this->getHeaders());
    }

    /**
     * Return the response result decoded
     *
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @param array $headers
     *
     * @return array
     */
    public function returnDecodedData($method, $url, $headers, $parameters = [])
    {
        return $this->decoder->decode($this->client->send($method, $url, $headers, $parameters));
    }

    /**
     * @return array
     */
    protected function getHeaders()
    {
        return [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];
    }
}
