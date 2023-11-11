<?php
    require_once '../classes/products.class.php';
    require_once '../tools/functions.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect data from the AJAX request
        $name = htmlentities($_POST['name']);
        $category = htmlentities($_POST['category']);
        $price = htmlentities($_POST['price']);
        $availability = htmlentities($_POST['availability']);

        $products = new Products();
        $products->name = $name;
        $products->category = $category;
        $products->price = $price;
        $products->availability = $availability;

        if ($products->add()) {
            echo "success";
        } else {
            echo "Failed to add products.";
        }
    }

?>