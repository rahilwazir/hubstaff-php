<?php

namespace Hubstaff;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;

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
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->decoder = $this->createMock(DecodeDataInterface::class);
    }

    /**
     * @test
     * @dataProvider provider_valid_options
     */
    public function it_should_configure_field_and_parameters_to_given_options(array $options)
    {
        $authToken = uniqid('authToken', true);
        $appToken = uniqid('appToken', true);
        $startTime = uniqid('startTime', true);
        $endTime = uniqid('endTime', true);
        $url = uniqid('url', true);
        $offset = uniqid('offsset', true);

        $optionName = key($options);
        $parameters = [
            $optionName  => '',
            'Auth-Token' => 'header',
            'App-token'  => 'header',
            'start_time' => '',
            'stop_time'  => '',
            'offset'     => '',
        ];

        $fields = array_merge(
            [
                'Auth-Token' => $authToken,
                'start_time' => $startTime,
                'stop_time'  => $endTime,
                'App-token'  => $appToken,
                'offset'     => $offset,
            ],
            $options
        );

        $this->client->expects(self::once())
            ->method('send')
            ->with($fields, $parameters, $url, 0)
            ->will(self::returnValue([]));

        $this->decoder->expects(self::once())->method('decode');

        $notes = new Notes($this->client, $this->decoder);
        $notes->getNotes($authToken, $appToken, $startTime, $endTime, $offset, $options, $url);
    }

    public function provider_valid_options()
    {
        yield [['organizations' => uniqid('organization', true)]];
        yield [['projects' => uniqid('projects', true)]];
        yield [['users' => uniqid('users', true)]];
    }

    /**
     * @test
     */
    public function notes()
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
        $notes = new Notes($this->client, $this->decoder);
        $notes->findNote($authToken, $appToken, $url);
    }
}