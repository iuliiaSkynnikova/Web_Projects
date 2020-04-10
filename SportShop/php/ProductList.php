<?php
    
    require_once("classes/DBConnect.php");
    require_once("classes/ShoppingCart.php");
    require_once("classes/CartItem.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $DB->connect();
    $sql = "SELECT * FROM item";
    
    if (isset($_GET["search"])) {
        $searchText = $_GET["search"];
        $sql = $sql . " WHERE ItemName like '%" . $searchText . "%'";
    } else {
        $category = isset($_GET["category"]) ? $_GET["category"] : '1'; 
        $sql = $sql . " WHERE CategoryId = " . $category;
        if (isset($_GET["subcategory"])) {
            $sql = $sql . " and SubcategoryId = " . $_GET["subcategory"];
        }

    }

    $sql = $sql . " and Active = 1";

    $subcategorySql = "SELECT * FROM subcategory Where Active = 1";
    $subcategoryRows = $DB->executeSQL($subcategorySql)->fetchAll();

    session_start();
    $shoppingCart = new ShoppingCart();
    $shoppingCart->readFromSession();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Product list</title>
    <link rel="icon" href="images/logo-sports-shop-v1.gif" >
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/modernizr-custom.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/date.js"></script>
</head>
<body>
	<header >
		<div class="wrapper">
           
		    <a href="HomePage.php"><img src="images/logo-sports-shop-v1.gif" width="108" height="83" alt="Sport Gear Logo"></a>
		    <a class="shoppingBag" href="Checkout.php">
            <img src="images/red-shopping-bag-md.png" width="108" height="83" alt="Shopping bag image">
            <div id="checkout">
                <p> <?php echo $shoppingCart->count() ?> item/s</p>
                <p> $<?php echo $shoppingCart->calculateTotal() ?></p>
                <h5>CHECKOUT</h5>
            </div>
        </a>
            <form id="searchForm" action="ProductList.php" method="get" >
                <input class="searchText" type="text" name="search" id="search" placeholder="What are you looking for?">
                <input class="searchButton" type="submit" name="submitButton" value="Search">
            </form> 
		</div>


    <nav class="mainNave">
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li  <?php echo (isset($category) && $category == 1 ? 'class="active"' : '') ?> >
                <a href="ProductList.php?category=1">Sport for Women</a>
                <ul class="submenu">
                <?php foreach ($subcategoryRows as $scRow) { ?>
                    <li>
                        <a href="ProductList.php?category=1&subcategory=<?php echo $scRow["SubcategoryId"] ?>">
                            <?php echo $scRow["SubcategoryName"] ?>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </li>
            <li <?php echo isset($category) && $category == 2 ? 'class="active"' : '' ?>>
                <a href="ProductList.php?category=2">Sport for Men</a>
                <ul class="submenu">
                    <?php foreach ($subcategoryRows as $scRow) { ?>
                        <li>
                            <a href="ProductList.php?category=2&subcategory=<?php echo $scRow["SubcategoryId"] ?>">
                                <?php echo $scRow["SubcategoryName"] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li <?php echo isset($category) && $category == 3 ? 'class="active"' : '' ?>>
                <a href="ProductList.php?category=3">Sport for Kids</a>
                <ul class="submenu">
                    <?php foreach ($subcategoryRows as $scRow) { ?>
                        <li>
                            <a href="ProductList.php?category=3&subcategory=<?php echo $scRow["SubcategoryId"] ?>">
                                <?php echo $scRow["SubcategoryName"] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="ContactUs.php">Contact us</a></li>
        </ul>
    </nav>
 
</header>

<section class="wrapper category">
    <ul>
<?php
    $rows = $DB->executeSQL($sql);
    foreach ($rows as $row) {
        
        if($row["CategoryId"] == "1"){
            $folder = "Women";
        } 
        else if ($row["CategoryId"] == "2") {
            $folder = "Men";
        }
        else if ($row["CategoryId"] == "3") {
            $folder = "Kids";
        }
        $photo = "images/" . $folder . "/". $row["Photo"];
        $link = "ProductDescription.php?itemId=" . $row["ItemId"];
?>
        <li>
            <a href="<?php echo $link?>">
                <img src="<?php echo $photo ?>" width="230" height="230" alt="Photo of <?php echo $row["ItemName"] ?>" >
                <p class="pItem"><?php echo $row["ItemName"] ?></p>
                <p class="pItem"><strong><?php echo $row["Price"] ?>$ </strong></p>
                <p class="infoButton">more info <img src="images/arrow.png" width="10" height="10" alt="arrow"></p>
            </a>
        </li>   


<?php
    }
    $DB->disconnect();
?> 
    </ul> 
</section>

<footer>
    <nav class="footerNav clearFix wrapper">
           <ul class="toright">
            <li><a href="https://www.facebook.com/" target="_blank"><img src="images/icon-facebook.png" width="20" height="20" alt="Facebook"></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><img src="images/icon-instagram.png" width="20" height="20" alt="Instagram"></a></li>
            <li><a href="https://twitter.com/" target="_blank"><img src="images/icon-twitter.png" width="20" height="20" alt="Twitter"></a></li>
        </ul>


        <ul class="toleft">
            <li>Copyright 2017 Sport Gear |</li>
            <li><a href="ContactUs.php">Contact us |</a></li>
            <li><a href="Login.php">Login</a></li>
         </ul>
        <div id="datetime"></div>
    </nav>
</footer>

</body>
</html>