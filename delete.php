<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="list.php">list.php</a> 
    <a href="index.php">index.php</a><br>
    <p>Удалить выбранный продукт</p><br>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");
        $id = $_GET['id'];
        $i = 0;
        foreach ($xml->item as $item) {

            if ($item['id'] == $id) {
                unset($xml->item[$i]);
                
                break;
            }
            $i++;
        }
        $xml->saveXML('data.xml');
        header('location:index.php');
    }
    ?>
</body>
</html>