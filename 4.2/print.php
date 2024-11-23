<?php
$serializedData = file_get_contents('library.txt');

$library = unserialize($serializedData);

if ($library === false) {
    die("Ошибка десериализации данных.");
}

$html = "<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Библиотека</title>
    <!-- Подключение Bootstrap CSS -->
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
    <div class='container mt-5'>
        <h1 class='text-center'>Список книг у бібліотеці</h1>
        <table class='table table-bordered'>
            <thead class='thead-light'>
                <tr>
                    <th>Назва</th>
                    <th>Автор</th>
                    <th>Рік</th>
                    <th>Жанр</th>
                </tr>
            </thead>
            <tbody>";

foreach ($library as $book) {
    $html .= "<tr>";
    $html .= "<td>" . htmlspecialchars($book['Назва']) . "</td>";
    $html .= "<td>" . htmlspecialchars($book['Автор']) . "</td>";
    $html .= "<td>" . htmlspecialchars($book['Рік']) . "</td>";
    $html .= "<td>" . htmlspecialchars($book['Жанр']) . "</td>";
    $html .= "</tr>";
}

$html .= "</tbody>
        </table>
    </div>
    <!-- Подключение jQuery и Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>
</html>";

if (!file_exists('result')) {
    mkdir('result');
}

file_put_contents('result/library.html', $html);

echo "HTML-сторінка успішно створена і записана у файл result/library.html.";
?>