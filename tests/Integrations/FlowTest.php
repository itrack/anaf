<?php

namespace Itrack\Anaf;

use PHPUnit\Framework\TestCase;

class FlowTest extends TestCase
{
    public function testMultipleCUI()
    {
        $anaf = new Client();
        $anaf->addCif("RO16826034");
        $anaf->addCif("RO14399840");
        $results = $anaf->get();

        $this->assertEquals("DANTE INTERNATIONAL SA", $results[1]->getName());
    }

    public function testCUIList()
    {
        $anaf = new Client();
        $anaf->addCif([
            "RO16826034",
            "RO14399840"
        ]);
        $results = $anaf->get();

        $this->assertEquals("DANTE INTERNATIONAL SA", $results[1]->getName());
    }

    public function testOneCUI()
    {
        $anaf = new Client();
        $anaf->addCif("RO14399840");
        $results = $anaf->first();

        $this->assertEquals("DANTE INTERNATIONAL SA", $results->getName());
    }

    public function testAddressParser()
    {
        $anaf = new Client();
        $anaf->addCif("RO14399840");
        $results = $anaf->first();

        $this->assertEquals("Ilfov", $results->getAddress()->getCounty());
        $this->assertEquals("Oraş Voluntari", $results->getAddress()->getCity());
        $this->assertEquals("Şos. Bucureşti Nord", $results->getAddress()->getStreet());
        $this->assertEquals("15-23", $results->getAddress()->getStreetNumber());
    }
}
