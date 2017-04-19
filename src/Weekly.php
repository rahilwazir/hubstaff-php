<?php namespace Hubstaff;

use Hubstaff\helper\RequestInterface;

final class Weekly
{
    private $client;

    public function __construct(RequestInterface $client)
    {
        $this->client = $client;
    }

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

        return json_decode($this->client->send($fields, $parameters, $url));
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

        return json_decode($this->client->send($fields, $parameters, $url));
    }
}
