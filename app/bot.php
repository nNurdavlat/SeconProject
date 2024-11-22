<?php
require "src/Bot.php";

require "src/Currency.php";

require "src/Weather.php";


$bot = new Bot();

$currency = new Currency();

$weather = new Weather();


$update = json_decode(file_get_contents("php://input")); // Telegramga start bosilganini ushlab olish uchun ishlatiladi
// Uni ushlab olib o'shanga qarab javob qaytarsak bo'ladi

if (isset($update)) {

    $message = $update->message;
    $chat_id = $message->chat->id;
    $user_name = $message->chat->username;
    $from_id = $update->message->from->id;
    $text = $update->message->text; // Kelgan so'zni $text ga ozlashtirib qo'yamiz




    // Salomlashish uchun
    if ($text == '/start') {
        $bot->saveUser($from_id, $user_name);


        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => "Hello. You're Welcome"
        ]);
    }

    // Valyutalarni ko'rish uchun
    if ($text == '/currency') {
        $currencies = $currency->getCurrencies();
        $currencies_list = "";

        foreach ($currencies as $currency => $rate) {
            $currencies_list .= "1000 " . $currency . " : " . $rate . " UZS" . "\n";
        }
        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $currencies_list,
        ]);
    }


    if ($text == '/weather') {
        $informations_list = "";
        $informations_list .= "Tashkent" . "\n";
        $informations_list .=  "Harorat: " . ($weather->getWeather()->main->temp - 273.15) . "°C" . "\n";
        $informations_list .=  "Namlik: " . $weather->getWeather()->main->humidity . "%" . "\n";
        $informations_list .= "Bosim: " . $weather->getWeather()->main->pressure . "\n";
        $informations_list .= "Shamol: " . $weather->getWeather()->wind->speed;

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $informations_list,
        ]);
    }



}

