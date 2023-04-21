<?php 
function C($a){ 
    $res = '';
    // читаем входные данные
    $input = file_get_contents('input.txt'); 
    $lines = explode("\n", trim($input)); 
    $n = count($lines); 
    
    // вычисляем общий вес и начальные частоты
    $weight_sum = 0; 
    $frequencies = array(); 
    foreach ($lines as $line) { 
        list($id, $weight) = explode(" ", $line); 
        $weight_sum += $weight; 
        $frequencies[$id] = $weight; 
    } 
    
    // вычисляем частоты
    $freq_sum = 0; 
    $frequencies_cumulative = array(); 
    foreach ($frequencies as $id => $weight) { 
        $freq = $weight / $weight_sum; 
        $freq_sum += $freq; 
        $frequencies_cumulative[$id] = $freq_sum; 
    } 
    
    // случайный выбор баннеров
    $banner_counts = array(); 
    for ($i = 0; $i < 106; $i++) { 
        $random = mt_rand() / mt_getrandmax(); 
        foreach ($frequencies_cumulative as $id => $freq_cum) { 
            if ($random <= $freq_cum) { 
                if (!isset($banner_counts[$id])) { 
                    $banner_counts[$id] = 0; 
                } 
                $banner_counts[$id]++; 
                break; 
            } 
        } 
    } 
    
    // вывод результатов
    foreach ($banner_counts as $id => $count) { 
        $freq = $count / 106; 
        $output = $id . " " . number_format($freq, 6); 
        $res .= $output . "\n"; 
    }
}

$input_file = glob('C/*.dat'); // получаем список входных файлов
$output_file = glob('C/*.ans'); // получаем список выходных файлов
$ntests = 6; 
$c = 1; 
for($k = 0; $k < $ntests; $k++){ 
    echo "Результат теста $c: "; 
    $c++; 
    if (C($input_file[$k]) == file_get_contents($output_file[$k], 'r')){ // сравниваем результат функции с ожидаемым результатом
        echo "Все супер!\n"; 
    } 
    else{ 
        echo "ERROR!!!\n"; 
    } 
} 