<!-- http://localhost/Transform/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Text Transformation</title>
    <style>
        body {
            display: grid;
            justify-content: center;
            margin-top: 50px;
            gap: 50px;
        }

        form,
        .result-box {
            background: aliceblue;
            padding: 20px;
            border-radius: 20px;
            font-size: 18px;
        }

        textarea {
            padding: 10px;
            font-size: 18px;
            border: 1px solid #999;
            border-radius: 6px;
        }

        .btn {
            font-size: 18px;
            padding: 8px;
            border: 1px solid #999;
            border-radius: 6px;
            background: #6bb7f8;
        }
    </style>
</head>

<body>
    <form method="post" action="">
        <label for="inputText">Enter text:</label><br>
        <textarea id="inputText" name="inputText" rows="4" cols="50"></textarea><br><br>
        <input type="submit" class="btn" value="Transform">
    </form>
    <div class="result-box">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputText = $_POST["inputText"];

            // Transform the text: convert to lowercase, then capitalize the first letter of each word
            $lowercaseText = strtolower($inputText);
            $transformedText = ucwords($lowercaseText);

            echo "<h2>Transformed Text:</h2>";
            echo "<p>" . htmlspecialchars($transformedText) . "</p>";
        }
        ?>
    </div>
</body>

</html>