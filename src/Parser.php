<?php
namespace Itrack\Anaf;

class Parser
{
    /** @var array */
    private $data = [];

    /**
     * Parser constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getAddress(): array
    {
        $address = [];

        // Normal case from all uppercase
        $rawText = mb_convert_case($this->data['adresa'], MB_CASE_TITLE, 'UTF-8');

        // Parse address
        $list = array_map('trim', explode(",", $rawText, 5));
        list($county, $city, $street, $number, $other) = array_pad($list, 5, '');

        // Parse county
        $address['county'] = trim(str_replace('Jud.', '', $county));

        // Parse city
        $address['city'] = trim(str_replace(['Mun.', 'Orş.'], ['', 'Oraş'], $city));

        // Parse street
        $address['street'] = trim(str_replace('Str.', '', $street));

        // Parse street number
        $address['streetNumber'] = trim(str_replace('Nr.', '', $number));

        // Parse others
        $address['others'] = trim($other);

        return $address;
    }

    /**
     * @return false|string
     */
    public function getRegisterDate()
    {
        $rawDate = trim(str_replace('INREGISTRAT din data ', '', $this->data['stare_inregistrare']));
        return date("Y-m-d", strtotime($rawDate));
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->data['codPostal'];
    }
}