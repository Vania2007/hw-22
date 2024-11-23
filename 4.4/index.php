<?php

header("Content-Type: text/html; charset=utf-8");

require 'simplehtmldom/simple_html_dom.php';

$foxtrot = file_get_html("https://allo.ua/ua/products/notebooks/");

$links = [];
$names = [];
$price = [];

if (count($foxtrot->find('.product-card__content'))) {
    foreach ($foxtrot->find('.product-card__content .product-card__title') as $a) {
        $links[] = $a->href;
        $names[] = strip_tags($a->innertext);
    }

    foreach ($foxtrot->find('.product-card__content .sum') as $span) {
        $price[] = strip_tags($span->innertext) . " ₴";
    }
}

$csvData = [];

for ($i = 0; $i < count($names); $i++) {
    $csvData[] = [$names[$i], $links[$i], isset($price[$i]) ? $price[$i] : 'Не вказано'];
}

$path = "allo";
if (!is_dir($path)) {
    mkdir($path);
}

$csvFile = fopen($path . "/allo.csv", "w");
foreach ($csvData as $line) {
    fputcsv($csvFile, $line);
}
fclose($csvFile);

echo "Дані успішно записані у файл allo/allo.csv";