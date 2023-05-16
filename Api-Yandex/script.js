function findNearestMetro() {   
    // Получаем значение, введенное пользователем в поле адреса и удаляем пробелы по краям
    const address = document.getElementById('address').value.trim();  
    
    // Если поле адреса пустое, выводим сообщение об ошибке и завершаем функцию
    if (!address) { 
        alert('Введите адрес'); 
        return; 
    } 
  
    // Получаем элемент для вывода результата запроса    
    const result = document.getElementById('result');  
      
    // Выводим на экран сообщение о том, что поиск по адресу выполняется
    result.innerHTML = '<span>Идет поиск...</span>';  
    
    // Создаем GET-запрос на сервер с параметром адреса и кодируем его
    const url = 'https://example.com/find-nearest-metro?address=' + encodeURIComponent(address);
    
    // Делаем HTTP-запрос на сервер с использованием `fetch()`
    fetch(url)
        .then(response => {
            // Если запрос завершается успешно (код 200) и получен ответ
            if (response.ok) {
                return response.text();
            } else {
                // Если запрос завершился неудачно, выбрасываем ошибку
                throw new Error(response.statusText);
            }
        })
        .then(data => {
            // Выводим ответ на страницу
            result.innerHTML = data;
        })
        .catch(error => {
            // Выводим сообщение об ошибке на страницу
            console.error(error);
            result.innerHTML = '<span>Ошибка</span>';
        })
}
