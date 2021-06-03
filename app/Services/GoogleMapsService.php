<?php


namespace App\Services;


use App\Exceptions\GoogleMapsException;

class GoogleMapsService
{
    protected $apiKey = "";
    protected $apiEndpoint = 'https://maps.googleapis.com/maps/api/geocode/json';

    public function __construct()
    {
        $this->apiKey = config('google.maps_api_key');
    }

    /**
     * @throws GoogleMapsException
     */
    public function getByAddress($address)
    {
        $retJson = file_get_contents($this->apiEndpoint . '?address=' . urlencode($address) .
            '&key=' . $this->apiKey);
        if (empty($retJson)) {
            throw(new GoogleMapsException('No response from google maps'));
        }

        $geocoding = json_decode($retJson);
        if (empty($geocoding) || $geocoding->status != 'OK') {
            throw(new GoogleMapsException('Failed to decode google maps response'));
        }

        return $geocoding->results;
    }
}
