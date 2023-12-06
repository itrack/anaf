<?php
namespace Itrack\Anaf\Models;

use Itrack\Anaf\Parser;

class Company
{
    /** @var Parser */
    private $parser;

    /**
     * Company constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return string
     */
    public function getCIF(): string
    {
        return $this->parser->getData()['date_generale']['cui'] ?? '';
    }

    /**
     * @return string
     */
    public function getRegCom(): string
    {
        return $this->parser->getData()['date_generale']['nrRegCom'] ?? '';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->parser->getData()['date_generale']['denumire'] ?? '';
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->parser->getData()['date_generale']['telefon'] ?? '';
    }

    /**
     * @return string
     */
    public function getFullAddress(): string
    {
        return $this->parser->getData()['date_generale']['adresa'] ?? '';
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        if (empty($this->parser->getData()['stare_inactiv']['statusInactivi'] ?? null) || !is_bool($this->parser->getData()['stare_inactiv']['statusInactivi'] ?? null)) {
            return false;
        }

        return !$this->parser->getData()['stare_inactiv']['statusInactivi'] ?? false;
    }

    /**
     * @return string
     */
    public function getInactivationDate(): string
    {
        return $this->parser->getData()['stare_inactiv']['dataInactivare'] ?? '';
    }

    /**
     * @return string
     */
    public function getReactivationDate(): string
    {
        return $this->parser->getData()['stare_inactiv']['dataReactivare'] ?? '';
    }

    /**
     * @return string
     */
    public function getDeletionDate(): string
    {
        return $this->parser->getData()['stare_inactiv']['dataRadiere'] ?? '';
    }

    /**
     * @return CompanyTVA
     */
    public function getTVA(): CompanyTVA
    {
        return new CompanyTVA($this->parser);
    }

    /**
     * @return CompanyAddress
     */
    public function getAddress(): CompanyAddress
    {
        return new CompanyAddress($this->parser);
    }
}
