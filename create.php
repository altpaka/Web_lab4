<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title>Create product</title>
</head>

<body>
    <a href="list.php">list.php</a> 
    <a href="index.php">index.php</a></br>
    <p>Создать новый продукт</p>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $discription = $_POST['discription'];

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

        $xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");
        
        $task = $xml->addChild('item', '');
        $task->addChild('img', $target_file);
        $task->addChild('name', $name);
        $task->addChild('discription', $discription);
        $max = 0;
        foreach($xml->item as $item) {
            if ($item['id']) {
                $max = $item['id'];
            }
        }
        $task->addAttribute('id', $max + 1);

        $xml->saveXML('data.xml');
        
    }
    ?>
    <form method="POST" action="create.php" enctype="multipart/form-data">
        Название продукта: <input type="text" name="name" required /><br />
        Описание продукта: <textarea name="discription" rows="5" cols="40" required></textarea><br />
        Картинка: <input type="file" name="img" id="img" required /><br />
        <input type="submit" value="Сохранить" />
    </form>
</body>

</html>