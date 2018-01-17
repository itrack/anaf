<?php
namespace Itrack\Anaf;

/**
 * Implementare API V3 ANAF
 * https://webservicesp.anaf.ro/PlatitorTvaRest/api/v3/
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
    protected $apiUri = 'https://webservicesp.anaf.ro/PlatitorTvaRest/api/v3/ws/tva';

    /**
     * CUI List
     *
     * @var array
     */
    protected $cuis = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * Add cui to list
     *
     * @param $cui
     * @param null $date
     * @return $this
     */
    public function addCui($cui, $date = null)
    {

        // If not have set date return today
        if(is_null($date)) {
            $date = date('Y-m-d');
        }

        // Limit maxim numbers of cuis
        if(count($this->cuis) >= self::ANAF_CUI_LIMIT) {
            $this->errors = "You have exceeded the large number of cui's allowed!";
            return $this;
        }

        // Add cui to list
        $this->cuis[] = [
            "cui" => (int)$cui,
            "data" => $date
        ];

        return $this;
    }


    /**
     * Get results of request
     *
     * @return bool|object
     */
    public function getResults()
    {
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
            $this->errors = "Response status: {$info['http_code']} | Response body: {$response}";
            return false;
        }

        // Get items
        $items = json_decode($response);

        // Check if have json because ANAF return errors in plain text
        if(json_last_error() !== JSON_ERROR_NONE) {
            $this->errors = "Json parse error | Response body: {$response}";
            return false;
        }

        // Check success stats
        if ("SUCCESS" !== $items->message || 200 !== $items->cod) {
            $this->errors = "Response message: {$items->message} | Response body: {$response}";
            return false;
        }

        // Return first item if don't more items
        if(count($items->found) == 1) {
            return $items->found[0];
        }

        return $items->found;
    }

    /**
     * Return errors if exist of false if all is OK
     *
     * @return array|bool
     */
    public function getErrors()
    {
        if(empty($this->errors)) {
            return false;
        }

        return $this->errors;
    }

}