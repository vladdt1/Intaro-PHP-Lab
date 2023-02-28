<?php
function A($a){
    //Открываем файл с названием out.txt функцией fopen, в переменной fd будет лежать дескриптор нашего файла
    $fd = fopen($a, 'r') or die("не удалось открыть файл");
    //Для построчного чтения используется функция fgets(), которая получает дескриптор файла и возвращает одну считанную строку
    //В переменной numbids хранится первая строчка массива, а точнее количество ставок игрока
    $numbids = fgets($fd);
    //Создадим массив в котором будут хваниться все ставки игрока
    $bidsArr = [];
    //Заполнение массива с ставками игрока
    for($i = 0; $i < $numbids; $i++){
        //Считываем строчку
        $input_bids_str = fgets($fd);
        //Разделяем значения в строчке по пробелам и помещаем  в массив
        $input_bids_arr = explode(" ", $input_bids_str);
        //Заполняем двумерный массив с данными
        array_push($bidsArr, $input_bids_arr);
    }
    //Создание переменной с количеством игр
    $numgames = fgets($fd);
    //Создадим массив, в котором будут находиться строчки исходов игр 
    $gamesArr = [];
    //Заполнение массива с играми
    for($j = 0; $j < $numgames; $j++){
        $input_games_str = fgets($fd);
        $input_games_arr = explode(" ", $input_games_str);
        array_push($gamesArr, $input_games_arr);
    }
    //В переменной bal будет находиться баланс игрока
    $bal = 0;
     //Функция подсчета баланса игрока по выйгрышным и проигрышным ставкам
    //  for ($i=0;$i<$z;$i++){
    //      //Считаем поочередно каждую строчку из массива с ставками
    //     $bidsStr = $bidsArr[$i];
    //      //Разобьём каждое значение из строчки и запишим в массив bidsArrOne
    //     $bidsArrOne = explode(" ", $bidsStr);
    //     //print_r($bidsArrOne);
    //      //В переменной sumbids хванится сумма всех сделанных ставок игрока
    //     $bal += $bidsArrOne[1];
    //      //Считаем поочередно каждую строчку из массива с играми
    //     $gamesStr = $gamesArr[$i];
    //      //Разобьём каждое значение из строчки и запишим в массив gamesArrOne
    //     $gamesArrOne = explode(" ", $gamesStr);
    //     //print_r($gamesArrOne);
    //      //Реализуем ставнение сделанных ставок игроком и результатами игр
        
    //     //      //Если игрок победил попадаем внутрь условия
    //     //      //Далее идет расчет суммы выигрышной ставки
    //      //for($j=0;$j<$numgames;$j++){
            
    //         }
    //С помощью 2 циклов проверсяем каждый индекс игры и ставки
    for($i = 0; $i < $numbids; $i++){
        for($j = 0; $j < $numgames; $j++){
            //Если индексы равны, то заходим внутрь условия
            if($bidsArr[$i][0] == $gamesArr[$j][0]){
                //Проверка на ставку исхода на бой и в случае победы ставка умножается на коэффицент
                if($bidsArr[$i][2] == $gamesArr[$j][4] && $bidsArr[$i][2] == "L\n"){
                    $bal += $bidsArr[$i][1] * $gamesArr[$j][1];
                }else if ($bidsArr[$i][2] == $gamesArr[$j][4] && $bidsArr[$i][2] == "R\n"){
                    $bal += $bidsArr[$i][1] * $gamesArr[$j][2];
                }else if ($bidsArr[$i][2] == $gamesArr[$j][4] && $bidsArr[$i][2] == "D\n"){
                    $bal += $bidsArr[$i][1] * $gamesArr[$j][3];
                    //В случае поражения сумма ставки отнимается из баланса
                }else{
                    $bal -= $bidsArr[$i][1];
                    break;
                }
                $bal -= $bidsArr[$i][1];
            }
        }
    }
    return $bal;
}

 $input_file = glob('A/*.dat');
 $output_file = glob('A/*.ans');
 $n_tests = 8;
 $c = 1;
 for($k = 0; $k < $n_tests; $k++){
     echo "Test $c: ";
     $c++;
     if (A($input_file[$k]) == file_get_contents($output_file[$k], 'r')){
         echo "True\n";
     }
     else{
         echo "False\n";
     }
 }
?>