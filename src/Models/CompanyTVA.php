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

    // --- inregistrare_scop_Tva ---

    /**
     * @return bool
     */
    public function hasTVA(): bool
    {
        return $this->parser->getData()['inregistrare_scop_Tva']['scpTVA'] ?? false;
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
     * Data operării anulării înregistrării în scopuri de TVA
     * @return string
     */
    public function getTVACancellationDate(): string
    {
        return $this->parser->getLatestVatPeriod()['data_anul_imp_ScpTVA'] ?? '';
    }

    /**
     * Temeiul legal al anulării înregistrării în scopuri de TVA
     * @return string
     */
    public function getTVACancellationMessage(): string
    {
        return $this->parser->getLatestVatPeriod()['mesaj_ScpTVA'] ?? '';
    }

    // --- inregistrare_RTVAI (TVA la incasare) ---

    /**
     * @return bool
     */
    public function hasTVACollection(): bool
    {
        return $this->parser->getData()['inregistrare_RTVAI']['statusTvaIncasare'] ?? false;
    }

    /**
     * @return string
     */
    public function getTVACollectionEnrollDate(): string
    {
        return $this->parser->getData()['inregistrare_RTVAI']['dataInceputTvaInc'] ?? '';
    }

    /**
     * @return string
     */
    public function getTVACollectionEndDate(): string
    {
        return $this->parser->getData()['inregistrare_RTVAI']['dataSfarsitTvaInc'] ?? '';
    }

    /**
     * @return string
     */
    public function getTVACollectionUpdateDate(): string
    {
        return $this->parser->getData()['inregistrare_RTVAI']['dataActualizareTvaInc'] ?? '';
    }

    /**
     * @return string
     */
    public function getTVACollectionPublishDate(): string
    {
        return $this->parser->getData()['inregistrare_RTVAI']['dataPublicareTvaInc'] ?? '';
    }

    /**
     * @return string
     */
    public function getTVACollectionUpdateType(): string
    {
        return $this->parser->getData()['inregistrare_RTVAI']['tipActTvaInc'] ?? '';
    }

    // --- inregistrare_SplitTVA ---

    /**
     * @return bool
     */
    public function hasTVASplit(): bool
    {
        return $this->parser->getData()['inregistrare_SplitTVA']['statusSplitTVA'] ?? false;
    }

    /**
     * @return string
     */
    public function getTVASplitEnrollDate(): string
    {
        return $this->parser->getData()['inregistrare_SplitTVA']['dataInceputSplitTVA'] ?? '';
    }

    /**
     * @return string
     */
    public function getTVASplitEndDate(): string
    {
        return $this->parser->getData()['inregistrare_SplitTVA']['dataAnulareSplitTVA'] ?? '';
    }

    /**
     * @return string
     */
    public function getTVASplitIBAN(): string
    {
        return $this->parser->getData()['date_generale']['iban'] ?? '';
    }
}
