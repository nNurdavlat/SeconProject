<?php
    require "src/Currency.php";

    $currency = new Currency();

    $currencies = $currency->getCurrencies();

    
    require "resurces/views/currency_views.php";

