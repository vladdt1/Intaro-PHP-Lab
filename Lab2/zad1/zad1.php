<div style="background-color: antiquewhite; margin-left:30%;margin-right: 30%; margin-top:5%">
<?php
//Разобьем строку в массив по каждому элементу
$arr = str_split($_GET['text']);
//Циклом прогоняем каждый элемент, прыгаем только по четным элементам массива
for($i=0;$i<count($arr);$i++){
    if($i+2<count($arr) and $i+3<count($arr)){
        if($arr[$i]=="'" and $arr[$i+2]=="'"){
        //Если мы натыкаемся на число в ковычках, то умножаем его на 2 и перезаписываем в массив
            $arr[$i+1] = intval($arr[$i+1]) * 2;
            $i+=2;
        }else if($arr[$i]=="'" and $arr[$i+3]=="'"){
            $num = $arr[$i+1].$arr[$i+2];
            $arr[$i+1] = intval($num) * 2;
            $arr[$i+2]="";
            $i+=3;
        }
    }
}
//Создаем строку с результатом
$arr=implode($arr);
//Заполним результирующую строку новыми данными из массива
// foreach($arr as $row){
//     $res .= $row . "'";
// }
//Удаление последней ковычки, если последний элемент массива был равен пустой
//if($arr[count($arr)-1]){
//    $res = substr($res,0,-1);
//}
//Удаление последней, не нужной ковычки
//$res = substr($res,0,-1);

echo 'Введенная строка: ' . $_GET['text'] . '<br>' . 'Строка с результатом: ' . $arr;
?>
</div>
<a href="index.php" style="color:white">
    <button 
    style="background-color: black; 
    margin-left:30%;
    margin-right: 30%;
    margin-top:5%; 
    width:400px;
    height:50px;
    color:white">
    Вернуться обратно
    </button>
</a>
