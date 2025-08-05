<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$title = $lang['products_list']; // Set the title for the page
require 'includes/header.php'; // Include header file for HTML structure
require 'includes/menu.php'; // Include navbar file for navigation  

function getCategoryName($categoryId) {
    global $conn;
    $sql = "SELECT name FROM categories WHERE id = {$categoryId}";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        return htmlspecialchars($row['name']);
    }
    return 'Unknown Category';
}
// Fetch categories from database
$addedCondition = ''; // Initialize additional condition for SQL query

if(isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $categoryId = (int)$_GET['category_id'];
    $addedCondition = " AND products.category_id = $categoryId";

}
//pager

$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate offset for SQL query
$totalResult = $conn->query("SELECT COUNT(*) as total FROM products where name like '%" . $conn->real_escape_string($_GET['search'] ?? '') . "%'" . $addedCondition);
$totalRow = $totalResult->fetch_assoc();    
$total = $totalRow['total']; // Total number of records
$totalPages = ceil($total / $limit); // Total number of pages
 
?>
 
<a href="/ourproject/all_products_csv.php?csv=true" class="btn btn-success mb-3">
    CSV Download
    <i class="fas fa-file-csv"></i>
</a>

<form action="" method="get">
    <input type="search" name="search" placeholder="Search products..."
     class="form-control" style="width: 300px; display: inline-block;">
     <select class="" id="category_id" name="category_id" style="padding: 7px;
    border-radius: 5px;
    border: solid 1px #ccc;" required>
            <option value=""><?php echo $lang['select_category']; ?></option>
            <?php
            // Fetch categories from database
            $sql = "SELECT * FROM categories ORDER BY name ASC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                }
            }
            ?>
        </select>
     <input type="submit" value="<?php echo $lang['search']; ?>" class="btn btn-primary">
    <a href="products_list.php" class="btn btn-secondary"><?php echo $lang['reset']; ?></a>
</form>
<?php
$sql = "SELECT products.*,categories.name as catname, categories.name_ar as catname_ar FROM `products` 
left JOIN categories on products.category_id = categories.id
where products.name like '%" . $conn->real_escape_string($_GET['search'] ?? '') . "%'" . $addedCondition . "

order by products.id asc
limit $limit offset $offset
";
//die($sql);
$result = $conn->query($sql);?>
<form action="mass_delete_action_products.php" method="post">
<div class="container mt-5">
    <h2><?php echo $title; ?></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><?php echo $lang['id']?></th>
                <th><?php echo $lang['name']?></th>
                <th><?php echo $lang['category']?></th>
                <th><?php echo $lang['description']?></th>
                <th><?php echo $lang['price']?></th>
                <th><?php echo $lang['featured']?></th>
                <th><?php echo $lang['image']?></th>
                <th><?php echo $lang['actions']?></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()){ ?>
                <tr id="product-<?php echo $row['id']; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo ($language == 'ar') ? $row['catname_ar'] : $row['catname']; ?></td>
                    <td><?php echo mb_substr($row['description'], 0, 100) . '...' ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo ($row['featured'] == 1) ? 'Yes' : 'No'; ?> </td>
                    <td>
                        <?php if (!empty($row['image'])) {?>
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100">
                        <?php }?>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        <input type="checkbox" name="ides[]" value="<?php echo $row['id']; ?>" class="form-check-input">
                        <a href="javascript:void(0);" onclick="delete_product(<?php echo $row['id']; ?>)" class="btn btn-danger">Delete via JS</a>
                    </td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>
    <input type="submit" name="mass_delete" value="Mass Delete" class="btn btn-danger">
                        </form>
</div>
<div class="text-center mt-4">
    <?php if($page >1 ){ ?>
        <a href="?page=<?php echo $page - 1; ?>" class="btn btn-primary">Previous</a>
    <?php } ?>
    <?php if($page < $totalPages ){ ?>
        <a href="?page=<?php echo $page + 1; ?>" class="btn btn-primary">Next</a>
    <?php } ?>
</div>    
<?php
require 'includes/footer.php'; // Include footer file for closing HTML tags     
?>
