<?php
function D($a){
  //Объявляем переменные $filename и $output, которые будут использоваться в дальнейшем
  $filename = $a;
  $output = '';

  // Проверяем, существует ли файл $filename, и если да, то читаем его содержимое в переменную $css
  if (file_exists($filename)) {
    $css = file_get_contents($filename);

    // Удаляем комментарии из CSS-кода с помощью регулярного выражения
    $css = preg_replace('!/\*.*?\*/!s', '', $css);

    // Удаляем пустые стили
    $css = preg_replace('/[^{}]+\{\s*\}/', '', $css);

    // Удаляем лишние пробелы, переносы строк и точки с запятыми
    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '      '), '', $css);
    $css = str_replace(';}', '}', $css);

    // Удаляем единицы измерения после 0
    $css = preg_replace('/(?<=\s)0(px|em|ex|pt|pc|cm|mm|in|%)/i', '0', $css);

    // Сокращаем шестнадцатеричные цвета до трех символов
    $css = preg_replace_callback('/#([0-9a-fA-F])\1([0-9a-fA-F])\2([0-9a-fA-F])\3\b/i', function ($matches) {
      return '#' . $matches[1] . $matches[2] . $matches[3];
    }, $css);

    // Заменяем именованные цвета на их эквиваленты
    $css = str_ireplace(array(
      '#CD853F',
      '#FFC0CB',
      '#DDA0DD',
      '#F00',
      '#FFFAFA',
      '#D2B48C'
    ), array(
      'peru',
      'pink',
      'plum',
      'red',
      'snow',
      'tan'
    ), $css);

    // Сокращаем свойства margin-top, margin-right, margin-bottom, margin-left до одного свойства margin: top right bottom left. Аналогично для свойства padding
    $css = preg_replace('/margin-(top|right|bottom|left)\s*:\s*((\d+px\s*){1,4});/i', 'margin:$2;', $css);
    $css = preg_replace('/padding-(top|right|bottom|left)\s*:\s*((\d+px\s*){1,4});/i', 'padding:$2;', $css); 
    // Удаляем повторяющиеся точки с запятыми
    $css = implode(';',array_unique(explode(';', $css)));

    // Сохраняем минифицированный CSS-код в переменную $output
    $output = $css;
  }
  // Удаляем все пробелы из $output
  $output = str_replace(' ', '', $output);
  // Выводим минифицированный CSS-код на экран
  return $output;
}

$input_file = glob('D/*.dat'); // получаем список входных файлов
$output_file = glob('D/*.ans'); // получаем список выходных файлов
$ntests = 11; 
$c = 1; 
for($k = 0; $k < $ntests; $k++){ 
    echo "Результат теста $c: "; 
    $c++; 
    if (D($input_file[$k]) == file_get_contents($output_file[$k], 'r')){ // сравниваем результат функции с ожидаемым результатом
        echo "Все супер!\n"; 
    } 
    else{ 
        echo "ERROR!!!\n"; 
    } 
} 
?>
