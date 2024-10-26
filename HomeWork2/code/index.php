<?php

// Урок 2. Условия, Массивы, циклы, функции
// 1. Реализовать основные 4 арифметические операции в виде функции с тремя параметрами – два параметра это числа, третий – операция Обязательно использовать оператор return.

function add(float $firstNumber, float $secondNumber): float
{
    return $firstNumber + $secondNumber;
}

function sub(float $firstNumber, float $secondNumber): float
{
    return $firstNumber - $secondNumber;
}

function mult(float $firstNumber, float $secondNumber): float
{
    return $firstNumber * $secondNumber;
}

function div(float $firstNumber, float $secondNumber): float
{
    return $firstNumber / $secondNumber;
}

// 2. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).

function arithmeticOperations(float $firstNumber, float $secondNumber, string $operator): float|string
{
    if ((int)$secondNumber === 0) {
        return "На ноль делить нельзя";
    }
    switch ($operator) {
        case '+':
            $result = add($firstNumber, $secondNumber);
            break;
        case '-':
            $result = sub($firstNumber, $secondNumber);
            break;
        case '*':
            $result = mult($firstNumber, $secondNumber);
            break;
        case '/':
            $result = div($firstNumber, $secondNumber);
            break;
        default:
            return "Нет такой операции";
    }
    return $result;
};

echo "Результат сложения: " . arithmeticOperations(5.7, 10.3, "+") . "<br>";
echo "Результат вычитания: " . arithmeticOperations(5, 3.3, "-") . "<br>";
echo "Результат произведения: " . arithmeticOperations(8, 3, "*") . "<br>";
echo "Результат деления: " . arithmeticOperations(15, 5, "/") . "<br>";
echo "Результат деления на 0: " . arithmeticOperations(8, 0, "/") . "<br>";
echo "Результат неверного оператора: " . arithmeticOperations(15, 5, "1") . "<br>";

echo "<br>";

// 3. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области. Вывести в цикле значения массива, чтобы результат был таким: Московская область: Москва, Зеленоград, Клин Ленинградская область: Санкт-Петербург, Всеволожск, Павловск, Кронштадт Рязанская область … (названия городов можно найти на maps.yandex.ru).

$regions = [
    "Московская область" => ["Балашиха", "Подольск", "Клин", "Химки"],
    "Ленинградская область" => ["Выборг", "Сертолово", "Гатчина", "Павловск"],
    "Ростовская область" => ["Таганрог", "Шахты", "Новошахтинск", "Донецк"],
    "Воронежская область" => ["Россошь", "Лиски", "Семилуки", "Богучар"]
];

$regionOutput = "";

foreach ($regions as $key => $cities) {
    $regionOutput = $key . ": ";
    foreach ($cities as $city) {
        $regionOutput .= $city . ", ";
    }
    echo $regionOutput . "<br>";
}

echo "<br>";

// 4. Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’). Написать функцию транслитерации строк.

$letters = [
    'а' => 'a',
    'б' => 'b',
    'в' => 'v',
    'г' => 'g',
    'д' => 'd',
    'е' => 'e',
    'ё' => 'e',
    'ж' => 'zh',
    'з' => 'z',
    'и' => 'i',
    'й' => 'y',
    'к' => 'k',
    'л' => 'l',
    'м' => 'm',
    'н' => 'n',
    'о' => 'o',
    'п' => 'p',
    'р' => 'r',
    'с' => 's',
    'т' => 't',
    'у' => 'u',
    'ф' => 'f',
    'х' => 'h',
    'ц' => 'c',
    'ч' => 'ch',
    'ш' => 'sh',
    'щ' => 'sch',
    'ь' => '\'',
    'ы' => 'y',
    'ъ' => '\'',
    'э' => 'e',
    'ю' => 'yu',
    'я' => 'ya',
    ' ' => ' ',
    ',' => ','
];

function stringTranslation(string $word, array $letters): string
{
    $wordTranslated = "";
    $word = mb_strtolower($word);
    for ($i = 0; $i < strlen($word); $i++) {
        $letter = mb_substr($word, $i, 1);
        foreach ($letters as $key => $value) {
            if ($letter === $key) {
                $wordTranslated .= $value;
            }
        }
    }

    return $wordTranslated;
}

$word = "Нет рабства безнадежней, чем рабство тех рабов, себя кто полагает свободным от оков";

$res = stringTranslation($word, $letters);

echo $res . "<br>";

// 5. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.

function power(int $val, int $pow): int
{
    if ($pow === 1) {
        return $val;
    }
    return $val * power($val, $pow - 1);
}

echo "Результат возведения числа в степень с помощью рекурсии 2 в 3 степени: " . power(2, 3) . "<br>";

// 6. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
// 22 часа 15 минут
// 21 час 43 минуты.

function currentTime(): string {
    date_default_timezone_set('Europe/Moscow');
    $currentTime = date("H часов i минут");

    return $currentTime;
}

echo "Текущее время: ".currentTime();
