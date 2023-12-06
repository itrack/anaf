<?php
namespace Itrack\Anaf\Models;

use Itrack\Anaf\Parser;

class CompanyTVA
{
    /** @var Parser */
    private $parser;

    /**
     * CompanyTVA constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return bool
     */
    public function hasTVA(): bool
    {
        return $this->parser->getData()['inregistrare_scop_Tva']['scpTVA'];
    }

    /**
     * @return string
     */
    public function getTVAEnrollDate(): string
    {
        return $this->parser->getLatestVatPeriod()['data_inceput_ScpTVA'] ?? '';
    }

    /**
     * @return string
     */
    public function getTVAEndDate(): string
    {
        return $this->parser->getLatestVatPeriod()['data_sfarsit_ScpTVA'] ?? '';
    }

    /**
     * @return bool
     */
    public function hasTVACollection(): bool
    {
        return $this->parser->getData()['inregistrare_RTVAI']['statusTvaIncasare'];
    }

    /**
     * @return string
     */
    public function getTVACollectionEnrollDate(): string
    {
        return $this->parser->getData()['inregistrare_RTVAI']['dataInceputTvaInc'];
    }

    /**
     * @return string
     */
    public function getTVACollectionEndDate(): string
    {
        return $this->parser->getData()['inregistrare_RTVAI']['dataSfarsitTvaInc'];
    }

    /**
     * @return bool
     */
    public function hasTVASplit(): bool
    {
        return $this->parser->getData()['inregistrare_SplitTVA']['statusSplitTVA'];
    }

    /**
     * @return string
     */
    public function getTVASplitEnrollDate(): string
    {
        return $this->parser->getData()['inregistrare_SplitTVA']['dataInceputSplitTVA'];
    }

    /**
     * @return string
     */
    public function getTVASplitEndDate(): string
    {
        return $this->parser->getData()['inregistrare_SplitTVA']['dataAnulareSplitTVA'];
    }

    /**
     * @return string
     */
    public function getTVASplitIBAN(): string
    {
        return $this->parser->getData()['date_generale']['iban'];
    }
}
