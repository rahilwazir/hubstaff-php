<?php

// @todo move namespace to a proper tests namespace
namespace Hubstaff\Helper;

use PHPUnit_Framework_TestCase;

/**
 * @covers \Hubstaff\Helper\Curl
 */
final class CurlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideValidHeaderAndParameterCombination
     */
    public function testHttpParametersShouldBeMountedAsPerHttpSpecification($expected, $fields, $parameters)
    {
        $class = new Curl();

        self::assertSame($expected, $class->extractHeader($fields, $parameters));
    }

    public function provideValidHeaderAndParameterCombination()
    {
        return [
            'parameters match exactly with header' => [
                'User: 1',
                [
                    'User' => 1,
                ],
                [
                    'User' => 'header',
                ],
            ],
            'parameters does not match any header' => [
                '',
                [
                    'User' => 1,
                ],
                [
                    'Name'    => 'John',
                    'SirName' => 'Smith',
                ],
            ],
            'parameters match exactly 3 header' => [
                'User: 12Name: John SmithCompany: Messing Code',
                [
                    'User' => 12,
                    'Name' => 'John Smith',
                    'Company' => 'Messing Code',
                ],
                [
                    'User' => 'header',
                    'Name' => 'header',
                    'Company' => 'header',
                    'Foo' => '123',
                    'Bar' => '345',
                    'Baz' => '422',
                ],
            ],
        ];
    }
}
