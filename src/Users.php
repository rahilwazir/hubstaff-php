<?php namespace Hubstaff;

final class Users extends AbstractResource
{

    public function getUsers($auth_token, $app_token, $organization_memberships, $project_memberships, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['organization_memberships'] = (int)$organization_memberships;
        $fields['project_memberships'] = (int)$project_memberships;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['organization_memberships'] = '';
        $parameters['project_memberships'] = '';
        $parameters['offset'] = '';

        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findUser($auth_token, $app_token, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';

        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findUserOrgs($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = 'header';

        return json_decode($this->client->send($fields, $parameters, $url));
    }

    public function findUserProjects($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = 'header';

        return json_decode($this->client->send($fields, $parameters, $url));
    }
}

