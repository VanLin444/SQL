<?php
<?php
$connect = mysqli_connect('localhost','root','root','films','8889');
if (!$connect){
    die("Ошибка подключения к БД...<br>");
}
echo "Connected to DataBase - films<br>";

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

// Вывод уникальных значений поля Country таблицы studios
$films = mysqli_query($connect, "SELECT DISTINCT Country FROM `studios`");
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


// Вывод фильмов и их бюджетов по убыванию, то есть от самого большего к самому меньшему
$films = mysqli_query($connect, "SELECT Title, Budjet FROM `films` ORDER BY Budjet DESC");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// Вывод значений соответсвующих нескольким условиям где год от 2000 и Название фильма начинается на T
// LIKE - использется в предложении WHERE для поиска указанного шаблона в столбце.
$films = mysqli_query($connect, "SELECT Title, Budjet FROM `films` WHERE Year >= 2000 AND Title LIKE 'T%'");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// Агрегатные функции - MIN() MAX() COUNT() SUM() AVG() - Они игнорируют нулевые значения за исключением COUNT()
$films = mysqli_query($connect, "SELECT MIN(Budjet) FROM films");
$films = mysqli_fetch_all($films);
print_r('Minimum Budjet = '. $films[0][0] . '<br>');

$films = mysqli_query($connect, "SELECT MAX(Budjet) FROM films");
$films = mysqli_fetch_all($films);
print_r('Maximum Budjet = '. $films[0][0] . '<br>');

$films = mysqli_query($connect, "SELECT COUNT(Title) FROM films");
$films = mysqli_fetch_all($films);
print_r('Quantity of films = '. $films[0][0] . '<br>');


$films = mysqli_query($connect, "SELECT SUM(Budjet) FROM films");
$films = mysqli_fetch_all($films);
print_r('Total Budjet = '. $films[0][0] . '<br>');


$films = mysqli_query($connect, "SELECT AVG(Budjet) FROM films");
$films = mysqli_fetch_all($films);
print_r('Average Budjet = '. $films[0][0] . '<br>');


// IN - заменяет несколько OR
$films = mysqli_query($connect, "SELECT Name FROM studios WHERE Country IN ('China', 'Japan', 'The Republic of Korea')");
$films = mysqli_fetch_all($films);

echo '<pre>';
echo "Studios from China, Japan and Korean : <br>";
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// BETWEEN - выбирает значения в заданном диапазоне
// Если это текст то  берутся записи между 2 значениями, по первым буквам как в примере -> между A и T
// Если первая буква дальше в алфавите от второй, то соответствующих записей не найдётся
//$films = mysqli_query($connect, "SELECT * FROM films WHERE Title BETWEEN 'Alien' AND 'Taxi' ORDER BY Title");
$films = mysqli_query($connect, "SELECT * FROM films WHERE Year BETWEEN 1990 AND 2000");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// JOIN - объединяет две таблицы на основе общего столбца и выбирает записи с совпадающими значениями в этих столбцах.
// INNER JOIN - выводит только совпадающие
// LEFT JOIN - все слева и совпадающие справа
// RIGHT JOIN - все справа и совпадающие слева
// FULL OUTER JOIN - все записи с обеих таблиц с совпадающимися и отсутствующимися значениями

// $films = mysqli_query($connect, "SELECT films.Title, films.Year, studios.Name FROM films JOIN studios ON films.Studio_id = studios.id");
// Более компактная и чистая запись с использованием псевдонимов AS
$films = mysqli_query($connect, "SELECT f.Title AS 'Title', f.Year AS 'Release', s.Name AS 'Studio' FROM films AS f JOIN studios AS s ON f.Studio_id = s.id");
$films = mysqli_fetch_all($films);

echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// UNION - объединение 2 или более завявлений SELECT.
// Должно быть одинаковое количество столбцов и типы данных.
// UNION выбирает только уникальные значения, без дублируащихся. Для добавления всех исп-ся UNION ALL.
$films = mysqli_query($connect, "SELECT TItle FROM films UNION SELECT Name FROM studios");
$films = mysqli_fetch_all($films);

echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';

// GROUP BY - позволяет организовать похожие данные в категории
// В данном случае подсчитываеися количество студий в разных странах
$films = mysqli_query($connect, "SELECT Country, COUNT(Name) FROM studios GROUP BY Country");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// CASE - исп -ся для проверки условий и выполнения операций над даннными. 
// В данном случае если фильм вышел начиная с 2000 года он считается новым, а иначе старым.
$films = mysqli_query($connect, "SELECT Title, Year,  CASE WHEN Year >= 2000 THEN 'New' ELSE 'Old' END AS 'status' FROM films");
$films = mysqli_fetch_all($films);
echo '<pre>';
foreach ($films as $film) {
    foreach ($film as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// HAVING - исп-ся когда нужно отфильтровать данные на основе агрегатных функций
$films = mysqli_query($connect, "SELECT Country, COUNT(Country) FROM studios GROUP BY Country HAVING COUNT(Country) > 1");
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
mysqli_close($connect);


$connect = mysqli_connect('localhost','root','root','actors','8889');
if (!$connect){
    die("Ошибка подключения к БД...<br>");
}
echo "Connected to DataBase - actors<br>";

/*
// Добавление Значений в таблицу
$actors = mysqli_query($connect, "INSERT INTO actors (Name, Date) VALUES ('Ivan', 1998)");
$actors = mysqli_query($connect, "SELECT * FROM `actors`");
$actors = mysqli_fetch_all($actors);

echo '<pre>';
foreach ($actors as $actor) {
    foreach ($actor as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// Обновление данных. Именно WHERE определяет какие данные изменятся!
$actors = mysqli_query($connect, "UPDATE `actors` SET Name = 'Hans', Date = 2001 WHERE Actor_id = 7");
$actors = mysqli_query($connect, "SELECT * FROM `actors`");
$actors = mysqli_fetch_all($actors);

echo '<pre>';
foreach ($actors as $actor) {
    foreach ($actor as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';


// Удаление данных. Именно WHERE определяет какие данные удаляются.
// Если не указать WHERE тогда удалятся все данные с таблицы!
$actors = mysqli_query($connect, "DELETE FROM actors WHERE Name = 'John'");
$actors = mysqli_query($connect, "SELECT * FROM `actors`");
$actors = mysqli_fetch_all($actors);

echo '<pre>';
foreach ($actors as $actor) {
    foreach ($actor as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';
*/

mysqli_close($connect);


$connect = mysqli_connect('localhost','root','root','worldninja','8889');
if (!$connect){
    die("Ошибка подключения к БД...<br>");
} else
echo "Connected to DataBase - worldninja<br>";

/*
// Создание таблицы Ninja в базе данных worldninja, если таковой таблицы ещё не существует
//$worldnin = mysqli_query($connect, "CREATE TABLE IF NOT EXISTS Ninja ( id int, name varchar(50), rank varchar(5), village varchar(50), PRIMARY KEY (id))");
// Изменение свойств столбца rank 
//$worldnin = mysqli_query($connect, "ALTER TABLE ninja MODIFY COLUMN rank varchar(5)");
$worldnin = mysqli_fetch_all($worldnin);

echo '<pre>';
foreach ($worldnin as $nin) {
    foreach ($nin as $column){
        print_r($column . " | ");
    }
    echo "\n";
   
}
echo '</pre>';
*/

mysqli_close($connect);


?>
