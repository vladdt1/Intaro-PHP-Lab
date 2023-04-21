<?php

// Читаем файлы
$sections = simplexml_load_file('sections.xml');
$products = simplexml_load_file('products.xml');

// Создаем новый XML-документ
$output = new SimpleXMLElement('<ЭлементыКаталога></ЭлементыКаталога>');
$categories = $output->addChild('Разделы');

// Проходимся по всем разделам и создаем соответствующие элементы в выходном файле
foreach ($sections->Раздел as $section) {
    $category = $categories->addChild('Раздел');
    $category->addChild('Ид', (string)$section->Ид);
    $category->addChild('Наименование', (string)$section->Наименование);

    // Добавляем товары, принадлежащие данному разделу
    $products_in_category = $products->xpath("//Товар[Разделы/ИдРаздела='" . (string)$section->Ид . "']");
    if (!empty($products_in_category)) {
        $products_list = $category->addChild('Товары');
        foreach ($products_in_category as $product) {
            $product_node = $products_list->addChild('Товар');
            $product_node->addChild('Ид', (string)$product->Ид);
            $product_node->addChild('Наименование', (string)$product->Наименование);
            $product_node->addChild('Артикул', (string)$product->Артикул);
        }
    }
}

// Сохраняем выходной файл
$output->asXML('output.xml');

?>