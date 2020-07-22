<?

/**
* $_POST['citySelect'] - выбранный пользователем город
* $url - первая часть url api яндекса
* $citiIndex - индекс города из списка городов
* lat - широта запрашиваемого города
* lon - долгота запрашиваемого города
* lang - сочетания языка и страны, для которых будут возвращены данные  
* limit - количество дней в прогнозе, включая текущий.
* hours - содержание прогноза погоды по часам
* extra - расширенная информация об осадках
* $header - отправляемые заголовоки 
* X-Yandex-API-Key - ключ api
* $ch - переменная инициализации cUrl
* $response - возвращаемое значение api
* $data - преобразованное в массив возвращаемое значение api
*/

if($_POST['citySelect']){

    $url = 'https://api.weather.yandex.ru/v2/fact';

    $citiIndex = $_POST['citySelect'];

    // формируем передоваемые api данные
    $options = [
        'lat'=> $city[$citiIndex]['lat'],
        'lon'=> $city[$citiIndex]['lon'],
        'lang'=> 'en_US',
        'limit'=> '1',
        'hours'=> 'false',
        'extra'=> 'false',
    ];

    // формируем заголовки
    $header = [
        'X-Yandex-API-Key: 6dba3bed-fca7-4ce9-bbbf-eb5c8c492e0c',
        'Content-Type: application/json'
    ];

    // запрос api
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($options));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($ch);

    curl_close($ch); 

    // преобразуем данные ответа в массив
    $data = json_decode($response, true);
}