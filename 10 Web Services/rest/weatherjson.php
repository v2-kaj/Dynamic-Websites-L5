<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" />
    <title>Responsive page</title>
    <link rel="stylesheet" href="responsive.css">
</head>

<body>
    <header class="col-12">
        <h1>Today's Weather</h1>
    </header>
    <div class="row">
        <div>
            <form action="" method="post">
                <b>City Name</b>
                <br />
                <input type="text" name="city_name" placeholder="New York" />
                <input type="submit" />
            </form>
            <?php
           
            include 'config.php';
            
            $apiKey = RAPIDAPI_KEY;
            $apiHost = RAPIDAPI_HOST;
            $city = $_POST["city_name"];
        

            if (isset($city)) {
                
                $curl = curl_init();
                
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://weatherapi-com.p.rapidapi.com/current.json?q=$city",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: $apiHost",
                        "X-RapidAPI-Key: $apiKey"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {

                    $doc = json_decode($response, true);
                    //  echo json_encode($doc, JSON_PRETTY_PRINT);
                    echo "<br>";
                    echo "<br>";
                    echo "<b>Location: </b>" . $doc['location']['name'];
                    echo "<br>";
                    echo "<b>Date and Time: </b>" . $doc['location']['localtime'];
                    echo "<br>";
                    echo "<b>Temperature in Degrees Celcius: </b>" . $doc['current']['temp_c'];
                    echo "<br>";
                    echo "<b>Feels like: </b>" . $doc['current']['feelslike_c'];
                    echo "<br>";
                    echo "<b>Weather: </b> " . $doc['current']['condition']['text'];
                    echo "<br>";
                }
            }
            ?>
        </div>
    </div>

</body>


</html>