<?php
namespace Itrack\Anaf\Models;

use Itrack\Anaf\Parser;

/**
 * Adresa sediu social
 */
class CompanyHeadquartersAddress
{
    /** @var Parser */
    private $parser;

    /**
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['sdenumire_Strada'] ?? '';
    }

    /**
     * @return string
     */
    public function getStreetNumber(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['snumar_Strada'] ?? '';
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['sdenumire_Localitate'] ?? '';
    }

    /**
     * @return string
     */
    public function getCityCode(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['scod_Localitate'] ?? '';
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['sdenumire_Judet'] ?? '';
    }

    /**
     * @return string
     */
    public function getCountyCode(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['scod_Judet'] ?? '';
    }

    /**
     * @return string
     */
    public function getCountyAutoCode(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['scod_JudetAuto'] ?? '';
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['stara'] ?? '';
    }

    /**
     * @return string
     */
    public function getAddressDetails(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['sdetalii_Adresa'] ?? '';
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->parser->getData()['adresa_sediu_social']['scod_Postal'] ?? '';
    }
}

