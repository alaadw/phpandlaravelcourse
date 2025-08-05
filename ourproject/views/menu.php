<?php
 $count = "select count(*) as total from cart where user_id = {$_SESSION['user']['id']}";
 $result = $conn->query($count);
 $cartCount = $result->fetch_assoc()['total'];
$options = [
  "ssl" => [
    "verify_peer" => false,
    "verify_peer_name" => false,
  ]
];

$context = stream_context_create($options);
$url = "https://api.open-meteo.com/v1/forecast?latitude=35.6895&longitude=139.6917&current_weather=true";

$response = file_get_contents($url, false, $context);
$data = json_decode($response, true);
$allCategories = "select * from categories order by name asc";
$categoriesResult = $conn->query($allCategories);

    
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><?php echo $lang['site_name']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="allproducts.php"><?php echo $lang['products_list']; ?></a>
                    </li>
                   

                    <!-- --all categories -->
                    <?php while ($category = $categoriesResult->fetch_assoc()) { ?>
                     <li class="nav-item">
                        <a class="nav-link" href="allproducts.php?id=<?php echo $category['id']; ?>">
                            <?php echo ($language == 'en') ? htmlspecialchars($category['name']) : htmlspecialchars($category['name_' . $language]); ?>
                        </a></li>
                    <?php } ?> 
                     <li class="nav-item">
                        <a class="nav-link" href="mycart.php"><?php echo $lang['my_cart']; ?></a>
                    </li>  
                    <li class="nav-item">
                    <a href="mycart.php" class="btn btn-outline-dark">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill" id="sumofitems"><?php echo $cartCount; ?></span>
                        </a>
                    </li>  
                    <li>
                        <?php
                         /** date function embeded from php language 
                          * date() : y is part of year Y full year 
                          *  m : month in numbers  
                          * d is date 
                          * D is date in name 
                          */
                        ?>
                         <span class="m-3" style="font-size:12px">
                            <?php 
                               $date = date('Y / M / D');
                               if($language == 'ar') {
                                   $date = str_ireplace(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'], ['كانون الثاني', 'شباط', 'آذار', 'نيسان', 'أيار', 'حزيران', 'تموز', 'آب', 'أيلول', 'تشرين الأول', 'تشرين الثاني', 'كانون الأول'], $date);
                                   $date = str_ireplace(['Sat','Sun','Mon','Tue','Wed','Thu','Fri'], ['السبت','الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'], $date);
                                }
                              echo $date; 
                             ?>
                        
                        </span>
                    </li>
                    <li>
                        <?php echo $data['current_weather']['temperature'] . " °C" ?>
                    </li>  
                    
                   
                </ul>

        </div>
    </nav>
    
        
   