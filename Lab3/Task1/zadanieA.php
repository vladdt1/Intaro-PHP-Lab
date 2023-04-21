<?php  
// функция для чтения и обработки данных из файла
function A($a){    
    $fd = fopen($a, 'r') or die("не удалось открыть файл");  
         
    $num = fgets($fd);  
    $res = '';  
 
    $flightTimes = array();  
 
    for ($i = 0; $i < $num; $i++) {  
        $input = explode(' ', fgets($fd));  
        $departTimezone = new DateTimeZone('Europe/Moscow');  
        $departTime = DateTime::createFromFormat('d.m.YH:i:s', $input[0], $departTimezone);  
        $arriveTimezone = new DateTimeZone('Europe/Moscow'); 
        $arriveTime = DateTime::createFromFormat('d.m.YH:i:s', $input[2], $arriveTimezone);  
         
        $flightTime = $arriveTime->getTimestamp() - $departTime->getTimestamp();  
        array_push($flightTimes, $flightTime);  
    }   
    foreach ($flightTimes as $flightTime) {  
        $res .= $flightTime . "\n";  
    }  
    echo $res; // выводим результат
} 

$input_file = glob('A/.dat'); // получаем список входных файлов
$output_file = glob('A/.ans'); // получаем список выходных файлов
$ntests = 4; 
$c = 1; 
for($k = 0; $k < $ntests; $k++){ 
    echo "Результат теста $c: "; 
    $c++; 
    if (A($input_file[$k]) == file_get_contents($output_file[$k], 'r')){ // сравниваем результат функции с ожидаемым результатом
        //echo "Все супер!\n"; 
    } 
    else{ 
        //echo "ERROR!!!\n"; 
    } 
} 
?>