<?php
require_once '../classes/products.class.php';
require_once '../tools/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $products = new Products();

    // Fetch staff data (you should modify this to retrieve data from your database)
    $productsArray = $products->show();
    $counter = 1;
?>
<?php
    if ($productsArray) {
        foreach ($productsArray as $item) {
?>
            <tr>
                <td><?= $counter ?></td>
                <td><?= $item['name']?></td>
                <td><?= $item['category'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['availability'] ?></td>
                <td class="text-center"><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            </tr>
<?php
            $counter++;
        }
    }
}
?>