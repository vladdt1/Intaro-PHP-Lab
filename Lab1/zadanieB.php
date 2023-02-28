<?php
function B($b){
    //Создаем строковый массив с данными из файла
    $emptyArray = [];
    //Переменная с результатом
    $res = '';
    //Подключение к файлу
    $fd = fopen($b, 'r') or die("не удалось открыть файл");
    //Количество строк в файле
    $n = count(file($b));
    //Главный цикл
    for ($j = 0; $j < $n; $j++) {
        //Читаем каждую строку из файла
        $empty_str = fgets($fd);
        //Разбиваем строку на элементы по ":"
        $emptyArray = explode(":", $empty_str);
        //Цикл с заполнением недостоющих элементов
        for ($i = 0; $i < count($emptyArray); $i++) {
            //Для заполнения нулями удалим лишкие пробелы
            $emptyArray[$i] = trim($emptyArray[$i]);
            //Если количество символов в элементе равно нулю
            if (strlen($emptyArray[$i])==0) {
                //Если элементов в строке меньше 8, то заполним их нулями
                while (count($emptyArray) < 8) {
                    array_splice($emptyArray, $i, 0, "0000");
                }
            }
        }
        //Цикл с заполнением недостоющих нулей
        for ($i = 0; $i < 8; $i++) {
            while(strlen($emptyArray[$i]) < 4){
                $emptyArray[$i] = "0" . $emptyArray[$i]; 
            }
        }
        // Записываем все результаты в строку
        foreach($emptyArray as $row){
            $res .= $row . ":";
        }	
        //Удаляем последнее двоеточие
        $res = substr($res,0,-1);
        $res .= "\n";
    }
    return $res;
}

$input = glob('B/*.dat');
$output = glob('B/*.ans');
$ntest = 1;
for($z = 0; $z < 8; $z++){
    echo "Test $ntest: ";
    $ntest++;
    if (B($input[$z]) == file_get_contents($output[$z], 'r')){
        echo "True\n";
    }
    else{
        echo "False\n";
    }
}
?>