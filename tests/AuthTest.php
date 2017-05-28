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

    private $appToken = 'string';

    private $email;

    private $password;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->decoder = $this->createMock(DecodeDataInterface::class);

        $this->email = sprintf('%s@%s.com', uniqid('email', true), uniqid('email', true));
        $this->password = uniqid('authPassword', true);
    }
    /**
     * @test
     */
    public function it_can_login_service()
    {
        $url        = '/v1/auth';
        $method     = 'POST';

        $headers = [
            'App-Token' => $this->appToken,
        ];

        $parameters = [
            'email'    => $this->email,
            'password' => $this->password,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $parameters, $headers)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $auth = new Auth($this->client, $this->decoder);
        $auth->auth($this->email, $this->password);
    }


    /**
     * @test
     */

    public function it_can_expect_auth_success()
    {
        $url        = '/v1/auth';
        $method     = 'POST';

        $headers = [
            'App-Token' => $this->appToken,
        ];

        $parameters = [
            'email'    => $this->email,
            'password' => $this->password,
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
        $response = $auth->auth($this->email, $this->password);

        $this->assertEquals($expected, $response);
    }

    /**
     * @test
     */
    public function it_can_expect_error()
    {
        $url        = '/v1/auth';
        $method     = 'POST';

        $headers = [
            'App-Token' => $this->appToken,
        ];

        $parameters = [
            'email'    => $this->email,
            'password' => $this->password,
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
        $response = $auth->auth($this->email, $this->password);

        $this->assertEquals($expected, $response);
    }
}