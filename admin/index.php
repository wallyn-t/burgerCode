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
            <h1><strong>Liste des items   </strong><a href="insert.php" class="btn btn-success btn-lg"><i class="bi bi-plus"></i> Ajouter</a></h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require 'database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category
                                                FROM items
                                                LEFT JOIN categories ON items.category = categories.id
                                                ORDER BY items.id DESC');
                        
                        while($item = $statement->fetch()){
                            echo '<tr>';
                            echo    '<td>' . $item['name'] . '</td>';
                            echo    '<td>' . $item['description'] . '</td>';
                            echo    '<td>' . number_format((float)$item['price'], 2, '.', '') . '</td>';
                            echo    '<td>' . $item['category'] . '</td>';
                            echo    '<td width=340>';
                            echo        '<a class="btn btn-secondary" href="view.php?id=' . $item['id'] . '"><i class="bi bi-eye"></i> Voir</a>';
                            echo ' ';
                            echo        '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><i class="bi bi-pencil"></i> Modifier</a>';
                            echo ' ';
                            echo        '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><i class="bi bi-x"></i> Supprimer</a>';
                            echo ' ';
                            echo    '</td>';
                            echo '</tr>';
                        }
                        Database::disconnect();
                    ?>
                </tbody>    
            </table>
        </div>
    </div>

</body>
</html>