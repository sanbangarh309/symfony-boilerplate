<?php

namespace App\Services;

class GoogleGeocodingService
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
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
        $data = $this->getLocations($latitude, $longitude);

        // Check if the response is valid and contains results
        if (isset($data['results'][0]['formatted_address'])) {
            return $data['results'][0]['formatted_address']; // Return the formatted address
        }

        return null; // Return null if no address was found
    }

    public function getLocations(float $latitude, float $longitude)
    {
        // Build the URL for the Google Maps Geocoding API
        $url = sprintf(
            'https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&key=%s',
            $latitude,
            $longitude,
            $this->apiKey
        );

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Optional timeout

        // Execute the request and fetch the response
        $response = curl_exec($ch);

        // Check for any cURL errors
        if (curl_errno($ch)) {
            throw new \Exception('cURL error: ' . curl_error($ch));
        }

        // Close the cURL session
        curl_close($ch);

        // Decode the response
        $data = json_decode($response, true);

        return $data;
    }
}
