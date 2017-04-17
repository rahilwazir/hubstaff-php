<?php
namespace Hubstaff;

class Organizations
{
    public function getOrganizations($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';

        $curl = new Curl;

        $org_data = json_decode($curl->send($fields, $parameters, $url));
        return $org_data;
    }

    public function findOrganization($auth_token, $app_token, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';

        $curl = new Curl;

        $org_data = json_decode($curl->send($fields, $parameters, $url));
        return $org_data;
    }

    public function findOrgProjects($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';

        $curl = new Curl;

        $org_data = json_decode($curl->send($fields, $parameters, $url));
        return $org_data;
    }

    public function findOrgMembers($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';

        $curl = new Curl;

        $org_data = json_decode($curl->send($fields, $parameters, $url));
        return $org_data;
    }
}
