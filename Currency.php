<?php

class Currency{

    const CURRENCY_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    
    public $currencies = [];

    public function __construct()
    {
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, self::CURRENCY_API_URL);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $output = curl_exec($ch);
     curl_close($ch);
     $this->currencies = json_decode($output);
    }

    public function getCurrencies(): array {
        $separated_data = [];
        $currencies_info = $this->currencies;
        foreach ($currencies_info as $currency) {
            $separated_data[$currency->Ccy] = $currency->Rate; 
        }
        return $separated_data;
    }


    public function exchange($value,$currency_name='USD') {

        $round = $value / $this->getCurrencies()[$currency_name]; // Nimaga roundga tengladik chunki . dan keyin 2ta soni chiqarish uchun yordam beradi
        return round($round,3) . ' ' . $currency_name;    } // Bu yerda round(. dan keyin 3 ta soni chiqaradi)

}



// sum -> dollarga 
// 1280381 / 12800 = 100 dollar

// dollar -> summga 
// 100 * 12.800 = 1 280 000 sum







