<?php
$offers = [
    [
        "name" => "default",
        "country" => ["*"],
        // "URL" => "http://offers.test/referer.php",
        "URL" =>
            "https://www.trustedgatetocontent.com/b1h0zss9?key=fa36e0db535e20042a94f7dfd3155245", //ganti_dengan_url_direct_link_adsterra
    ],
    [
        "name" => "shopee.co.id",
        "country" => ["ID"],
        "URL" =>
            "https://t.ecomobi.com/?token=LjdZZwZBneZHhqCzkBZpa&url=https%3A%2F%2Fshopee.co.id%2F", // ganti dengan url shopee affiliate ente
    ],
    [
        "name" => "amazon.com",
        "country" => ["US"],
        "URL" =>
            "https://amzn.to/3bIgRT6", // ganti dengan url amazon affiliate ente
    ],
];

$country_code = isset($_SERVER["HTTP_CF_IPCOUNTRY"])
    ? $_SERVER["HTTP_CF_IPCOUNTRY"]
    : "*";

$valid_offers = [];

// loop through offers to find offer for this country
foreach ($offers as $offer) {
    if (in_array($country_code, $offer["country"])) {
        $valid_offers[] = $offer;
    }
}

// let's use default offer if no valid offer present
if (count($valid_offers) == 0) {
    $valid_offers[] = $offers[0];
}

shuffle($valid_offers);
$valid_offer = $valid_offers[0];

if (isset($_GET["name"])) {
    $url = "";
    foreach ($offers as $offer) {
        if ($offer["name"] === $_GET["name"]) {
            $url = is_array($offer["URL"])
                ? $offer["URL"][array_rand($offer["URL"])]
                : $offer["URL"];
        }
    }
} else {
    $url = "index.php?name=" . $valid_offer["name"];
}
?>
<html>
    <head>
        <meta http-equiv="refresh" content="0;URL=<?php echo $url; ?>">
    </head>
    <body>
        Please wait...
    </body>
</html>