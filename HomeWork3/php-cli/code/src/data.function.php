<?php

// Урок 3. Файлы, подключение кода, Composer
// 1. Обработка ошибок. Посмотрите на реализацию функции в файле fwrite-cli.php в исходниках. Может ли пользователь ввести некорректную информацию (например, дату в виде 12-50-1548)? Какие еще некорректные данные могут быть введены? Исправьте это, добавив соответствующие обработки ошибок.

function validateName(string $name): bool
{

    $name = trim($name);

    if ($name !== '') {
        return true;
    }
    return false;
}

function validationDate(string $date): bool
{
    $dateArr = str_split($date);
    if (count($dateArr) === 10 && ctype_digit($dateArr[0]) && ctype_digit($dateArr[1]) && $dateArr[2] === '-' && ctype_digit($dateArr[3]) && ctype_digit($dateArr[4]) && $dateArr[5] === '-' && ctype_digit($dateArr[6]) && ctype_digit($dateArr[7]) && ctype_digit($dateArr[8]) && ctype_digit($dateArr[9])) {

        $dateParts = explode('-', $date);

        if ((int)$dateParts[0] < 31 && (int)$dateParts[1] < 12 && (int)$dateParts[2] > 1910 && (int)$dateParts[2] < date("Y")) {
            return true;
        }
    }

    return false;
}

// 2. Поиск по файлу. Когда мы научились сохранять в файле данные, нам может быть интересно не только чтение, но и поиск по нему. Например, нам надо проверить, кого нужно поздравить сегодня с днем рождения среди пользователей, хранящихся в формате:

// Василий Васильев, 05-06-1992

// И здесь нам на помощь снова приходят циклы. Понадобится цикл, который будет построчно читать файл и искать совпадения в дате. Для обработки строки пригодится функция explode, а для получения текущей даты – date.

function congratulations(array $config): string
{

    $address = $config['storage']['address'];

    $file = fopen($address, 'r');

    $result = "Сегодня поздравляем с днем рождения:\n";

    if ($file) {
        while (($line = fgets($file)) !== false) {
            $userName = explode(',', $line)[0];
            $userData = explode(',', $line)[1];
            $userDay = explode('-', $userData);
            if ($userDay[0] == date('d') && $userDay[1] == date('m')) {
                $result .= $userName . ", " . $userData;
            }
        }
        fclose($file);
        if ($result === "") {
            $result = "Сегодня нет дня рождения ни у одного из пользователей";
        }
        return $result;
    } else {
        return handleError("Не удалось прочитать файл");
    }
}

// 3. Удаление строки. Когда мы научились искать, надо научиться удалять конкретную строку. Запросите у пользователя имя или дату для удаляемой строки. После ввода либо удалите строку, оповестив пользователя, либо сообщите о том, что строка не найдена.

// 4. Добавьте новые функции в итоговое приложение работы с файловым хранилищем.

function deleteUser(array $config): string
{

    $address = $config['storage']['address'];

    $array = [];

    $message = "";

    $file = fopen($address, 'r');

    if ($file) {
        while (($line = fgets($file)) !== false) {
            array_push($array, $line);
        }
        fclose($file);
    } else {
        return handleError("Не удалось прочитать файл");
    }

    $consoleStr = readline("Введите имя или дату в формате ДД-ММ-ГГГГ: ");
    $search = trim($consoleStr);

    foreach ($array as $key => $value) {
        $userName = explode(',', $value)[0];
        $userData = explode(',', $value)[1];

        if($userName === $search || $userData === $search) {
            unset($array[$key]);
        }
    }
    if ($message === "") {
        $message = "нет пользователей с такими данными";
    } else {
        $file = fopen($address, 'w');
        fclose($file);
        $file = fopen($address, 'a');

        if ($file) {
            foreach ($array as $key => $value) { 
                fwrite($file, $value);
            }
            fclose($file);
            $message = "Файл записан";
        } else {
            return handleError("Не удалось записать файл");
        }
    }

    return $message;
}