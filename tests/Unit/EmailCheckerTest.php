<?php

namespace Tests\Unit;

use Tests\TestCase;


class EmailChecker extends TestCase
{
    /**
     * @dataProvider domainProvider
     */
    public function testDomainGSuite($domain, $expected)
    {
        $isGSuite = \EmailParser::isDomainGSuite($domain);

        $this->assertSame($isGSuite, $expected);
    }

    public function domainProvider()
    {
        return [
            ['aodocs.com', true],
            ['yahoo.com', false],
            ['fileinvite.com', true],
            ['gigtrooper.com', false]
        ];
    }
}