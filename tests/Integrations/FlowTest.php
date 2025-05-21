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
        $this->assertEquals('2002-02-01', $results->getTVA()->getTVAEnrollDate());
        $this->assertEquals('', $results->getTVA()->getTVAEndDate());
    }

    public function testAddressParser()
    {
        $anaf = new Client();
        $anaf->addCif("RO14399840");
        $results = $anaf->first();

        $this->assertEquals("Municipiul Bucureşti", $results->getAddress()->getCounty());
        $this->assertEquals("Sector 2", $results->getAddress()->getCity());
        $this->assertEquals("Gara Herăstrău", $results->getAddress()->getStreet());
        $this->assertEquals("6", $results->getAddress()->getStreetNumber());
    }
}
