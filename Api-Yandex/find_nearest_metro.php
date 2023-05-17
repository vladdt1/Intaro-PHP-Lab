<?php  
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['address']))  {  
    // Проверяем, был ли отправлен HTTP POST запрос и присутствует ли переменная "address" в массиве POST 
    $address = htmlspecialchars($_POST['address']);  
    // Получаем значение переменной "address" из массива POST и экранируем специальные символы
    $parameters = array( 
      'apikey' => '59e1f998-8d62-4ab3-8cde-df2b8af2df52', 
      'geocode' => $address, 
      'format' => 'json' 
    ); 
    // Формируем массив параметров для запроса к API-сервису Яндекс.Карт
 
    $response = file_get_contents('https://geocode-maps.yandex.ru/1.x/?'. http_build_query($parameters)); 
    // Отправляем запрос к API-сервису и получаем ответ
 
    $obj = json_decode($response, true); 
    // Декодируем полученный JSON-ответ в массив
 
    $cord = str_replace(" ", ",", $obj['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']); 
    // Получаем координаты места, на которое указывает адрес
    $parameters = array( 
      'apikey' => '59e1f998-8d62-4ab3-8cde-df2b8af2df52', 
      'geocode' => $cord, 
      'kind' => 'metro', 
      'format' => 'json' 
    ); 
    // Формируем массив параметров для запроса к API-сервису Яндекс.Карт
 
    $response = file_get_contents('https://geocode-maps.yandex.ru/1.x/?'. http_build_query($parameters)); 
    // Отправляем запрос к API-сервису и получаем ответ
 
    $obj = json_decode($response, true); 
    // Декодируем полученный JSON-ответ в массив
 
    $metro = $obj['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['name']; 
    $metro_cord = str_replace(" ", ",", $obj['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']); 
    // Получаем название ближайшей станции метро из ответа 
    echo "( Структурированный адрес: " . $address . " )"; 
    echo "( Ближайшее метро: " . $metro . " )\n "; 
    echo "( Координаты: " . $metro_cord . " )";
    // Выводим результат в браузере
}  
?>
