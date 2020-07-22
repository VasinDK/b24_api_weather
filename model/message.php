<?

/**
* $citiIndex - индекс города из списка городов 
* $cityName - название города
* $_POST['citySelect'] - выбранный пользователем город
* $dataTemp - температура
* $dataFeelsLike - ощущаемая температура
* $message - сообщение для пользователя
*/

// подключаем формирование api
include ('api/weater_curl.php');

$cityName = '';

// получаем имя города
if($_POST['citySelect']){
    $cityName = $city[$citiIndex]['name'];
}

// получаем температуру и ощущаемую температуру
$dataTemp = $data['temp'];

$message = '';

// формируем сообщеие для вывода
if($dataTemp){
    $message = $cityName . ': '. $dataTemp . '&deg;' . ' C';
}

