<?php

namespace HubstaffTest;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;
use Hubstaff\Organizations;

/**
 * @covers \Hubstaff\Organizations
 */
class OrganizationsTest extends \PHPUnit_Framework_TestCase
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
     * @var string
     */
    private $appToken = 'string';

    /**
     * @var string
     */
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
     */
    public function it_can_list_organizations()
    {
        $url        = '/v1/organizations';
        $method     = 'GET';
        $offset     = random_int(0, PHP_INT_MAX);

        $headers = [
            'App-Token' => $this->appToken,
            'Auth-Token'=> $this->authToken
        ];

        $parameters = [
            'offset' => $offset,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $user = new Organizations($this->client, $this->decoder);
        $user->getOrganizations($offset);
    }

    /**
     * @test
     */
    public function it_can_find_organization()
    {
        $method     = 'GET';
        $id         = random_int(0, PHP_INT_MAX);
        $url        = sprintf('/v1/organizations/%s', $id);

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

        $user = new Organizations($this->client, $this->decoder);
        $user->findOrganization($id);
    }

    /**
     * @test
     */
    public function it_can_find_org_projects()
    {
        $method     = 'GET';
        $id         = random_int(0, PHP_INT_MAX);
        $offset     = random_int(0, PHP_INT_MAX);
        $url        = sprintf('/v1/organizations/%s/projects', $id);

        $headers = [
            'App-Token' => $this->appToken,
            'Auth-Token'=> $this->authToken
        ];

        $parameters = [
            'offset' => $offset
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $user = new Organizations($this->client, $this->decoder);
        $user->findOrgProjects($id, $offset);
    }

    /**
     * @test
     */
    public function it_can_find_org_members()
    {
        $method     = 'GET';
        $id         = random_int(0, PHP_INT_MAX);
        $offset     = random_int(0, PHP_INT_MAX);
        $url        = sprintf('/v1/organizations/%s/members', $id);

        $headers = [
            'App-Token' => $this->appToken,
            'Auth-Token'=> $this->authToken
        ];

        $parameters = [
            'offset' => $offset
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $user = new Organizations($this->client, $this->decoder);
        $user->findOrgMembers($id, $offset);
    }
}
