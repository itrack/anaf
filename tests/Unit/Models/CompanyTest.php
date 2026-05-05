<?php

namespace Itrack\Anaf\Models;

use Itrack\Anaf\Parser;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    private function getSampleData(): array
    {
        return [
            [
                'date_generale' => [
                    'data' => '2026-05-05',
                    'cui' => 16826034,
                    'denumire' => 'HIDRO PRAHOVA SA',
                    'adresa' => 'JUD. PRAHOVA, MUN. PLOIEŞTI, STR. LOGOFĂT TĂUTU, NR.5',
                    'telefon' => '0244529340',
                    'fax' => '529340',
                    'codPostal' => '100062',
                    'act' => '',
                    'stare_inregistrare' => 'INREGISTRAT din data 07.10.2004',
                    'organFiscalCompetent' => 'Administraţia Fiscală pentru Contribuabili Mijlocii - Prahova',
                    'forma_de_proprietate' => 'PROPR.DE STAT-SOCIETATE COMERCIALA',
                    'forma_organizare' => 'PERSOANA JURIDICA',
                    'forma_juridica' => 'SOCIETATE COMERCIALĂ PE ACŢIUNI',
                    'statusRO_e_Factura' => true,
                    'data_inregistrare' => '2004-10-07',
                    'nrRegCom' => 'J2004002095297',
                    'cod_CAEN' => '3600',
                    'iban' => '',
                ],
                'inregistrare_scop_Tva' => [
                    'scpTVA' => true,
                    'perioade_TVA' => [
                        [
                            'data_inceput_ScpTVA' => '2004-10-11',
                            'data_sfarsit_ScpTVA' => '',
                            'data_anul_imp_ScpTVA' => '',
                            'mesaj_ScpTVA' => '',
                        ],
                    ],
                ],
                'inregistrare_RTVAI' => [
                    'dataActualizareTvaInc' => '',
                    'dataPublicareTvaInc' => '',
                    'dataInceputTvaInc' => '',
                    'dataSfarsitTvaInc' => '',
                    'tipActTvaInc' => '',
                    'statusTvaIncasare' => false,
                ],
                'stare_inactiv' => [
                    'dataInactivare' => '',
                    'dataReactivare' => '',
                    'dataPublicare' => '',
                    'dataRadiere' => '',
                    'statusInactivi' => false,
                ],
                'inregistrare_SplitTVA' => [
                    'dataInceputSplitTVA' => '',
                    'dataAnulareSplitTVA' => '',
                    'statusSplitTVA' => false,
                ],
                'adresa_sediu_social' => [
                    'sdenumire_Localitate' => 'Mun. Ploieşti',
                    'stara' => '',
                    'sdenumire_Strada' => 'Str. Logofăt Tăutu',
                    'snumar_Strada' => '5',
                    'scod_Localitate' => '323',
                    'sdenumire_Judet' => 'PRAHOVA',
                    'scod_Judet' => '29',
                    'scod_JudetAuto' => 'PH',
                    'sdetalii_Adresa' => '',
                    'scod_Postal' => '100062',
                ],
                'adresa_domiciliu_fiscal' => [
                    'dtara' => '',
                    'ddenumire_Localitate' => 'Mun. Ploieşti',
                    'ddenumire_Strada' => 'Str. Logofăt Tăutu',
                    'dnumar_Strada' => '5',
                    'dcod_Localitate' => '323',
                    'ddenumire_Judet' => 'PRAHOVA',
                    'dcod_Judet' => '29',
                    'dcod_JudetAuto' => 'PH',
                    'ddetalii_Adresa' => '',
                    'dcod_Postal' => '100062',
                ],
            ],
            [
                'date_generale' => [
                    'data' => '2026-05-05',
                    'cui' => 34559148,
                    'denumire' => 'DEVGEEKS S.R.L.',
                    'adresa' => 'MUNICIPIUL BUCUREŞTI, SECTOR 3, ALE ADRIAN CÂRSTEA, NR.3, CAMERA 1, BL.33B, SC.2, ET.8, AP.100',
                    'telefon' => '',
                    'fax' => '',
                    'codPostal' => '',
                    'act' => '',
                    'stare_inregistrare' => 'INREGISTRAT din data 25.05.2015',
                    'organFiscalCompetent' => 'Administraţia Sector 3 a Finanţelor Publice',
                    'forma_de_proprietate' => 'PROPR.PRIVATA-CAPITAL PRIVAT AUTOHTON',
                    'forma_organizare' => 'PERSOANA JURIDICA',
                    'forma_juridica' => 'SOCIETATE COMERCIALĂ CU RĂSPUNDERE LIMITATĂ',
                    'statusRO_e_Factura' => true,
                    'data_inregistrare' => '2015-05-26',
                    'nrRegCom' => 'J2015006292405',
                    'cod_CAEN' => '6210',
                    'iban' => '',
                ],
                'inregistrare_scop_Tva' => [
                    'scpTVA' => true,
                    'perioade_TVA' => [
                        [
                            'data_inceput_ScpTVA' => '2021-06-01',
                            'data_sfarsit_ScpTVA' => '',
                            'data_anul_imp_ScpTVA' => '',
                            'mesaj_ScpTVA' => '',
                        ],
                    ],
                ],
                'inregistrare_RTVAI' => [
                    'dataActualizareTvaInc' => '',
                    'dataPublicareTvaInc' => '',
                    'dataInceputTvaInc' => '',
                    'dataSfarsitTvaInc' => '',
                    'tipActTvaInc' => '',
                    'statusTvaIncasare' => false,
                ],
                'stare_inactiv' => [
                    'dataInactivare' => '',
                    'dataReactivare' => '',
                    'dataPublicare' => '',
                    'dataRadiere' => '',
                    'statusInactivi' => false,
                ],
                'inregistrare_SplitTVA' => [
                    'dataInceputSplitTVA' => '',
                    'dataAnulareSplitTVA' => '',
                    'statusSplitTVA' => false,
                ],
                'adresa_sediu_social' => [
                    'sdenumire_Localitate' => 'Sector 3 Mun. Bucureşti',
                    'stara' => '',
                    'sdenumire_Strada' => 'Ale ADRIAN CÂRSTEA',
                    'snumar_Strada' => '3',
                    'scod_Localitate' => '3',
                    'sdenumire_Judet' => 'MUNICIPIUL BUCUREŞTI',
                    'scod_Judet' => '40',
                    'scod_JudetAuto' => 'B',
                    'sdetalii_Adresa' => 'CAMERA 1',
                    'scod_Postal' => '',
                ],
                'adresa_domiciliu_fiscal' => [
                    'dtara' => '',
                    'ddenumire_Localitate' => 'Sector 3 Mun. Bucureşti',
                    'ddenumire_Strada' => 'Ale ADRIAN CÂRSTEA',
                    'dnumar_Strada' => '3',
                    'dcod_Localitate' => '3',
                    'ddenumire_Judet' => 'MUNICIPIUL BUCUREŞTI',
                    'dcod_Judet' => '40',
                    'dcod_JudetAuto' => 'B',
                    'ddetalii_Adresa' => 'CAMERA 1',
                    'dcod_Postal' => '',
                ],
            ],
        ];
    }

    private function makeCompany(array $data): Company
    {
        return new Company(new Parser($data));
    }

    // ==================== DATE GENERALE ====================

    /**
     * @dataProvider generalDataProvider
     */
    public function testGeneralData(int $index, array $expected)
    {
        $company = $this->makeCompany($this->getSampleData()[$index]);

        $this->assertEquals($expected['cui'], $company->getCIF());
        $this->assertEquals($expected['data'], $company->getSearchDate());
        $this->assertEquals($expected['denumire'], $company->getName());
        $this->assertEquals($expected['telefon'], $company->getPhone());
        $this->assertEquals($expected['fax'], $company->getFax());
        $this->assertEquals($expected['codPostal'], $company->getPostalCode());
        $this->assertEquals($expected['act'], $company->getAuthorizationAct());
        $this->assertEquals($expected['stare_inregistrare'], $company->getRegistrationState());
        $this->assertEquals($expected['data_inregistrare'], $company->getRegistrationDate());
        $this->assertEquals($expected['nrRegCom'], $company->getRegCom());
        $this->assertEquals($expected['cod_CAEN'], $company->getCAENCode());
        $this->assertEquals($expected['iban'], $company->getIBAN());
        $this->assertEquals($expected['statusRO_e_Factura'], $company->hasEFactura());
        $this->assertEquals($expected['organFiscalCompetent'], $company->getCompetentFiscalBody());
        $this->assertEquals($expected['forma_de_proprietate'], $company->getOwnershipForm());
        $this->assertEquals($expected['forma_organizare'], $company->getOrganizationForm());
        $this->assertEquals($expected['forma_juridica'], $company->getLegalForm());
    }

    public function generalDataProvider(): array
    {
        return [
            [0, [
                'cui' => 16826034,
                'data' => '2026-05-05',
                'denumire' => 'HIDRO PRAHOVA SA',
                'telefon' => '0244529340',
                'fax' => '529340',
                'codPostal' => '100062',
                'act' => '',
                'stare_inregistrare' => 'INREGISTRAT din data 07.10.2004',
                'data_inregistrare' => '2004-10-07',
                'nrRegCom' => 'J2004002095297',
                'cod_CAEN' => '3600',
                'iban' => '',
                'statusRO_e_Factura' => true,
                'organFiscalCompetent' => 'Administraţia Fiscală pentru Contribuabili Mijlocii - Prahova',
                'forma_de_proprietate' => 'PROPR.DE STAT-SOCIETATE COMERCIALA',
                'forma_organizare' => 'PERSOANA JURIDICA',
                'forma_juridica' => 'SOCIETATE COMERCIALĂ PE ACŢIUNI',
            ]],
            [1, [
                'cui' => 34559148,
                'data' => '2026-05-05',
                'denumire' => 'DEVGEEKS S.R.L.',
                'telefon' => '',
                'fax' => '',
                'codPostal' => '',
                'act' => '',
                'stare_inregistrare' => 'INREGISTRAT din data 25.05.2015',
                'data_inregistrare' => '2015-05-26',
                'nrRegCom' => 'J2015006292405',
                'cod_CAEN' => '6210',
                'iban' => '',
                'statusRO_e_Factura' => true,
                'organFiscalCompetent' => 'Administraţia Sector 3 a Finanţelor Publice',
                'forma_de_proprietate' => 'PROPR.PRIVATA-CAPITAL PRIVAT AUTOHTON',
                'forma_organizare' => 'PERSOANA JURIDICA',
                'forma_juridica' => 'SOCIETATE COMERCIALĂ CU RĂSPUNDERE LIMITATĂ',
            ]],
        ];
    }

    // ==================== STARE INACTIV ====================

    /**
     * @dataProvider activeStatusProvider
     */
    public function testActiveStatus(int $index, bool $expectedActive)
    {
        $company = $this->makeCompany($this->getSampleData()[$index]);

        $this->assertEquals($expectedActive, $company->isActive());
        $this->assertEquals('', $company->getInactivationDate());
        $this->assertEquals('', $company->getReactivationDate());
        $this->assertEquals('', $company->getPublishDate());
        $this->assertEquals('', $company->getDeletionDate());
    }

    public function activeStatusProvider(): array
    {
        return [
            [0, true],
            [1, true],
        ];
    }

    public function testInactiveCompany()
    {
        $data = $this->getSampleData()[0];
        $data['stare_inactiv'] = [
            'dataInactivare' => '2020-01-15',
            'dataReactivare' => '',
            'dataPublicare' => '2020-01-20',
            'dataRadiere' => '2021-06-01',
            'statusInactivi' => true,
        ];

        $company = $this->makeCompany($data);

        $this->assertFalse($company->isActive());
        $this->assertEquals('2020-01-15', $company->getInactivationDate());
        $this->assertEquals('', $company->getReactivationDate());
        $this->assertEquals('2020-01-20', $company->getPublishDate());
        $this->assertEquals('2021-06-01', $company->getDeletionDate());
    }

    // ==================== TVA ====================

    /**
     * @dataProvider tvaProvider
     */
    public function testTVA(int $index, array $expected)
    {
        $company = $this->makeCompany($this->getSampleData()[$index]);
        $tva = $company->getTVA();

        $this->assertEquals($expected['scpTVA'], $tva->hasTVA());
        $this->assertEquals($expected['data_inceput_ScpTVA'], $tva->getTVAEnrollDate());
        $this->assertEquals($expected['data_sfarsit_ScpTVA'], $tva->getTVAEndDate());
        $this->assertEquals($expected['data_anul_imp_ScpTVA'], $tva->getTVACancellationDate());
        $this->assertEquals($expected['mesaj_ScpTVA'], $tva->getTVACancellationMessage());
    }

    public function tvaProvider(): array
    {
        return [
            [0, [
                'scpTVA' => true,
                'data_inceput_ScpTVA' => '2004-10-11',
                'data_sfarsit_ScpTVA' => '',
                'data_anul_imp_ScpTVA' => '',
                'mesaj_ScpTVA' => '',
            ]],
            [1, [
                'scpTVA' => true,
                'data_inceput_ScpTVA' => '2021-06-01',
                'data_sfarsit_ScpTVA' => '',
                'data_anul_imp_ScpTVA' => '',
                'mesaj_ScpTVA' => '',
            ]],
        ];
    }

    public function testTVAWithCancellation()
    {
        $data = $this->getSampleData()[1];
        $data['inregistrare_scop_Tva'] = [
            'scpTVA' => false,
            'perioade_TVA' => [
                [
                    'data_inceput_ScpTVA' => '2021-06-01',
                    'data_sfarsit_ScpTVA' => '2023-12-31',
                    'data_anul_imp_ScpTVA' => '2024-01-05',
                    'mesaj_ScpTVA' => 'Anulare conform art. 316 alin. (11) lit. h) din Codul fiscal',
                ],
            ],
        ];

        $company = $this->makeCompany($data);
        $tva = $company->getTVA();

        $this->assertFalse($tva->hasTVA());
        $this->assertEquals('2021-06-01', $tva->getTVAEnrollDate());
        $this->assertEquals('2023-12-31', $tva->getTVAEndDate());
        $this->assertEquals('2024-01-05', $tva->getTVACancellationDate());
        $this->assertEquals('Anulare conform art. 316 alin. (11) lit. h) din Codul fiscal', $tva->getTVACancellationMessage());
    }

    // ==================== TVA LA INCASARE ====================

    /**
     * @dataProvider tvaCollectionProvider
     */
    public function testTVACollection(int $index, array $expected)
    {
        $company = $this->makeCompany($this->getSampleData()[$index]);
        $tva = $company->getTVA();

        $this->assertEquals($expected['statusTvaIncasare'], $tva->hasTVACollection());
        $this->assertEquals($expected['dataInceputTvaInc'], $tva->getTVACollectionEnrollDate());
        $this->assertEquals($expected['dataSfarsitTvaInc'], $tva->getTVACollectionEndDate());
        $this->assertEquals($expected['dataActualizareTvaInc'], $tva->getTVACollectionUpdateDate());
        $this->assertEquals($expected['dataPublicareTvaInc'], $tva->getTVACollectionPublishDate());
        $this->assertEquals($expected['tipActTvaInc'], $tva->getTVACollectionUpdateType());
    }

    public function tvaCollectionProvider(): array
    {
        return [
            [0, [
                'statusTvaIncasare' => false,
                'dataInceputTvaInc' => '',
                'dataSfarsitTvaInc' => '',
                'dataActualizareTvaInc' => '',
                'dataPublicareTvaInc' => '',
                'tipActTvaInc' => '',
            ]],
            [1, [
                'statusTvaIncasare' => false,
                'dataInceputTvaInc' => '',
                'dataSfarsitTvaInc' => '',
                'dataActualizareTvaInc' => '',
                'dataPublicareTvaInc' => '',
                'tipActTvaInc' => '',
            ]],
        ];
    }

    public function testTVACollectionActive()
    {
        $data = $this->getSampleData()[0];
        $data['inregistrare_RTVAI'] = [
            'dataActualizareTvaInc' => '2023-03-15',
            'dataPublicareTvaInc' => '2023-03-20',
            'dataInceputTvaInc' => '2023-04-01',
            'dataSfarsitTvaInc' => '',
            'tipActTvaInc' => 'Inregistrare',
            'statusTvaIncasare' => true,
        ];

        $company = $this->makeCompany($data);
        $tva = $company->getTVA();

        $this->assertTrue($tva->hasTVACollection());
        $this->assertEquals('2023-04-01', $tva->getTVACollectionEnrollDate());
        $this->assertEquals('', $tva->getTVACollectionEndDate());
        $this->assertEquals('2023-03-15', $tva->getTVACollectionUpdateDate());
        $this->assertEquals('2023-03-20', $tva->getTVACollectionPublishDate());
        $this->assertEquals('Inregistrare', $tva->getTVACollectionUpdateType());
    }

    // ==================== SPLIT TVA ====================

    /**
     * @dataProvider tvaSplitProvider
     */
    public function testTVASplit(int $index, array $expected)
    {
        $company = $this->makeCompany($this->getSampleData()[$index]);
        $tva = $company->getTVA();

        $this->assertEquals($expected['statusSplitTVA'], $tva->hasTVASplit());
        $this->assertEquals($expected['dataInceputSplitTVA'], $tva->getTVASplitEnrollDate());
        $this->assertEquals($expected['dataAnulareSplitTVA'], $tva->getTVASplitEndDate());
    }

    public function tvaSplitProvider(): array
    {
        return [
            [0, [
                'statusSplitTVA' => false,
                'dataInceputSplitTVA' => '',
                'dataAnulareSplitTVA' => '',
            ]],
            [1, [
                'statusSplitTVA' => false,
                'dataInceputSplitTVA' => '',
                'dataAnulareSplitTVA' => '',
            ]],
        ];
    }

    public function testTVASplitActive()
    {
        $data = $this->getSampleData()[1];
        $data['inregistrare_SplitTVA'] = [
            'dataInceputSplitTVA' => '2022-01-01',
            'dataAnulareSplitTVA' => '',
            'statusSplitTVA' => true,
        ];

        $company = $this->makeCompany($data);
        $tva = $company->getTVA();

        $this->assertTrue($tva->hasTVASplit());
        $this->assertEquals('2022-01-01', $tva->getTVASplitEnrollDate());
        $this->assertEquals('', $tva->getTVASplitEndDate());
    }

    // ==================== ADRESA SEDIU SOCIAL ====================

    /**
     * @dataProvider headquartersAddressProvider
     */
    public function testHeadquartersAddress(int $index, array $expected)
    {
        $company = $this->makeCompany($this->getSampleData()[$index]);
        $address = $company->getHeadquartersAddress();

        $this->assertEquals($expected['street'], $address->getStreet());
        $this->assertEquals($expected['streetNumber'], $address->getStreetNumber());
        $this->assertEquals($expected['city'], $address->getCity());
        $this->assertEquals($expected['cityCode'], $address->getCityCode());
        $this->assertEquals($expected['county'], $address->getCounty());
        $this->assertEquals($expected['countyCode'], $address->getCountyCode());
        $this->assertEquals($expected['countyAutoCode'], $address->getCountyAutoCode());
        $this->assertEquals($expected['country'], $address->getCountry());
        $this->assertEquals($expected['addressDetails'], $address->getAddressDetails());
        $this->assertEquals($expected['postalCode'], $address->getPostalCode());
    }

    public function headquartersAddressProvider(): array
    {
        return [
            [0, [
                'street' => 'Str. Logofăt Tăutu',
                'streetNumber' => '5',
                'city' => 'Mun. Ploieşti',
                'cityCode' => '323',
                'county' => 'PRAHOVA',
                'countyCode' => '29',
                'countyAutoCode' => 'PH',
                'country' => '',
                'addressDetails' => '',
                'postalCode' => '100062',
            ]],
            [1, [
                'street' => 'Ale ADRIAN CÂRSTEA',
                'streetNumber' => '3',
                'city' => 'Sector 3 Mun. Bucureşti',
                'cityCode' => '3',
                'county' => 'MUNICIPIUL BUCUREŞTI',
                'countyCode' => '40',
                'countyAutoCode' => 'B',
                'country' => '',
                'addressDetails' => 'CAMERA 1',
                'postalCode' => '',
            ]],
        ];
    }

    // ==================== ADRESA DOMICILIU FISCAL ====================

    /**
     * @dataProvider fiscalAddressProvider
     */
    public function testFiscalAddress(int $index, array $expected)
    {
        $company = $this->makeCompany($this->getSampleData()[$index]);
        $address = $company->getFiscalAddress();

        $this->assertEquals($expected['street'], $address->getStreet());
        $this->assertEquals($expected['streetNumber'], $address->getStreetNumber());
        $this->assertEquals($expected['city'], $address->getCity());
        $this->assertEquals($expected['cityCode'], $address->getCityCode());
        $this->assertEquals($expected['county'], $address->getCounty());
        $this->assertEquals($expected['countyCode'], $address->getCountyCode());
        $this->assertEquals($expected['countyAutoCode'], $address->getCountyAutoCode());
        $this->assertEquals($expected['country'], $address->getCountry());
        $this->assertEquals($expected['addressDetails'], $address->getAddressDetails());
        $this->assertEquals($expected['postalCode'], $address->getPostalCode());
    }

    public function fiscalAddressProvider(): array
    {
        return [
            [0, [
                'street' => 'Str. Logofăt Tăutu',
                'streetNumber' => '5',
                'city' => 'Mun. Ploieşti',
                'cityCode' => '323',
                'county' => 'PRAHOVA',
                'countyCode' => '29',
                'countyAutoCode' => 'PH',
                'country' => '',
                'addressDetails' => '',
                'postalCode' => '100062',
            ]],
            [1, [
                'street' => 'Ale ADRIAN CÂRSTEA',
                'streetNumber' => '3',
                'city' => 'Sector 3 Mun. Bucureşti',
                'cityCode' => '3',
                'county' => 'MUNICIPIUL BUCUREŞTI',
                'countyCode' => '40',
                'countyAutoCode' => 'B',
                'country' => '',
                'addressDetails' => 'CAMERA 1',
                'postalCode' => '',
            ]],
        ];
    }

    // ==================== EDGE CASES ====================

    public function testCompanyWithNoEFactura()
    {
        $data = $this->getSampleData()[1];
        $data['date_generale']['statusRO_e_Factura'] = false;

        $company = $this->makeCompany($data);
        $this->assertFalse($company->hasEFactura());
    }

    public function testFullAddress()
    {
        $company = $this->makeCompany($this->getSampleData()[0]);
        $this->assertEquals('JUD. PRAHOVA, MUN. PLOIEŞTI, STR. LOGOFĂT TĂUTU, NR.5', $company->getFullAddress());

        $company2 = $this->makeCompany($this->getSampleData()[1]);
        $this->assertEquals('MUNICIPIUL BUCUREŞTI, SECTOR 3, ALE ADRIAN CÂRSTEA, NR.3, CAMERA 1, BL.33B, SC.2, ET.8, AP.100', $company2->getFullAddress());
    }

    public function testTVASplitIBAN()
    {
        $data = $this->getSampleData()[0];
        $data['date_generale']['iban'] = 'RO49AAAA1B31007593840000';

        $company = $this->makeCompany($data);
        $this->assertEquals('RO49AAAA1B31007593840000', $company->getTVA()->getTVASplitIBAN());
        $this->assertEquals('RO49AAAA1B31007593840000', $company->getIBAN());
    }
}
