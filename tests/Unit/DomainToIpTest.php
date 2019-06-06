<?php

namespace Tests\Unit;

use Giuga\DomainToIp;
use PHPUnit\Framework\TestCase;

class DomainToIpTest extends TestCase
{
    public function testDomainRespondsWithCname()
    {
        $this->assertNotFalse(filter_var(DomainToIp::find('https://www.example.org/'), FILTER_VALIDATE_IP));
        $this->assertNotFalse(filter_var(DomainToIp::find('https://example.org/'), FILTER_VALIDATE_IP));
        $this->assertNotFalse(filter_var(DomainToIp::find('www.dnsimple.com'), FILTER_VALIDATE_IP));
    }
}
