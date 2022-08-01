<?php
namespace Itrack\Anaf\Models;

use Itrack\Anaf\Parser;

class CompanyAddress
{
    /** @var Parser */
    private $parser;

    /**
     * CompanyAddress constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->parser->getAddress()['county'];
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->parser->getAddress()['city'];
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->parser->getAddress()['street'];
    }

    /**
     * @return string
     */
    public function getStreetNumber(): string
    {
        return $this->parser->getAddress()['streetNumber'];
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->parser->getPostalCode();
    }

    /**
     * @return string
     */
    public function getOthers(): string
    {
        return $this->parser->getAddress()['others'];
    }
}
