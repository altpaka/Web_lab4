<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>menu</title>
</head>

<?php
$xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");
?>

<body>
    <a href="list.php">Перейти на начальную страницу (list.php)</a>
    <a href="create.php">Создать продукт (create.php)</a>
    <a href="update.php">Изменить продукт (update.php)</a>
    <a href="delete.php">Удалить продукт (delete.php)</a>
    <div class="container">

        <?php
            foreach ($xml->item as $item) {
        ?>
            <div class="single-product-container">
                <div class="product-photo-container">
                    <img src="<?= $item->img ?>" alt="product.png" />
                </div>
                <h1><?= $item->name ?></h1>
                <p><?= $item->discription ?></p><br>
                <a href="update.php?id=<?= $item['id']?>" styles="bottom:0px">Изменить продукт</a><br>
                <a href="delete.php?id=<?= $item['id']?>">Удалить продукт</a>
                
            </div>
        <?php
            }
        ?>
    </div>

</body>
</html>
