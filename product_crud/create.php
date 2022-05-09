<?php

$pdo  = new PDO('mysql:localhost=localhost;port=3306;dbname=product_list', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');


    if (!$title) {
        $errors[] = "Product title is required";
    }
    if (!$price) {
        $errors[] = "Product price is required";
    }


    $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, creatre_date)
   VALUES (:title, :image, :$description, :price,:date)");
    $statement->bindValue(':title', $title);
    $statement->bindValue(':image', '');
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':date', $date);
    $statement->execute();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet">
    <title>Products</title>
</head>

<body>
    <h1>Create New Product</h1>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
    <form action="create.php" method="post">
        <div class="mb-3">
            <label>Product Image</label>
            <br>
            <input type="file" name="image">

        </div>
        <div class="mb-3">
            <label>Product Title</label>
            <input type="text" class="form-control" name="title">

        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>

        </div>
        <div class="mb-3">
            <label>Product Price</label>
            <input type="number" step="0.01" class="form-control" name="price">

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>


    </form>
</body>

</html>