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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container site">
        <h1 class="text-logo">
            <i class="bi bi-egg-fried"></i> Burger Code <i class="bi bi-egg-fried"></i> 
        </h1>
        
        <?php 
            require 'admin/database.php';
            echo '<nav>
                    <ul class="nav nav-pills" role="tablist">';

            $db = Database::connect();
            $statement = $db->query('SELECT * FROM categories');
            $categories = $statement->fetchAll();
            foreach($categories as $category) {
                if($category['id'] == '1') {
                    echo   '<li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab'. $category['id'] . '" role="tab">'  . $category['name'] . '</a></li>';
                } else {
                    echo   '<li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab'. $category['id'] . '" role="tab">'  . $category['name'] . '</a></li>';
                }
            }
            
            echo '  </ul>
                </nav>';
            
            echo '<div class="tab-content">';

            foreach($categories as $category) {
                if($category['id'] == '1') {
                    echo   '<div class="tab-pane active" id="tab' . $category['id'] .'" role="tabpanel">';
                } else {
                    echo   '<div class="tab-pane" id="tab' . $category['id'] .'" role="tabpanel">';
                }
                
                echo '<div class="row">';
                $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                $statement->execute(array($category['id']));

                while($item = $statement->fetch()) {
                    echo '<div class="col-md-6 col-lg-4">
                            <div class="img-thumbnail">
                                <img src="images/' . $item['image'] . '" alt="...">
                                <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                                <div class="caption">
                                    <h4>' . $item['name'] . '</h4>
                                    <p>' . $item['description'] . '</p>
                                    <a href="#" class="btn btn-order" role="button"><i class="bi bi-cart4"></i> Commander</a>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div>
                </div>';
            }
            Database::disconnect();
            echo '</div>';
        ?>

            
    </div>
</body>
</html>