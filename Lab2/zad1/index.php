<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>LR2</title>
        <link rel="stylesheet" href="index.css" type="text/css" />
    </head>
    <body>
        <form method="get" action="zad1.php">
            <fieldset>
                <legend class="titl">Введите строку с целыми числами. Будут найдены числа,
                    стоящие в кавычках и увеличены в два раза.
                    Пример: из строки 2aaa'3'bbb'4' будет получена строку 2aaa'6'bbb'8'.
                </legend>
                <div class="str">
                    <label for="str">Строка</label>
                    <input class="instr" type="text" name="text">
                </div>
                <input class="inbut" type="submit" value="Отправить">
            </fieldset>
        </form>
        
    </body>
</html>