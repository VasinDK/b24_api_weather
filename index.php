<?
/**
* $_SESSION['itemId'] - id сделки
* $placementOptions['ENTITY_VALUE_ID'] - id сделки
* $message - сообщение о погоде 
* $_REQUEST['submitAndComment'] - кнопка "записать"
* $_REQUEST['fieldWeather'] - поле в форме с сообщением о погоде
* 
*/

/* подключаем список городов */
include('model/city.php');

/* подключаем формирование сообщения о погоде */
include('model/message.php');

/* записываем в сессию id сделки */
session_start();
$placementOptions = json_decode($_REQUEST['PLACEMENT_OPTIONS'], true);

if($placementOptions['ENTITY_VALUE_ID']){
    $_SESSION['itemId'] = $placementOptions['ENTITY_VALUE_ID'];
}

/* записываем в сессию сообщение о погоде */
if($message){
    $_SESSION['message'] = $message;
}

?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="//api.bitrix24.com/api/v1/dev/"></script>
        <title>Погода в городе</title>
</head>
<body>

    <!-- Блок записи сообщения о погоде в комментарии -->
    <!-- 
        Запись происходит если срабатывает одно из двух условий:
        1. Нажата кнопка "записать" и имеется новое сообщение о погоде (т.е. был запрос)
        2. Нажата кнопка "записать" и в поле сообщения уже имеется старое сообщение о погоде (т.е. запрос был на предыдущем этапе)
      -->
    <? if(($_REQUEST['submitAndComment'] && $message) || ($_REQUEST['submitAndComment'] && $_REQUEST['fieldWeather'])):?>

            <!-- скрипт записи в комментарии -->
            <script>
                BX24.callMethod(
                   "crm.timeline.comment.add",
                   {
                       fields:
                       {
                           "ENTITY_ID": <?= $_SESSION['itemId']; ?>,
                           "ENTITY_TYPE": "deal",
                           "COMMENT": <?= '"' . $_SESSION['message'] . '"'; ?>
                       }
                   },
                   
                );
            </script>
    <?endif; ?>
                
                
    <div class="wrapper">   
        <h3 class="title">Погода</h3>
        
        <form action="index.php" method="post">
            
            <!-- пользователь выберает город -->
            <label for="citySelect">Город: 
                <select name="citySelect"><br><br>
                    <option value="">не выбран</option>

                        <!-- выводим список городов для выбора -->
                        <? foreach ($city as $key => $value){
                            echo '<option value="' . $key . '">' . $value['name'] . '</option>';
                        } ?>
                </select>
            </label>

            <!-- выводим сообщение о погоде в выбранном городе -->
            <br><br>
            <input type="text" class="" name="fieldWeather" value="<?= $message; ?>"  placeholder="Выберите город">
            <br><br>
            
            <!-- Две кнопки. Одна просто показывает погоду. Другая показывает и сразу записывает, причем если уже было выведено сообщение о погоде, записывает последнее сообщение -->
            <input type="submit" name="submit" value="Узнать">  
            <input type="submit" name="submitAndComment" value="Узнать и записать ">
        </form>

    </div>

</body>
</html>




	

	