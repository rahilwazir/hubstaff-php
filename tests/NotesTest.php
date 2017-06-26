<?php

namespace HubstaffTest;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;
use Hubstaff\Notes;

/**
 * @covers \Hubstaff\Notes
 */
class NotesTest extends \PHPUnit_Framework_TestCase
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
     * @dataProvider  data_collection_notes_provider
     */
    public function it_cant_return_collection_of_notes($startTime, $stopTime, $parameters, $offset)
    {
        $method = 'GET';
        $url    = '/v1/screenshots';

        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];

        $expectedParams = [
            'start_time'    => $startTime,
            'stop_time'     => $stopTime,
            'offset'        => $offset,
        ];

        if (isset($parameters['organizations'])) {
            $expectedParams['organizations'] = implode(',', $parameters['organizations']);
        }
        if (isset($parameters['projects'])) {
            $expectedParams['projects'] = implode(',', $parameters['projects']);
        }
        if (isset($parameters['users'])) {
            $expectedParams['users'] = implode(',', $parameters['users']);
        }

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $expectedParams)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $this->decoder->expects(self::once())->method('decode');
        $notes = new Notes($this->client, $this->decoder);
        $notes->getNotes($startTime, $stopTime, $parameters, $offset);
    }

    public function data_collection_notes_provider()
    {
        yield [date('H:i:s'), date('H:i:s'), ['organizations' => []], random_int(1, PHP_INT_MAX)];
        yield [date('H:i:s'), date('H:i:s'), ['users' => []], random_int(1, PHP_INT_MAX)];
        yield [date('H:i:s'), date('H:i:s'), ['projects' => []], random_int(1, PHP_INT_MAX)];

        $organizations = [
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
        ];
        yield [date('H:i:s'), date('H:i:s'), ['organizations' => $organizations], random_int(1, PHP_INT_MAX)];

        $projects = [
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
        ];
        yield [date('H:i:s'), date('H:i:s'), ['projects' => $projects], random_int(1, PHP_INT_MAX)];

        $users = [
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
            random_int(1, PHP_INT_MAX),
        ];
        yield [date('H:i:s'), date('H:i:s'), ['users' => $users], random_int(1, PHP_INT_MAX)];


        yield [
            date('H:i:s'), date('H:i:s'),
            [
                'projects'      => $projects,
                'organizations' => $organizations,
                'users'         => $users,
            ],
            random_int(1, PHP_INT_MAX),
        ];
    }

    /**
     * @test
     */
    public function it_can_return_the_note_with_given_id()
    {
        $method = 'GET';
        $id = random_int(1, PHP_INT_MAX);
        $url    = strtr('/v1/notes/{id}', '{id}', $id);

        $headers = [
            'App-Token'  => $this->appToken,
            'Auth-Token' => $this->authToken,
        ];

        $expectedParams = [];

        $this->client->expects(self::once())
            ->method('send')
            ->with($method, $url, $headers, $expectedParams)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $this->decoder->expects(self::once())->method('decode');
        $notes = new Notes($this->client, $this->decoder);
        $notes->findNote($id);
    }
}
