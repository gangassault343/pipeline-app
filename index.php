<?php
$response = file_get_contents("https://api.adviceslip.com/advice");
$data = json_decode($response, true);

$advice = "Loading...";

if (isset($data['slip']['advice'])) {
    $advice = $data['slip']['advice'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>💬 Advice of the Day</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .quote-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            width: 500px;
            text-align: center;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        #quoteBox {
            font-size: 18px;
            line-height: 1.6;
            margin: 20px 0;
            transition: opacity 0.5s ease;
        }

        /* Spinner */
        .spinner {
            border: 4px solid rgba(255,255,255,0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
            display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Fade */
        .fade-out {
            opacity: 0;
        }

        /* Button */
        button {
            background: white;
            color: #764ba2;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #eee;
            transform: scale(1.05);
        }

        /* Entry animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile responsive */
        @media (max-width: 600px) {
            .quote-box {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="quote-box">
    <h2>💬 Daily Advice 17 Apr 2026</h2>

    <div id="spinner" class="spinner"></div>

    <div id="quoteBox">
        "<?php echo $advice; ?>"
    </div>

    <button onclick="fetchQuote()">🔄 New Advice</button>
</div>

<script>
function fetchQuote() {
    const quoteBox = document.getElementById('quoteBox');
    const spinner = document.getElementById('spinner');

    quoteBox.classList.add('fade-out');
    spinner.style.display = 'block';

    fetch('quote.php')
        .then(response => response.text())
        .then(data => {
            setTimeout(() => {
                quoteBox.innerHTML = data;
                spinner.style.display = 'none';
                quoteBox.classList.remove('fade-out');
            }, 500);
        })
        .catch(() => {
            spinner.style.display = 'none';
            quoteBox.innerHTML = "⚠️ Error fetching advice";
            quoteBox.classList.remove('fade-out');
        });
}

fetchQuote();
setInterval(fetchQuote, 10000);
</script>

</body>
</html>
