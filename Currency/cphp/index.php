<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <style>
        body {
            display: grid;
            justify-content: center;
            margin-top: 50px;
        }

        .main-container {
            background: aliceblue;
            padding: 20px;
            border-radius: 10px;
            font-size: x-large;
        }

        h2 {
            margin: auto 0 20px 0;
            font-size: larger;
        }

        input,
        button {
            font-size: 18px;
            padding: 8px;
            border: 1px solid #999;
            border-radius: 6px;
        }

        select {
            width: 100%;
            font-size: 18px;
            padding: 8px;
            border: 1px solid #999;
            border-radius: 6px;
        }

        form {
            display: grid;
            gap: 20px;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <h2>Currency Converter</h2>
        <form method="post">
            <div>
                <label for="amount">Amount</label>
                <input type="number" min="0" name="amount" required>
            </div>
            <div>
                <select name="from_currency" id="">
                    <option value="RS">RS</option>
                    <option value="USD">usd</option>
                    <option value="EUR">eur</option>
                </select>
            </div>
            <div>
                <select name="to_currency" id="">
                    <option value="RS">RS</option>
                    <option value="USD">usd</option>
                    <option value="EUR">eur</option>
                </select>
            </div>
            <button type="submit" name="convert">Convert</button>
        </form>
        <div class="result-container">
            <?php
            if (isset($_POST["convert"])) {
                $amount = $_POST["amount"];
                $from_currency = $_POST["from_currency"];
                $to_currency = $_POST["to_currency"];

                $exchange_rate = [
                    "RS" => ["USD" => 0.012, "EUR" => 0.0111],
                    "USD" => ["RS" => 83.25, "EUR" => 0.9],
                    "EUR" => ["RS" => 90.32, "USD" => 1.09]
                ];

                $converted_amount = $amount * $exchange_rate[$from_currency][$to_currency];
                echo "<p>$amount $from_currency is equal to " . number_format($converted_amount, 2) . " $to_currency</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>