<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        article {
            width: 45%;
            float: left;
        }
    </style>
</head>

<body>
    <h1>My website</h1>

    <section>
        <article> This my part of the page </article>
        <article>
            <h2>This is the section for Rss</h2>
            <?php

            $rss_feed_url = 'https://www.ghspjournal.org/rss/current.xml';

            $xml = simplexml_load_file($rss_feed_url);

            echo '<h2>' . $xml->channel->title . '</h2>';
            $counter = 0;
            foreach ($xml->channel->item as $item) {
                echo '<h3><a href="' . $item->link . '">' . $item->title . '</a></h3>';
                echo $item->pubDate;
                $counter++;
                if ($counter == 10) {
                    break;
                }
            }

            ?>
        </article>
    </section>

</body>

</html>
