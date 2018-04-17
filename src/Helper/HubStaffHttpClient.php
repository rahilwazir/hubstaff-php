<?php

namespace Hubstaff\Helper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HubStaffHttpClient implements ClientInterface
{
    private $host;
    private $method;

    /**
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @param array $headers
     *
     * @return array|string
     * @throws \RuntimeException
     * @throws \GuzzleHttp\Exception\RequestException;
     */
    public function send($method, $url, $parameters = [], $headers)
    {
        $client = new Client(
            [
                'base_uri' => $this->host,
                'headers'  => $headers,
            ]
        );

        $this->setMethod($method);

        try {
            $res = $client->request($this->method, $url, $this->buildOptions($parameters));
        } catch (RequestException $e) {
            return $e->getResponse()->getBody()->getContents();
        }

        return $res->getBody()->getContents();
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @param $parameters
     *
     * @return array
     */
    public function buildOptions($parameters)
    {
        if ($this->getMethod() == 'GET') {
            return ['query' => $parameters];
        }

        if ($this->getMethod() == 'POST') {
            return ['form_params' => $parameters];
        }

        return [];
    }
}
