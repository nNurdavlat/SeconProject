<?php

class ConnectAPI
{

    const CURRENCY_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";

    public function __construct()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::CURRENCY_API_URL); // API ga ulanish, self::CURRENCY_API_URL O'rniga tepadagi link qo'ysak bo'ladi
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Javob True qaytishi 

        $output = curl_exec($ch); // So'rov borib Javobii olib keldi
        curl_close($ch); // $ch yopdik

        //echo $output; // Kelgan javobni browserga chiqardik

        $decoded = json_decode($output); // Bu pastdagi kodni []-Bu array {}-Bu object qilib beradi
        // [
        //     {
        //         'Ccy': 'USD' 
        //     }
        // ]
        echo $decoded[0]->Ccy; // arrayni [0]-objectini -> Ccy sini chiqaradi    
    }
}
