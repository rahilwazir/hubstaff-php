<?php

namespace HubstaffTest;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;
use Hubstaff\Projects;

/**
 * @cover \Hubstaff\Projects
 */
class ProjectsTest extends \PHPUnit_Framework_TestCase
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
     * @dataProvider list_projects_provider
     */
    public function it_can_list_projects($status, $offset)
    {
        $method = 'GET';
        $url    = '/v1/projects';

        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];

        $parameters = [
            'offset' => $offset,
        ];

        if (!empty($status)) {
            $parameters = array_merge($parameters, ['status' => $status]);
        }

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $project = new Projects($this->client, $this->decoder);
        $project->getProjects($status, $offset);
    }

    public function list_projects_provider()
    {
        yield ['', random_int(0, PHP_INT_MAX)];
        yield ['active', random_int(0, PHP_INT_MAX)];
        yield ['archived', random_int(0, PHP_INT_MAX)];
    }

    /**
     * @test
     */
    public function find_project()
    {
        $method = 'GET';
        $id     = random_int(1, PHP_INT_MAX);
        $url    = sprintf('/v1/projects/%s', $id);

        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];

        $parameters = [];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $project = new Projects($this->client, $this->decoder);
        $project->findProject($id);
    }

    /**
     * @test
     */
    public function find_project_members()
    {
        $method = 'GET';
        $id     = random_int(1, PHP_INT_MAX);
        $url    = sprintf('/v1/projects/%s/members', $id);
        $offset = random_int(0, PHP_INT_MAX);

        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];

        $parameters = [
            'offset' => $offset,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $parameters)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $project = new Projects($this->client, $this->decoder);
        $project->findProjectMembers($id, $offset);
    }
}
