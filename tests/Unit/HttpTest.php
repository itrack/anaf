<?php

namespace Itrack\Anaf;

use PHPUnit\Framework\TestCase;

class HttpTest extends TestCase
{
    public function testCifLimitException()
    {
        $this->expectException(Exceptions\LimitExceeded::class);
        $this->expectExceptionMessage("You can check one time up to 500 cifs.");
        
        Http::call(array_fill(0, 501, '123456'));
    }
}
