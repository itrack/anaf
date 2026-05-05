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
    public function getSearchDate(): string
    {
        return $this->parser->getData()['date_generale']['data'] ?? '';
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
    public function getFax(): string
    {
        return $this->parser->getData()['date_generale']['fax'] ?? '';
    }

    /**
     * @return string
     */
    public function getFullAddress(): string
    {
        return $this->parser->getData()['date_generale']['adresa'] ?? '';
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->parser->getData()['date_generale']['codPostal'] ?? '';
    }

    /**
     * @return string
     */
    public function getAuthorizationAct(): string
    {
        return $this->parser->getData()['date_generale']['act'] ?? '';
    }

    /**
     * @return string
     */
    public function getRegistrationState(): string
    {
        return $this->parser->getData()['date_generale']['stare_inregistrare'] ?? '';
    }

    /**
     * @return string
     */
    public function getRegistrationDate(): string
    {
        return $this->parser->getData()['date_generale']['data_inregistrare'] ?? '';
    }

    /**
     * @return string
     */
    public function getCAENCode(): string
    {
        return $this->parser->getData()['date_generale']['cod_CAEN'] ?? '';
    }

    /**
     * @return string
     */
    public function getIBAN(): string
    {
        return $this->parser->getData()['date_generale']['iban'] ?? '';
    }

    /**
     * @return bool
     */
    public function hasEFactura(): bool
    {
        return $this->parser->getData()['date_generale']['statusRO_e_Factura'] ?? false;
    }

    /**
     * @return string
     */
    public function getCompetentFiscalBody(): string
    {
        return $this->parser->getData()['date_generale']['organFiscalCompetent'] ?? '';
    }

    /**
     * @return string
     */
    public function getOwnershipForm(): string
    {
        return $this->parser->getData()['date_generale']['forma_de_proprietate'] ?? '';
    }

    /**
     * @return string
     */
    public function getOrganizationForm(): string
    {
        return $this->parser->getData()['date_generale']['forma_organizare'] ?? '';
    }

    /**
     * @return string
     */
    public function getLegalForm(): string
    {
        return $this->parser->getData()['date_generale']['forma_juridica'] ?? '';
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        $inactive = $this->parser->getData()['stare_inactiv']['statusInactivi'] ?? null;
        if (!isset($inactive) || !is_bool($inactive)) {
            return false;
        }

        return !$inactive;
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
    public function getPublishDate(): string
    {
        return $this->parser->getData()['stare_inactiv']['dataPublicare'] ?? '';
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

    /**
     * @return CompanyHeadquartersAddress
     */
    public function getHeadquartersAddress(): CompanyHeadquartersAddress
    {
        return new CompanyHeadquartersAddress($this->parser);
    }

    /**
     * @return CompanyFiscalAddress
     */
    public function getFiscalAddress(): CompanyFiscalAddress
    {
        return new CompanyFiscalAddress($this->parser);
    }
}
