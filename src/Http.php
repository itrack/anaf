<?php
namespace Itrack\Anaf;

use Itrack\Anaf\Exceptions\LimitExceeded;
use Itrack\Anaf\Exceptions\RequestFailed;
use Itrack\Anaf\Exceptions\ResponseFailed;

class Http
{
    /** @var string API URL for v9 */
    private const apiURL = 'https://webservicesp.anaf.ro/api/PlatitorTvaRest/v9/tva';

    /** @var int Limit for one time call */
    public const CIF_LIMIT = 100;

    /** @var int Max. number of retries */
    public const RETRIES_LIMIT = 5;

    /** @var int Sleep time between retries (in seconds) */
    const RETRY_SLEEP_TIME = 1;

    /**
     * @param array $cifs
     * @param int $tryCount
     * @return mixed
     * @throws LimitExceeded
     * @throws RequestFailed
     * @throws ResponseFailed
     */
    public static function call(array $cifs, int $tryCount = 0)
    {
        // Limit maxim numbers of cifs
        if(count($cifs) >= self::CIF_LIMIT) {
            throw new Exceptions\LimitExceeded('You can check one time up to 100 cifs.');
        }

        // Make request
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::apiURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($cifs),
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json"
            )
        ));

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        // Check http code
        if (!isset($info['http_code'])) {
            throw new Exceptions\ResponseFailed("Missing response status code");
        }
        
        if ($info['http_code'] === 400) {
            throw new Exceptions\ResponseFailed("Bad request: {$response}");
        }
        
        if ($info['http_code'] !== 200) {
            throw new Exceptions\ResponseFailed("Response status: {$info['http_code']} | Response body: {$response}");
        }

        // Get items
        $responseData = json_decode($response, true);

        // Check if have json because ANAF return errors in plain text
        if (json_last_error() !== JSON_ERROR_NONE) {
            if (self::isRequestRejectedResponse($response) && $tryCount < self::RETRIES_LIMIT) {
                usleep(self::RETRY_SLEEP_TIME * 1e6);

                return self::call($cifs, ++$tryCount);
            }

            throw new Exceptions\ResponseFailed("Json parse error | Response body: {$response}");
        }

        // Check if we have the expected structure
        if (!isset($responseData['found'])) {
            throw new Exceptions\RequestFailed("Invalid response format - missing 'found' field | Response body: {$response}");
        }

        return $responseData['found'];
    }

    private static function isRequestRejectedResponse(string $response): bool
    {
        return strpos($response, 'Request Rejected') !== false;
    }

}
