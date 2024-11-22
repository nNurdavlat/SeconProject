<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="resurces/css/style.css">
</head>

<body>
    <div class="currency-section text-center pt-5 bg-primary-subtle">
        <h1>Currency Converter</h1>
        <p>Need to make an international business payment? Take a look at our live foreign exchange rates.</p>
        <div class="currency-card">
            <h3>Make fast and affordable international business payments</h3>
            <p>Send secure international business payments in XX currencies, all at competitive rates with no hidden
                fees.</p>
            <form>
                <div class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <label for="amount" class="form-label visually-hidden">Amount</label>
                        <input type="number" name="pul_miqdori" id="amount" class="form-control" placeholder="Amount" value="10000">
                    </div>
                    <div class="col-md-3 text-center">
                        <select class="form-select" name="from">  <!--UI ga chiqaradi-->
                            <option value="UZS">UZS</option> <!--Pul birliklar ichida UZS yo'qligi uchun o'zimiz qo'lbola qo'shib qo'ydik-->
                            <?php
                            $i = 1;
                            global $currencies; // Bu currensies main.php dagi. List(Desak ham bo'ladi);
                            //[
                            //  'USD'=>12800,
                            //  'EUR'=>13600,
                            //  'RUB'=>125
                            // ]
                            foreach ($currencies as $key => $curren) { // Key("USD") => Rate(12,800)
                                if ($i <= 10) { // 10 b]pul birligini chiqarish uchun
                                    echo '<option value="' . $key . '">' . $key . '</option>'; // Bu yerda valyutalarni taxlash uchun ishlatiladi
                                    $i++;
                                } else {
                                    $i = 1;
                                    break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1 text-center">
                        <span>⇆</span>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="to"><!--Bu ikkinchi tarafiga yozish uchu 2-Pul birligi-->
                            <?php
                            foreach ($currencies as $key => $curren) {
                                if ($i <= 10) {
                                    echo '<option value="' . $key . '">' . $key . '</option>';
                                    $i++;
                                } else {
                                    break;
                                }
                            }
                            ?>
                            <option value="UZS">UZS</option>
                        </select>
                    </div>
                </div>
                <p> <!--Eng pasida javobi chiqadi-->
                    <?php
                    global  $currency; //Bu main.php dagi obyekt olgan $currency
                    if (isset($_GET['from']) and isset($_GET['to']) and isset($_GET['pul_miqdori'])) {
                        $result = $currency->exchange((string)$_GET['from'], (string)$_GET['to'], (int)$_GET['pul_miqdori']);
                        echo $result;
                        }
                    ?>
                </p>
                <button type="submit" class="btn btn-primary btn-primary-custom mt-3">Convert</button>
            </form>
        </div>
    </div>
    <div class="info-section bg-light">
        <h4 class="fw-bold">If you want to see Tashkent weather information, click on the "Tashkent weather" button</h4>
      <a href="/weather" class="btn btn-outline-danger">Tashkent weather</a> <!--  Eng pasida Weather bor o'shani qilganman-->
    </div>
</body>

</html>