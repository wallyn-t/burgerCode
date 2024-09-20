<?php
    require 'database.php';

    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);        
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                                FROM items
                                LEFT JOIN categories ON items.category = categories.id
                                WHERE items.id = ?');
    $statement->execute(array($id));
    $item = $statement->fetch();
    Database::disconnect();

    function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Code</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1 class="text-logo"><i class="bi bi-egg-fried"></i> Burger Code <i class="bi bi-egg-fried"></i> </h1>
    <div class="container admin">
        <div class="row">
            <div class="col-md-6">
                <h1><strong>Voir un item</strong></h1>
                <br>
                <form action="">
                    <div class="form-group">
                        <label>Nom:</label><?php echo ' ' . $item['name']; ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Description:</label><?php echo ' ' . $item['description']; ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Prix:</label><?php echo ' ' . number_format((float)$item['price'], 2, '.', '') . ' €'; ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Catégorie:</label><?php echo ' ' . $item['category']; ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Image:</label><?php echo ' ' . $item['image']; ?>
                    </div>
                </form>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php"><i class="bi bi-arrow-left"></i> Retour</a>
                </div>
            </div>

            <div class="col-md-6 site">
                <div class="img-thumbnail">
                    <img src="<?php echo '../images/' . $item['image']; ?>" class="img-fluid" alt="menu 1">
                    <div class="price"><?php echo number_format((float)$item['price'], 2, '.', '') . ' €'; ?></div>
                    <div class="caption">
                        <h4><?php echo $item['name']; ?></h4>
                        <p><?php echo $item['description']; ?></p>
                        <a href="#" class="btn btn-order" role="button"><i class="bi bi-cart4"></i> Commander</a>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

</body>
</html>