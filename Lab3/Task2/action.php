<?php
    $msg_box = ""; // в этой переменной будем хранить сообщения формы
    $errors = array(); // контейнер для ошибок
    // проверяем корректность полей
    if($_POST['user_name'] == "")    $errors[] = "Поле 'Ваше ФИО' не заполнено!";
    if(($_POST['user_email'] == "") || (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL) == false)){
        $errors[] = "Поле 'Ваш e-mail' заполненно не корректно!";
    }
    if(($_POST['user_phon'] == "") || strlen($_POST['user_phon'])<11){
        $errors[] = "Поле 'Ваш номер телефона' заполненно не корректно!";
    }
    if($_POST['text_comment'] == "") $errors[] = "Поле 'Текст сообщения' не заполнено!";
 
    // если форма без ошибок
    if(empty($errors)){     
        // собираем данные из формы
        
        $message  = "ФИО пользователя: " . $_POST['user_name'] . "<br/>";
        $message .= "E-mail пользователя: " . $_POST['user_email'] . "<br/>";
        $message .= "Телефон пользователя: " . $_POST['user_phon'] . "<br/>";
        $message .= "Текст письма: " . $_POST['text_comment'];      
        send_mail($message); // отправим письмо
        // выведем сообщение об успехе
        $time = time() + 5400;
        $msg_box = "<span style='color: green;'>Сообщение успешно отправлено!<br>С Вами свяжутся после ". date('H:m:s d:m:Y', $time) . "</span>";
    }else{
        // если были ошибки, то выводим их
        $msg_box = "";
        foreach($errors as $one_error){
            $msg_box .= "<span style='color: red;'>$one_error</span><br/>";
        }
    }
 
    // делаем ответ на клиентскую часть в формате JSON
    echo json_encode(array(
        'result' => $msg_box
    ));
     
     
    // функция отправки письма
    function send_mail($message){
        // почта, на которую придет письмо
        $mail_to = "vladtitov2018@mail.ru"; 
        // тема письма
        $subject = "Письмо с обратной связи";
         
        // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Тестовое письмо <no-reply@test.com>\r\n"; // от кого письмо
         
        // отправляем письмо 
        mail($mail_to, $subject, $message, $headers);
    }
     
?>