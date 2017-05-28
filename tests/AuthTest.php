<?php

use Hubstaff\Auth;
use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;

class AuthTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ClientInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    /**
     * @var DecodeDataInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $decoder;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->decoder = $this->createMock(DecodeDataInterface::class);
    }
    /**
     * @test
     */
    public function it_can_login_service()
    {
        $appToken   = 'string';
        $email      = sprintf('%s@%s.com', uniqid('email', true), uniqid('email', true));
        $password   = uniqid('endTime', true);
        $url        = '/v1/auth';
        $method     = 'POST';

        $headers = [
            'App-Token' => $appToken,
        ];

        $parameters = [
            'email'    => $email,
            'password' => $password,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $parameters, $headers)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $auth = new Auth($this->client, $this->decoder);
        $auth->auth($email, $password);
    }


    /**
     * @test
     */

    public function it_can_expect_auth_success()
    {
        $appToken   = 'string';
        $email      = sprintf('%s@%s.com', uniqid('email', true), uniqid('email', true));
        $password   = uniqid('endTime', true);
        $url        = '/v1/auth';
        $method     = 'POST';

        $headers = [
            'App-Token' => $appToken,
        ];

        $parameters = [
            'email'    => $email,
            'password' => $password,
        ];

        $authToken = uniqid('authToken', true);
        $expected = [
            'id'            => 0,
            'name'          => '',
            'last_activity' => '',
            'auth_token'    => $authToken,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $parameters, $headers)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())
            ->method('decode')
            ->willReturn($expected);

        $auth = new Auth($this->client, $this->decoder);
        $response = $auth->auth($email, $password);

        $this->assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function it_can_expect_error()
    {
        $appToken   = 'string';
        $email      = sprintf('%s@%s.com', uniqid('email', true), uniqid('email', true));
        $password   = uniqid('endTime', true);
        $url        = '/v1/auth';
        $method     = 'POST';

        $headers = [
            'App-Token' => $appToken,
        ];

        $parameters = [
            'email'    => $email,
            'password' => $password,
        ];

        $messageError = uniqid('messageError', true);
        $expected = ['error' => $messageError];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $parameters, $headers)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())
            ->method('decode')
            ->willReturn($expected);

        $auth = new Auth($this->client, $this->decoder);
        $response = $auth->auth($email, $password);

        $this->assertEquals($expected, $response);
    }
}