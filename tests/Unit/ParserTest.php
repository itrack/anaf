<?php

namespace Itrack\Anaf;

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testAddressParser()
    {
        $parser = new Parser([
            'adresa' => 'MUNICIPIUL BUCUREŞTI, SECTOR 1, ŞOS. BUCUREŞTI-PLOIEŞTI, NR.172-176'
        ]);

        $this->assertEquals("Municipiul Bucureşti", $parser->getAddress()['county']);
        $this->assertEquals("Sector 1", $parser->getAddress()['city']);
        $this->assertEquals("Şos. Bucureşti-Ploieşti", $parser->getAddress()['street']);
        $this->assertEquals("172-176", $parser->getAddress()['streetNumber']);
    }

    public function testRegisterDateParser()
    {
        $parser = new Parser([
            'stare_inregistrare' => 'INREGISTRAT din data 09.12.2011'
        ]);

        $this->assertEquals("2011-12-09", $parser->getRegisterDate());
    }
}
