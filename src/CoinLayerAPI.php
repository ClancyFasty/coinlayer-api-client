<?php
// src/CoinLayerAPI.php

class CoinLayerAPI {
    private const API_URL = "http://api.coinlayer.com/live?access_key=1ac3f3b3fc4d4601c51059652a85b6ce";

    /**
     * Método para obtener los datos en vivo de la API de CoinLayer
     *
     * @return array Los datos en vivo en forma de arreglo asociativo
     * @throws Exception Si ocurre un error al obtener los datos o si la respuesta contiene un error
     */
    public static function fetchLiveData(): array {
        $response = file_get_contents(self::API_URL);
        if ($response === false) {
            throw new Exception("No se pudo obtener los datos de la API.");
        }

        $responseData = json_decode($response, true);
        if (isset($responseData['error'])) {
            throw new Exception("Error en la respuesta de la API: " . $responseData['error']['info']);
        }

        return $responseData;
    }

    /**
     * Método para obtener y mostrar un valor específico de la API
     *
     * @param string $currency El código de la moneda que se desea obtener
     * @return void
     */
    public static function displayRate(string $currency): void {
        try {
            $liveData = self::fetchLiveData();

            if (isset($liveData['rates'][$currency])) {
                echo "Valor de {$currency}: " . $liveData['rates'][$currency] . "\n";
            } else {
                echo "No se encontró el valor de {$currency} en la respuesta.\n";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}