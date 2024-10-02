<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleGeocodingService
{
    private $client;
    private $apiKey;

    public function __construct(HttpClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * Get address from latitude and longitude using Google Maps Geocoding API.
     *
     * @param float $latitude
     * @param float $longitude
     * @return string|null
     */
    public function getAddressFromLatLon(float $latitude, float $longitude): ?string
    {
        // API URL
        $url = sprintf(
            'https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&key=%s',
            $latitude,
            $longitude,
            $this->apiKey
        );

        // Make the request
        $response = $this->client->request('GET', $url);
        $data = $response->toArray();

        // Check if the response is valid and contains results
        if (isset($data['results'][0]['formatted_address'])) {
            return $data['results'][0]['formatted_address']; // Return the formatted address
        }

        return null; // Return null if no address was found
    }
}
