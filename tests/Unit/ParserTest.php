<?php

namespace Itrack\Anaf;

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testAddressParser()
    {
        $parser = new Parser([
            'date_generale' => [
                'adresa' => 'MUNICIPIUL BUCUREŞTI, SECTOR 1, ŞOS. BUCUREŞTI-PLOIEŞTI, NR.172-176'
            ]
        ]);

        $this->assertEquals("Municipiul Bucureşti", $parser->getAddress()['county']);
        $this->assertEquals("Sector 1", $parser->getAddress()['city']);
        $this->assertEquals("Şos. Bucureşti-Ploieşti", $parser->getAddress()['street']);
        $this->assertEquals("172-176", $parser->getAddress()['streetNumber']);
    }

    public function testRegisterDateParser()
    {
        $parser = new Parser([
            'date_generale' => [
                'data_inregistrare' => '2011-12-09'
            ]
        ]);

        $this->assertEquals("2011-12-09", $parser->getRegisterDate());
    }
}
