<?php namespace Hubstaff;

final class Weekly extends AbstractResource
{
    public function weeklyTeam($auth_token, $app_token, $options, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        if (isset($options['date'])) {
            $fields['date'] = $options['date'];
            $parameters['date'] = '';
        }
        if (isset($options['organizations'])) {
            $fields['organizations'] = $options['organizations'];
            $parameters['organizations'] = '';
        }
        if (isset($options['projects'])) {
            $fields['projects'] = $options['projects'];
            $parameters['projects'] = '';
        }
        if (isset($options['users'])) {
            $fields['users'] = $options['users'];
            $parameters['users'] = '';
        }

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';

        return $this->returnDecodedData($url, $fields, $parameters);
    }

    public function weeklyMy($auth_token, $app_token, $options, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        if (isset($options['date'])) {
            $fields['date'] = $options['date'];
            $parameters['date'] = '';
        }
        if (isset($options['organizations'])) {
            $fields['organizations'] = $options['organizations'];
            $parameters['organizations'] = '';
        }
        if (isset($options['projects'])) {
            $fields['projects'] = $options['projects'];
            $parameters['projects'] = '';
        }
        if (isset($options['users'])) {
            $fields['users'] = $options['users'];
            $parameters['users'] = '';
        }

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';

        return $this->returnDecodedData($url, $fields, $parameters);
    }
}
