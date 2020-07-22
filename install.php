<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>install</title>
    <script src="//api.bitrix24.com/api/v1/dev/"></script>
</head>
<body>
<body>
    <?require_once (__DIR__.'/src/crest.php');
?>

    
    <script>
        BX24.callMethod(
       'userfieldtype.add', 
       {
          USER_TYPE_ID: 'weather',
          HANDLER: 'https://www.test.o-jo.ru/weather/index.php',
          TITLE: 'weather title',
          DESCRIPTION: 'weather description'
       }
    );

        BX24.init(function(){

                    BX24.installFinish();

                });

    </script>
  
</body>
</html>