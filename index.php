<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather API Example</title>
    <style>
        body {
            background-image: url('./1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            margin-right: 1rem;
            text-align: center;
            font-size: 36px;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            animation: fadeInUp 1s ease;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
            animation: fadeIn 1s ease;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            background-color: #00000042;
            width: 87%;
            padding: 9px;
            margin: 1rem;
            border: none;
            border-radius: 4px;
            color: black;
        }

        input[type="submit"] {
            margin-left: 20%;
            width: 60%;
            background-color: #22a5c9a6;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        input[type="submit"]:hover {
            background-color: #22a5c9;
        }
       

        label {
            margin-left: 5rem;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #000;
        }

        p {
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
        }

        .weather-image {
            display: block;
            margin: 0 auto;
            max-width: 100%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <h1>Weather API </h1>
    <div class="container">
        <form method="get" action="">
            <label for="location">Enter Location (City):</label>
            <input type="text" id="location" name="location" required>
            <input type="submit" value="Get Weather">
        </form>

        <?php
        if (isset($_GET['location'])) {
            $location = urlencode($_GET['location']);
            $api_key = 'bd5e378503939ddaee76f12ad7a97608';
            $api_url = "https://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$api_key}";

            try {
                $json_data = @file_get_contents($api_url); // Use "@" to suppress errors
                if ($json_data === false) {
                    throw new Exception("Failed to fetch data");
                }

                $data = json_decode($json_data, true);

                if (isset($data['main']['temp'])) {
                    $temperature = number_format(($data['main']['temp'] - 273.15), 2); // Convert Kelvin to Celsius and round to 2 decimal places
                    $description = $data['weather'][0]['description'];
                    // $icon = $data['weather'][0]['icon'];

                    echo "<p>Temperature: {$temperature}°C</p>";
                    echo "<p>Weather Description: {$description}</p>";
                    // echo "<img src='' alt='Weather Icon' class='weather-image'>";
                } else {
                    echo "<p>Weather data not found for the location: {$location}</p>";
                }
            } catch (Exception $e) {
                echo "<p>Weather data not found for the location: {$location}</p>";
            }
        }
        ?>


    </div>
</body>

</html>