<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>

<body>
    <a href="list.php">list.php</a> 
    <a href="index.php">index.php</a>
    <?php
    $id = 0;
    $name = '';
    $discription = '';

    $xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $id = $_GET['id'];

        foreach ($xml->item as $item) {
            if ($item['id'] == $id) {
                $name = $item->name;
                $discription = $item->discription;
                $img = $item->img;
                break;
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        foreach ($xml->item as $item) {
            if ($item['id'] == $id) {
                $item->name = $_POST['name'];
                $item->discription = $_POST['discription'];
                
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

                break;
            }
        }
        $xml->saveXML('data.xml');
    }
    ?>

    <form method="POST" action="update.php?id=<?= $id ?>" enctype="multipart/form-data">
        Изменить название продукта: <input style="display: inline-block" type="text" name="name" value="<?= $name ?>" /><br />
        Описание продукта: <textarea name="discription" rows="5" cols="40" value="<?= $discription ?>"></textarea><br />
        Картинка: <input type="file" name="img" id="img" required /><br />
        <input type="hidden" value="<?= $id ?>" name="id"/>
        <input type="submit" value="Сохранить" />
    </form>
</body>

</html>