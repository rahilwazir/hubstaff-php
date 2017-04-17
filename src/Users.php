<?php namespace Hubstaff;

final class Users
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

        $curl = new Curl;

        $users_data = json_decode($curl->send($fields, $parameters, $url));
        return $users_data;
    }

    public function findUser($auth_token, $app_token, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';

        $curl = new Curl;

        $user_data = json_decode($curl->send($fields, $parameters, $url));
        return $user_data;
    }

    public function findUserOrgs($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = 'header';

        $curl = new Curl;

        $org_data = json_decode($curl->send($fields, $parameters, $url));
        return $org_data;
    }

    public function findUserProjects($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = 'header';

        $curl = new Curl;

        $org_data = json_decode($curl->send($fields, $parameters, $url));
        return $org_data;
    }
}

