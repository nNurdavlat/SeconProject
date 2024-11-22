<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // root_url/ <- shu chiziqdan bu tarafini olib beradi

if ($uri == '/weather'){
    require "src/Weather.php";
    $weather = new Weather();
    require "resurces/views/weather.php";

}elseif ($uri == '/currency'){
    require "src/Currency.php";
    $currency = new Currency();
    $currencies = $currency->getCurrencies();
    require "resurces/views/currency_views.php";

}elseif ($uri == '/telegram'){
    require "app/bot.php";
}

