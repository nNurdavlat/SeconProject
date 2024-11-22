<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri == '/weather'){
    require "resurces/views/weather.php";

}elseif ($uri == '/currency'){
    require "src/Currency.php";
    $currency = new Currency();
    $currencies = $currency->getCurrencies();
    require "resurces/views/currency_views.php";
}elseif ($uri == '/telegram'){
    require "app/bot.php";
}

