<?php

class Currency
{

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

    public function getCurrencies(): array
    {
        $separated_data = [];
        $currencies_info = $this->currencies;
        foreach ($currencies_info as $currency) {
            $separated_data[$currency->Ccy] = $currency->Rate;
        }
        return $separated_data;
    }


    public function exchange(string $from, string $to, int $pul_miqdori)
    {
        if (isset($pul_miqdori) and isset($from)  and isset($to)) {
            if ($from == $to){
                return "Ikkala valyuta bir xil";
            }
            elseif ($from == "UZS") {
                $total = $pul_miqdori / (int)$this->getCurrencies()[$to];
                return $pul_miqdori . ' ' . $from . '=' . $total . ' ' . $to;
            } elseif ($to == 'UZS') {
                $total = $pul_miqdori * (int)$this->getCurrencies()[$from];
                return $pul_miqdori . ' ' . $from . '=' . $total . ' ' . $to;
            } else {
                return "Not found UZS currency";
            }
        }else{
            return "Something is wrong";
        }
    } 

}
?>
