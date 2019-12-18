<?php

namespace Itrack\Anaf;

class Test extends TestCase
{

    public function testMultipleCUI()
    {
        $anaf = $this->getInstance();
        $anaf->addCui("RO16826034");
        $anaf->addCui("RO14399840");
        $results = $anaf->getResults();

        $this->assertEquals("DANTE INTERNATIONAL SA", $results[1]->denumire);
    }

    public function testCUIList()
    {
        $anaf = $this->getInstance();
        $anaf->addCui([
            "RO16826034",
            "RO14399840"
        ]);
        $results = $anaf->getResults();

        $this->assertEquals("DANTE INTERNATIONAL SA", $results[1]->denumire);
    }

    public function testOneCUI()
    {
        $anaf = $this->getInstance();
        $anaf->addCui("RO14399840");
        $results = $anaf->getOneResult();

        $this->assertEquals("DANTE INTERNATIONAL SA", $results->denumire);
    }

    public function testAddressParser()
    {
        $anaf = $this->getInstance();
        $anaf->addCui("RO14399840");
        $results = $anaf->getOneResult();

        $this->assertEquals("Ilfov", $results->adresa->judet);
        $this->assertEquals("Oraş Voluntari", $results->adresa->localitate);
        $this->assertEquals("Şos. Bucureşti Nord", $results->adresa->strada);
        $this->assertEquals("15-23", $results->adresa->numar);
    }
}
