<?php
$connect = mysqli_connect('localhost','root','root','films','8889');
if (!$connect){
    die("Ошибка подключения к БД...<br>");
}
echo "Connected to DataBase<br>";

/*
// Вывод всей таблицы
$films = mysqli_query($connect, "SELECT * FROM `films`");
$films = mysqli_fetch_all($films);
echo '<pre>';
print_r($films);
echo '</pre>';

// ВЫвод столбца Title построчно
$films = mysqli_query($connect, "SELECT Title FROM `films`");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    print_r($film[0] . "\n");
}
echo '</pre>';

// Вывод уникальных значений поля Name таблицы studios
$films = mysqli_query($connect, "SELECT DISTINCT Name FROM `studios`");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    print_r($film[0] . "\n");
}
echo '</pre>';


// Вывод всех записей из таблицы films где айди студии = 5 
$films = mysqli_query($connect, "SELECT * FROM `films` WHERE Studio_id = 5");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';
*/


?>