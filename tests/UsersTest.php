<?php

namespace HubstaffTest;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;
use Hubstaff\Users;

/**
 * @covers \Hubstaff\Users
 */
class UsersTest extends \PHPUnit_Framework_TestCase
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

    private $authToken = 'string';

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
     * @dataProvider data_parameters_users_provider
     */
    public function it_can_list_users($organizationMemberships, $projectMemberships, $offset)
    {
        $url        = '/v1/users';
        $method     = 'GET';

        $headers = [
            'App-Token' => $this->appToken,
            'Auth-Token'=> $this->authToken
        ];

        $parameters = [
            'organization_memberships' => $organizationMemberships,
            'project_memberships'      => $projectMemberships,
            'offset'                   => $offset,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $user = new Users($this->client, $this->decoder);
        $user->getUsers($organizationMemberships, $projectMemberships, $offset);
    }

    public function data_parameters_users_provider()
    {
        yield ['true', 'false', 1];
        yield ['true', 'true', 3];
        yield ['false', 'true', 4];
        yield ['false', 'false', 7];
    }

    /**
     * @test
     */
    public function it_cant_find_users_by_id()
    {
        $id         = random_int(1, 20);
        $url        = sprintf('/v1/users/%d', $id);
        $method     = 'GET';

        $headers = [
            'App-Token' => $this->appToken,
            'Auth-Token'=> $this->authToken
        ];

        $parameters = [];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $user = new Users($this->client, $this->decoder);
        $user->findUser($id);
    }

    /**
     * @test
     */
    public function it_can_find_user_orgs()
    {
        $id         = random_int(1, 20);
        $url        = sprintf('/v1/users/%d/organizations', $id);
        $method     = 'GET';
        $offset     = random_int(1, 10);

        $headers = [
            'App-Token' => $this->appToken,
            'Auth-Token'=> $this->authToken
        ];

        $parameters = [
            'offset' => $offset
        ];

        $expected = [
            'id'            => 0,
            'name'          => '',
            'last_activity' => '',
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode')
            ->will(self::returnValue($expected));

        $user = new Users($this->client, $this->decoder);
        $response = $user->findUserOrgs($id, $offset);

        self::assertEquals($expected, $response);
        self::assertEquals(array_keys($expected), array_keys($response));
    }

    /**
     * @test
     */
    public function it_can_find_user_projects()
    {
        $id         = random_int(1, 20);
        $url        = sprintf('/v1/users/%d/projects', $id);
        $method     = 'GET';
        $offset     = random_int(1, 10);

        $headers = [
            'App-Token' => $this->appToken,
            'Auth-Token'=> $this->authToken
        ];

        $parameters = [
            'offset' => $offset
        ];

        $expected = [
            'id'            => 0,
            'name'          => '',
            'last_activity' => '',
            'status'        => '',
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode')
            ->will(self::returnValue($expected));

        $user = new Users($this->client, $this->decoder);
        $response = $user->findUserProjects($id, $offset);

        self::assertEquals($expected, $response);
        self::assertEquals(array_keys($expected), array_keys($response));
    }
}

