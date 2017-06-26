<?php

namespace HubstaffTest\Helper;

use Hubstaff\Helper\ClientInterface;
use Hubstaff\Helper\HubStaffHttpClient;

/**
 * Class HubStaffHttpClientTest
 * @covers \Hubstaff\Helper\HubStaffHttpClient
 */
class HubStaffHttpClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_must_implement_the_client_interface()
    {
        $client = new HubStaffHttpClient();
        self::assertInstanceOf(ClientInterface::class, $client);
    }

    /**
     * @test
     */
    public function it_should_have_a_build_options_method()
    {
        $client = new HubStaffHttpClient();
        self::assertTrue(method_exists($client, 'buildOptions'));
    }

    /**
     * @test
     * @dataProvider options_provider
     */
    public function it_should_return_options_correctly($method, $parameters, $expected)
    {
        $client = new HubStaffHttpClient();
        $client->setMethod(strtoupper($method));
        $actual = $client->buildOptions($parameters);
        $this->assertEquals($expected, $actual);
    }

    public function options_provider()
    {
        $parameters = ['organizations' => [], 'users' => []];

        yield['GET', $parameters, ['query' => $parameters]];
        yield['POST', $parameters, ['form_params' => $parameters]];
        yield['GET', [], ['query' => []]];
        yield['POST', [], ['form_params' => []]];
    }
}
