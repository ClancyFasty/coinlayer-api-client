<?php

class CoinLayerAPI {
    private const API_URL = "http://api.coinlayer.com/live?access_key=#";

    /**
     * Method to get the live data from the CoinLayer API
     *
     * @return array Live data in the form of associative arrays
     * @throws Exception If an error occurs while retrieving the data or if the response contains an error
     */
    public static function fetchLiveData(): array {
        $response = file_get_contents(self::API_URL);
        if ($response === false) {
            throw new Exception("The API data could not be obtained.");
        }

        $responseData = json_decode($response, true);
        if (isset($responseData['error'])) {
            throw new Exception("Error in API response: " . $responseData['error']['info']);
        }

        return $responseData;
    }

    /**
     * Method to get and display a specific API value
     *
     * @param string $currency The code of the currency to be retrieved
     * @return void
     */
    public static function displayRate(string $currency): void {
        try {
            $liveData = self::fetchLiveData();

            if (isset($liveData['rates'][$currency])) {
                echo "Value of {$currency}: " . $liveData['rates'][$currency] . "\n";
            } else {
                echo "The value of {$currency} was not found in the response.\n";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}
