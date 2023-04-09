<?php
require_once '../src/CoinLayerAPI.php';

// Imprimir el valor de BTC
CoinLayerAPI::displayRate('BTC');

// Imprimir el valor de ETH
CoinLayerAPI::displayRate('ETH');