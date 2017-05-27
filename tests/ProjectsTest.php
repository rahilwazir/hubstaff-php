<?php

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;

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
    public function it_should_configure_field_and_parameters()
    {
        $authToken = uniqid('authToken', true);
        $appToken = uniqid('appToken', true);
        $url = uniqid('url', true);
        $offset = uniqid('offsset', true);
        $status = true;

        $parameters = [
            'Auth-Token' => 'header',
            'App-token'  => 'header',
            'offset'     => '',
            'status'     => '',
        ];

        $fields = [
            'Auth-Token' => $authToken,
            'App-token'  => $appToken,
            'offset'     => $offset,
            'status'     => $status,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $project = new \Hubstaff\Projects($this->client, $this->decoder);
        $project->getProjects($authToken, $appToken, $status, $offset, $url);
    }

    /**
     * @test
     */
    public function find_project()
    {
        $authToken = uniqid('authToken', true);
        $appToken = uniqid('appToken', true);
        $url = uniqid('url', true);

        $fields['Auth-Token'] = $authToken;
        $fields['App-token'] = $appToken;

        $parameters['Auth-Token'] = 'header';
        $parameters['App-token'] = 'header';


        $this->client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');
        $project = new \Hubstaff\Projects($this->client, $this->decoder);
        $project->findProject($authToken, $appToken, $url);

    }

    /**
     * @test
     */
    public function find_project_members()
    {
        $authToken = uniqid('authToken', true);
        $appToken = uniqid('appToken', true);
        $url = uniqid('url', true);
        $offset = uniqid('offsset', true);


        $parameters = [
            'Auth-Token' => 'header',
            'App-token'  => 'header',
            'offset'     => '',
        ];

        $fields = [
            'Auth-Token' => $authToken,
            'App-token'  => $appToken,
            'offset'     => $offset,
        ];

        $this->client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $project = new \Hubstaff\Projects($this->client, $this->decoder);
        $project->findProjectMembers($authToken, $appToken, $offset, $url);
    }
}