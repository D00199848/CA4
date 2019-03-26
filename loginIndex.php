<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
// Get name for selected category
$queryCategory = 'SELECT * FROM companies
                  WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();


// Get all companies
$query = 'SELECT * FROM companies
                       ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$companies = $statement->fetchAll();
$statement->closeCursor();

// Get products for selected category
$queryProducts = 'SELECT * FROM products
                  WHERE categoryID = :category_id
                  ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>

<?php
include('includes/header.php');
?>

<header><center><h1>Product List</h1></center></header><br>

<div class="dropdown" style="float: left">
  <button class="dropbtn">Welcome Back</button>
  <div class="dropdown-content">
    <a href="reset-password.php" class="btn btn-warning">Reset Password</a>
    <a href="logout.php" class="btn btn-danger">Sign Out</a>
  </div>
</div>
<br>
<center><h1>Curious to see what your phone is worth? Or you're maybe looking for a new one?Check below to find out more!<br><br></h2></center>
<aside>
    <!-- display a list of companies -->
    <div id="flip"><h2>Categories</h2></div>
    <div id="panel">
        <nav>
            <ul>
                <?php foreach ($companies as $category) : ?>
                    <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                            <?php echo $category['categoryName']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </nav>    
    </div>  

</aside>

<section>
    <!-- display a table of products -->
    <br>
    <h2><?php echo $category_name; ?></h2>
    <table>
        <tr>
            <th><center>Name</center></th>
        <th>Storage</th>
        <th>Price</th>
        <th>Delete</th>
        <th>Edit</th>
        </tr>

        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productName']; ?></td>
                <td><center><?php echo $product['storage']; ?></center></td>
            <td><center><?php echo $product['price']; ?></center></td>
            <td><form action="delete_product.php" method="post">
                    <input type="hidden" name="product_id"
                           value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $product['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
            <td><form action="edit_product_form.php" method="post">
                    <input type="hidden" name="productID"
                           value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="categoryID"
                           value="<?php echo $product['categoryID']; ?>">
                    <input type="submit" value="Edit">
                </form></td>
            </tr>
        <?php endforeach; ?>
    </table>

</section>

</main>
<br>

<div class="container">
    <center><h2>Hottest Products!</h2></center>

    <center><form name="toDoList">
            <input type="text" name="ListItem"/>
        </form>

        <div id="button">Add</div>
        <br/>
        <ol></ol></center>



</div>

<?php
include('includes/footer.php');
?>
