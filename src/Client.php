<?php
namespace Itrack\Anaf;

/**
 * Implementare API V4 ANAF
 * https://webservicesp.anaf.ro/PlatitorTvaRest/api/v4/
 */
class Client
{
    /**
     * ANAF limit one times cui's
     */
    const ANAF_CUI_LIMIT = 500;

    /**
     * @var string
     */
    protected $apiUri = 'https://webservicesp.anaf.ro/PlatitorTvaRest/api/v4/ws/tva';

    /**
     * CUI List
     *
     * @var array
     */
    protected $cuis = [];

    /**
     * Add more or one cui to list
     *
     * @param $fiscals
     * @param null $date
     * @return $this
     */
    public function addCui($fiscals, $date = null)
    {
        // If not have set date return today
        if(is_null($date)) {
            $date = date('Y-m-d');
        }
        
        if(!is_array($fiscals)) {
            $fiscals = [$fiscals];
        }

        foreach($fiscals as $cui) {
            // Keep only numbers from CUI
            $cui = preg_replace('/\D/', '', $cui);

            // Add cui to list
            $this->cuis[] = [
                "cui" => $cui,
                "data" => $date
            ];
        }

        return $this;
    }

    /**
     * Get results of request
     *
     * @return array
     */
    public function getResults()
    {
        $results = $this->callApi();
        foreach($results as $company) {
            $company->adresa = $this->parseAddress($company->adresa);
        }

        return $results;
    }

    /**
     * Get first result
     *
     * @return object
     */
    public function getOneResult()
    {
        $company = $this->callApi()[0];
        $company->adresa = $this->parseAddress($company->adresa);

        return $company;
    }
    
    /**
     * Call ANAF API
     *
     * @return array
     */
    private function callApi()
    {
        // Limit maxim numbers of cuis
        if(count($this->cuis) >= self::ANAF_CUI_LIMIT) {
            throw new Exceptions\LimitExceeded('Poti verifica simultam pana la 500 de CUI-uri.');
        }

        // Make request
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($this->cuis),
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json"
            )
        ));

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        // Check http code
        if (!isset($info['http_code']) || $info['http_code'] !== 200) {
            throw new Exceptions\ResponseFailed("Response status: {$info['http_code']} | Response body: {$response}");
        }

        // Get items
        $items = json_decode($response);

        // Check if have json because ANAF return errors in plain text
        if(json_last_error() !== JSON_ERROR_NONE) {
            throw new Exceptions\ResponseFailed("Json parse error | Response body: {$response}");
        }

        // Check success stats
        if ("SUCCESS" !== $items->message || 200 !== $items->cod) {
            throw new Exceptions\RequestFailed("Response message: {$items->message} | Response body: {$response}");
        }

        return $items->found;
    }

    /**
     * Parse company address
     *
     * @return object
     */
    private function parseAddress($raw)
    {
        // Check if raw is empty
        if(empty($raw)) {
            return $raw;
        }

        // Normal case from all uppercase
        $rawText = mb_convert_case($raw, MB_CASE_TITLE, 'UTF-8');

        // Parse address
        $list = array_map('trim', explode(",", $rawText, 5));
        list($judet, $localitate, $strada, $numar, $altele) = array_pad($list, 5, '');

        // Parse county
        $judet = trim(str_replace('Jud.', '', $judet));

        // Parse city
        $localitate = trim(str_replace(['Mun.', 'Orş.'], ['', 'Oraş'], $localitate));

        // Parse street
        $strada = trim(str_replace('Str.', '', $strada));

        // Parse number
        $numar = trim(str_replace('Nr.', '', $numar));

        // New object for address
        $address = new \stdClass;

        $address->raw = $raw;
        $address->judet = $judet;
        $address->localitate = $localitate;
        $address->strada = $strada;
        $address->numar = $numar;
        $address->altele = $altele;

        return $address;
    }
}
