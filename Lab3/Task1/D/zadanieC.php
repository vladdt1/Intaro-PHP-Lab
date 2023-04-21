<?php
// Вторая строка считывает содержимое файла input.html и сохраняет его в переменной $html.
$html = file_get_contents('001.html');

// Третья строка удаляет HTML-комментарии, которые не начинаются со строки 'skip-delete'.
$html = preg_replace('/<!--(?!skip-delete)(.|\n)*?-->/', '', $html);

// Четвертая строка сжимает пробелы между тегами.
$html = preg_replace('/>\s+</', '><', $html);

// Пятая строка удаляет пробелы вне тегов.
$html = preg_replace('/\s+(?=<)|(?<=>)\s+/', '', $html);

// Шестая строка ищет все теги <script>, которые не имеют атрибута data-skip-moving со значением true, 
//и сохраняет их содержимое в массив $scripts.

preg_match_all('/<script(?![^>]*data-skip-moving="true")[^>]*>(.*?)<\/script>/si', $html, $scripts);

// Седьмая строка удаляет найденные скрипты из оригинального HTML-кода и добавляет их в конец.
$html = preg_replace('/<script(?![^>]*data-skip-moving="true")[^>]*>(.*?)<\/script>/si', '', $html);
$html .= implode('', $scripts[0]);

// Восьмая строка записывает измененный HTML-код в файл output.html.
file_put_contents('output.html', $html);
?>