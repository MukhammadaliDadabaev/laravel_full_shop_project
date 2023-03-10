<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class CurrencyRates
{
  // public static function getRates()
  // {
  //   $baseCurrency = CurrencyConversion::getBaseCurrency();

  //   $url = config('currency_rates.api_url') . '?base=' . $baseCurrency->code;

  //   $client = new Client();

  //   $response = $client->request('GET', $url);

  //   if ($response->getStatusCode() !== 200) {
  //     throw new Exception('Valyuta kursi xizmatida muammo bor...');
  //   }
  //   //---------------------------------------------------------------> ['rates']
  //   $rates = json_decode($response->getBody()->getContents(), true);

  //   foreach (CurrencyConversion::getCurrencies() as $currency) {
  //     if (!$currency->isMain()) {
  //       if (!isset($rates[$currency->code])) {
  //         throw new Exception('Valyuta bilan muammo bor ' . $currency->code);
  //       } else {
  //         $currency->update(['rate' => $rates[$currency->code]]);
  //         $currency->touch();
  //       }
  //     }
  //   }
  // }
}