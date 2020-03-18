<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "java_project";
$connection = mysqli_connect($host, $user , $password, $database);

$primalStr = "{Пожалуйста,|Просто|Если сможете,} сделайте так, чтобы это {удивительное|очень{крутое|веселое|забавное}|простое|важное|бесполезное} тестовое предложение {изменялось {быстро|мгновенно|оперативно|правильно} случайным образом|менялось каждый раз}.";
echo $primalStr."<br>"."<br>"."<br>"."<br>";

function callBack($matches) {
    $str = substr($matches[0], 1, strlen($matches[0]) - 2);
    $str = preg_replace_callback('~{(?>[^{}]+|(?0))*}~', 'callBack', $str);
    $options = explode('|', $str);
    return $options[mt_rand(0, count($options) - 1)];
}

$resStr = preg_replace_callback('~{(?>[^{}]+|(?0))*}~', 'callBack', $primalStr);
$checkDB = $conection->query("SELECT * FROM `str` WHERE `str` =  '$resStr'  ");
if (count($checkDB->fetch_assoc())>0 ){
    echo "Запись \"$resStr\" уже существует";
}else{
    echo "Запись \"$resStr\" добавлена в БД";
    $res = $conection->query("INSERT INTO `str` (`id`, `str`) VALUES (NULL, '$resStr')");
};
