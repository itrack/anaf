<?php

namespace Itrack\Anaf;

use PHPUnit\Framework\TestCase;

class FlowTest extends TestCase
{
    public function testMultipleCUI()
    {
        $anaf = new Client();
        $anaf->addCif("RO16826034");
        $anaf->addCif("RO34559148");
        $results = $anaf->get();

        $this->assertEquals("DEVGEEKS S.R.L.", $results[1]->getName());
    }

    public function testCUIList()
    {
        $anaf = new Client();
        $anaf->addCif([
            "RO16826034",
            "RO34559148"
        ]);
        $results = $anaf->get();

        $this->assertEquals("DEVGEEKS S.R.L.", $results[1]->getName());
    }

    public function testOneCUI()
    {
        $anaf = new Client();
        $anaf->addCif("RO34559148");
        $results = $anaf->first();

        $this->assertEquals("DEVGEEKS S.R.L.", $results->getName());
        $this->assertEquals('2021-06-01', $results->getTVA()->getTVAEnrollDate());
        $this->assertEquals('', $results->getTVA()->getTVAEndDate());
    }

    public function testAddressParser()
    {
        $anaf = new Client();
        $anaf->addCif("RO34559148");
        $results = $anaf->first();

        $this->assertEquals("Municipiul Bucureşti", $results->getAddress()->getCounty());
        $this->assertEquals("Sector 3", $results->getAddress()->getCity());
        $this->assertEquals("Ale Adrian Cârstea", $results->getAddress()->getStreet());
        $this->assertEquals("3", $results->getAddress()->getStreetNumber());
    }
}
