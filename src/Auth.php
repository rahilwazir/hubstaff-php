<?php namespace Hubstaff;

final class Auth extends AbstractResource
{
    public function auth($email, $password)
    {
        $parameters['email'] = $email;
        $parameters['password'] = $password;

        return $this->returnDecodedData('POST', '/v1/auth', $parameters, $this->getHeaders());
    }

    protected function getHeaders()
    {
        return [
            'App-Token'  => $this->appToken,
        ];
    }
}

