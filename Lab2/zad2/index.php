<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>LR2</title>
        <link rel="stylesheet" href="index.css" type="text/css" />
    </head>
    <body>
        <form method="get">
            <fieldset>
                <legend class="titl">Введите ссылку вида:<br>http://asozd.duma.gov.ru/main.nsf/(Spravka)?OpenAgent&RN=<номер законопроекта>&<целое число></legend>
                <div class="str">
                    <label for="str">Ссылка</label>
                    <input class="instr" type="text" name="text" value="">
                </div>
                <input class="inbut" type="submit" value="Сгенерировать">
            </fieldset>
        </form>

        <?php
        //Разбиваем строку на 2 элемента, один хранит в себе ссылку, другой номер законопроекта и целое число
        $arr = explode("=", $_GET['text']);
        //Проверяем формат ссылки, если он верный то разбиваем номер законопроекта и целое число на 2 элемента в новый массив
        if (preg_match('/http:\/\/asozd\.duma\.gov\.ru\/main\.nsf\/\(Spravka\)\?OpenAgent&RN+/', $arr[0])) {
            $arrNum = explode("&", $arr[1]);
            //Записываем результирующую строчку
            $res = 'http://sozd.parlament.gov.ru/bill/' . $arrNum[0];
<<<<<<< HEAD
        } else {
            //В случае ошибки
            $res = 'Не верный формат ссылки!';
        }
        echo 'Ваша ссылка: ' . $_GET['text'] . '<br>' . 'Новая ссылка: ' . $res;
=======
            echo 'Ваша ссылка: ' . $_GET['text'] . '<br>' . 'Новая ссылка: ' . $res;
        } else {
            //В случае ошибки
            echo 'Не верный формат ссылки!';
        }
        
>>>>>>> 905c17a (L3)
        ?>
    </body>
</html>