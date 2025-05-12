
<?php
@include 'config.php';

if (isset($_POST['search'])) {
    $search_box = $_POST['search'];
    $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%' OR category LIKE '%{$search_box}%'");
    $select_products->execute();

    $results = [];

    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        $results[] = $fetch_products;
    }

    echo json_encode($results);
    exit;
}

?>
