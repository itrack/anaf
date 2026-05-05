<?php
namespace Itrack\Anaf\Models;

use Itrack\Anaf\Parser;

/**
 * Adresa domiciliu fiscal
 */
class CompanyFiscalAddress
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
        return $this->parser->getData()['adresa_domiciliu_fiscal']['ddenumire_Strada'] ?? '';
    }

    /**
     * @return string
     */
    public function getStreetNumber(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['dnumar_Strada'] ?? '';
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['ddenumire_Localitate'] ?? '';
    }

    /**
     * @return string
     */
    public function getCityCode(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['dcod_Localitate'] ?? '';
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['ddenumire_Judet'] ?? '';
    }

    /**
     * @return string
     */
    public function getCountyCode(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['dcod_Judet'] ?? '';
    }

    /**
     * @return string
     */
    public function getCountyAutoCode(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['dcod_JudetAuto'] ?? '';
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['dtara'] ?? '';
    }

    /**
     * @return string
     */
    public function getAddressDetails(): string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['ddetalii_Adresa'] ?? '';
    }

    /**
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->parser->getData()['adresa_domiciliu_fiscal']['dcod_Postal'] ?? null;
    }
}

