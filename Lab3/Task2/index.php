<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Отправка письма на почту</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"  type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#btn_submit').click(function(){
                // собираем данные с формы
                var user_name    = $('#user_name').val();
                var user_email   = $('#user_email').val();
                var user_phon   = $('#user_phon').val();
                var text_comment = $('#text_comment').val();
                var re_em = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
                var re_nu = /^[\d\+][\d\(\)\ -]{10,14}\d$/;
                if(user_name == ""){
                    document.getElementById('user_name').style.borderColor = "red";
                }else{
                    document.getElementById('user_name').style.borderColor = "green";
                }
                
                if(user_email == "" || !re_em.test(user_email)){
                    document.getElementById('user_email').style.borderColor = "red";
                }else{
                    document.getElementById('user_email').style.borderColor = "green";
                }

                if(user_phon == "" || !re_nu.test(user_phon)){
                    document.getElementById('user_phon').style.borderColor = "red";
                }else{
                    document.getElementById('user_phon').style.borderColor = "green";
                }

                if(text_comment == ""){
                    document.getElementById('text_comment').style.borderColor = "red";
                }else{
                    document.getElementById('text_comment').style.borderColor = "green";
                }
                // отправляем данные
                $.ajax({
                    url: "action.php", // куда отправляем
                    type: "post", // метод передачи
                    dataType: "json", // тип передачи данных
                    data: { // что отправляем
                        "user_name":    user_name,
                        "user_email":   user_email,
                        "user_phon":   user_phon,
                        "text_comment": text_comment
                    },
                    // после получения ответа сервера
                    success: function(data){
                        $('.messages').html(data.result); // выводим ответ сервера
                    }
                });
            });
        });
    </script>
</head>
<body>
    <br/>
    <div class="messages"></div>
    <br/>
    <div class="text-field">
      <label class="text-field__label" for="user_name">Ваше ФИО:</label>
      <p id="er_name" style='color: red'></p>
      <input class="text-field__input" type="text" placeholder="ФИО" id="user_name">
    </div>

    <div class="text-field">
      <label class="text-field__label" for="user_email">Ваш e-mail:</label>
      <p id="er_email" style='color: red'></p>
      <input class="text-field__input" type="text" placeholder="exanple@mail.ru" id="user_email">
    </div>

    <div class="text-field">
      <label class="text-field__label" for="user_phon">Ваш номер телефона:</label>
      <p id="er_phon" style='color: red'></p>
      <input class="text-field__input" type="text" placeholder="7908021205" id="user_phon">
    </div>

    <div class="text-field">
      <label class="text-field__label" for="text_comment">Текст сообщения:</label>
      <p id="er_text" style='color: red'></p>
      <textarea class="text-field__input next" type="text" placeholder="Комментарий" id="text_comment"></textarea>
    </div>

    <button class="butt" id="btn_submit" >Отправить</button>     
</body>
</html>