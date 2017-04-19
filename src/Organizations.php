<?php
namespace Hubstaff;

use Hubstaff\helper\RequestInterface;

class Organizations
{
    private $client;

    public function __construct(RequestInterface $client)
    {
        $this->client = $client;
    }

    public function getOrganizations($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';


        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findOrganization($auth_token, $app_token, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';

        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findOrgProjects($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';

        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findOrgMembers($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';

        return json_decode($this->client->send($fields, $parameters, $url));
    }
}
