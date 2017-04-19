<?php namespace Hubstaff;

final class Projects extends AbstractResource
{

    public function getProjects($auth_token, $app_token, $status, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;
        if ($status)
            $fields['status'] = $status;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';
        if ($status)
            $parameters['status'] = '';

        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findProject($auth_token, $app_token, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';


        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findProjectMembers($auth_token, $app_token, $offset, $url)
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
