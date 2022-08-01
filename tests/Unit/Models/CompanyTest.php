<?php

namespace Itrack\Anaf\Models;

use Itrack\Anaf\Parser;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{

    public function testCompanyDetails()
    {
        /** @var Parser $parset */
        $parset = $this->getMockBuilder(Parser::class)
            ->disableOriginalConstructor()
            ->getMock();

        $parset->expects($this->any())
            ->method('getRegisterDate')
            ->will($this->returnValue('2011-12-09'));

        $address = [
            'county' => 'Municipiul Bucureşti',
            'city' => 'Sector 1',
            'street' => 'Şos. Bucureşti-Ploieşti',
            'streetNumber' => '172-176',
        ];

        $parset->expects($this->any())
            ->method('getAddress')
            ->will($this->returnValue($address));

        $parset->expects($this->any())
            ->method('getData')
            ->will($this->returnValue([
                'cui' => 123456,
                'denumire' => 'Test',
                'telefon' => 07676000000,
            ]));
        $parset->expects($this->any())
            ->method("getPostalCode")
            ->will($this->returnValue("057003"));

        $company = new Company($parset);
        $this->assertEquals(123456, $company->getCIF());
        $this->assertEquals("Test", $company->getName());
        $this->assertEquals(07676000000, $company->getPhone());
        $this->assertEquals("Municipiul Bucureşti", $company->getAddress()->getCounty());
        $this->assertEquals("Sector 1", $company->getAddress()->getCity());
        $this->assertEquals("Şos. Bucureşti-Ploieşti", $company->getAddress()->getStreet());
        $this->assertEquals("172-176", $company->getAddress()->getStreetNumber());
        $this->assertEquals("057003", $company->getAddress()->getPostalCode());
    }
}
