<?php

namespace Hubstaff;

use Hubstaff\Decoder\DecodeDataInterface;
use Hubstaff\Helper\ClientInterface;

/**
 * Class ScreenshotsTest
 * @covers \Hubstaff\Screenshots
 */
class ScreenshotsTest extends \PHPUnit_Framework_TestCase
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
     * @dataProvider data_provider
     */
    public function it_can_get_a_collection_of_screenshots($startTime, $stopTime, $parameters, $offset)
    {
        $method = 'GET';
        $url    = '/v1/screenshots';
        $startTime = date('Y-m-d H:i:s');
        $stopTime = date('Y-m-d H:i:s');
        $offset = random_int(1, PHP_INT_MAX);

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

        $activities = new Screenshots($this->client, $this->decoder);
        $activities->getScreenshots($startTime, $stopTime, $parameters, $offset);
    }

    public function data_provider()
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
}