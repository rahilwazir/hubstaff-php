<?php

namespace Hubstaff;

final class Activities extends AbstractResource
{
    /**
     * @param string $auth_token
     * @param string $app_token
     * @param string $starttime
     * @param string $endtime
     * @param int $offset
     * @param array $options
     * @param string $url
     * @return array
     */
    public function getActivities($auth_token, $app_token, $starttime, $endtime, $offset, $options, $url)
    {
        $fields['Auth-Token'] = $auth_token;
        $fields['App-token'] = $app_token;
        $fields['start_time'] = $starttime;
        $fields['stop_time'] = $endtime;

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

        $fields['offset'] = $offset;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';
        $parameters['start_time'] = '';
        $parameters['stop_time'] = '';
        $parameters['offset'] = '';

        return $this->returnDecodedData($url, $fields, $parameters);
    }
}