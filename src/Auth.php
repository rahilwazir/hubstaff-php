<?php namespace Hubstaff;

final class Auth extends AbstractResource
{
    public function auth($app_token, $email, $password, $url)
    {
        $fields['App-token'] = $app_token;
        $fields['email'] = $email;
        $fields['password'] = $password;

        $parameters['App-token'] = 'header';
        $parameters['email'] = '';
        $parameters['password'] = '';

        $auth_data = json_decode($this->client->send($fields, $parameters, $url, 1));

        if (isset($auth_data->user)) {
            $data['auth_token'] = $auth_data->user->auth_token;
        } else {
            $data['error'] = $auth_data->error;
        }

        return $data;
    }

}

