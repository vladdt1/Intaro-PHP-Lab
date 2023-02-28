<?php
function C($c){
    // Создаем массив, в котором будет храниться всё содержимое файла ввода
    $emptyArray = [];
    //Создаем переменную для записи элементов строк в массив
    $s = 0;
    //Открываем файл с названием out.txt функцией fopen, в переменной fd будет лежать дескриптор нашего файла
    $fd = fopen($c, 'r') or die("не удалось открыть файл");
    //Для построчного чтения используется функция fgets(), которая получает дескриптор файла и возвращает одну считанную строку
    //Для получения всех строчек используем цикл while
    /*При каждом вызове fgets() PHP будет помещать указатель в конец считанной строки. Чтобы проследить окончание файла, используется 
    функция feof(), которая возвращает true при завершении файла. И пока не будет достигнут конец файла, мы можем применять функцию fgets()*/
    if ($fd) {
        while (($buffer = fgets($fd, 4096)) !== false) {
            $emptyArray[$s]= $buffer;
            $s++;
        }
        if (!feof($fd)) {
            echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
        }
        fclose($fd);
    }

    $res = "";
    //Главный цикл в котором поочередно перебираются каждые строчки главного массива и изменения записываются в результирующую строчку res
    for($i=0;$i<count($emptyArray);$i++){
        //Считаем поочередно каждую строчку из главного массива
        $str = $emptyArray[$i];
        //Убираем первую острую скобку из строчки элемента
        $resStr=str_replace('<','',$str);
        //Разобьём каждое значение из строчки и запишим в массив strArr
        $strArr = explode(">", $resStr);
        //Создадим строку с параметрами валидации
        $strAt = $strArr[1];
        //Разделим параметры валидации и запишем их в массив
        $strArrAt = explode(" ", $strAt);
        
        //Далее идут проверки на тип валидации
        //С помощью trim уберем не нужные символы и пробелы типа валидации
        if($strArrAt[1] == "S"){
            //Проверка на количество символов в строке
            if(strlen($strArr[0])>=$strArrAt[2] && strlen($strArr[0])<=$strArrAt[3]){
                $res .= "OK\n";
            }else{
                $res .= "FAIL\n";
            }
        }else if(trim($strArrAt[1]) == "N"){
            if(preg_match('/^-[0-9]*[1-9][0-9]*$/', $strArr[0]) || preg_match('/^[0-9]*[1-9][0-9]*$/', $strArr[0]) || $strArr[0] == '0'){
                if (intval($strArr[0])<=$strArrAt[3] && intval($strArr[0])>=intval($strArrAt[2])){
                    $res .= "OK\n";
                }else{
                    $res .= "FAIL\n";
                }
            }else{
                $res .= "FAIL\n";
            }
        }else if(trim($strArrAt[1]) == "P"){
            //Проверка на маску номера телефона
            if (strlen($strArr[0]) == 18 && preg_match("/\+7 \([0-9]{3}\) ([0-9]{3})-([0-9]{2})-([0-9]{2})/", $strArr[0])) {
                $res .= "OK\n";
            } else {
                $res .= "FAIL\n";
            }
        }else if(trim($strArrAt[1]) == "D"){
            //Разбиваем строку на дату и время
            $dateAndTime = explode(" ", $strArr[0]);
            //Создаем переменную с датой
            $date = $dateAndTime[0];

            // Значение d-m-y в отдельные переменные
            $day = explode(".", $date)[0];
            $month = explode(".", $date)[1];
            $year = explode(".", $date)[2];
            // Проверяем существование даты
            $isDateValid = checkdate($month, $day, $year);
            //Создаем переменную с временем
            $time = $dateAndTime[1];
            //Разбиваем её на часы и минуты
            $hours = explode(":", $time)[0];
            $minutes = explode(":", $time)[1];
            // Если все верно
            if ($isDateValid && strlen($year) == 4 && $hours < 24 && $minutes < 60) {
                $res .= "OK\n";
            } else {
                $res .= "FAIL\n";
            }
        }else if(trim($strArrAt[1]) == "E"){
            //Проверка на почту
            if(preg_match("/([0]{0})([A-Za-z0-9]{1})([A-Za-z0-9_]{3,29})@([A-Za-z]{2,30})[.]([a-z]{2,10})/", $strArr[0]) && $strArr[0][0]!="_"){
                $res .= "OK\n";
            }else{
                $res .= "FAIL\n";
            }
        }
    }
    return $res;
}

$input_file = glob('C/*.dat');
$output_file = glob('C/*.ans');
$n_tests = 14;
$c = 1;
for($k = 0; $k < $n_tests; $k++){
    echo "Результат теста $c: ";
    $c++;
    if (C($input_file[$k]) == file_get_contents($output_file[$k], 'r')){
        echo "Все супер!\n";
    }
    else{
        echo "ERROR!!!\n";
    }
}

?>