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

        return $this->returnDecodedData($url, $fields, $parameters);
    }

    public function findProject($auth_token, $app_token, $url)
    {
        return $this->abstractResourceCall($auth_token, $app_token, $url);
    }

    public function findProjectMembers($auth_token, $app_token, $offset, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['offset'] = '';

        return $this->returnDecodedData($url, $fields, $parameters);
    }
}
