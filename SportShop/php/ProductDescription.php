<?php 
	
	require_once("classes/DBConnect.php");
    require_once("classes/ShoppingCart.php");
    require_once("classes/CartItem.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $DB->connect();
    
    $itemId = isset($_POST["itemId"]) ? $_POST["itemId"] : $_GET["itemId"];
	$sql = "SELECT * FROM item WHERE ItemId=" . $itemId;
	$item = $DB->executeSQLReturn1($sql);
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

        $subcategorySql = "SELECT * FROM subcategory Where Active = 1";
        $subcategoryRows = $DB->executeSQL($subcategorySql)->fetchAll();
    }
    $DB->disconnect();

    session_start();
    $shoppingCart = new ShoppingCart();
    $shoppingCart->readFromSession();

    if(isset($_POST["add"])){
        $cartItem = new CartItem($item["ItemName"], $_POST["qty"], $_POST["size"], $item["Price"], $item["ItemId"]);
        $shoppingCart->addItem($cartItem);
        $shoppingCart->saveToSession();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Product Description</title>
    <link rel="icon" href="images/logo-sports-shop-v1.gif" >
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/modernizr-custom.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/date.js"></script>
    <script src="js/jquery.elevatezoom.js"></script>

</head>
<body>
<header>
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
            <li>
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
            <li><a href="ProductList.php?category=2">Sport for Men</a>
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
            <li><a href="ProductList.php?category=3">Sport for Kids</a>
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


<section class="wrapper clearFix">
    <form action="ProductDescription.php" method="POST">
        <input type="hidden" name="itemId" value="<?php echo $item['ItemId'] ?>">
    	<aside id="extraInfo">
    		<h1><?php echo $item["ItemName"] ?></h1>
    		<p><?php echo $item["Description"] ?></p>
    		<h2><?php echo $item["Price"] ?>$ </h2>
    		<p>
    			<label class="lableItem" for="size"> Size: </label>
    			<select name="size" id="size">
    				<option selected>6</option>
    				<option>8</option>
    				<option>10</option>
    				<option >12</option>
    				<option>14</option>
    				<option>18</option>
    			</select>
    		</p>
    		<p>
    			<label class="lableItem" for="qty">Qty:</label>
    			<input type="number" name="qty" id="qty" value="1">
    		</p>
    		<p>
            	<input class="submit" type="submit" id="buy" name="add" value="Add to cart">
       		 <p>
    	</aside>

    	<div id="ItemImg" >
    		<img id="zoom_05" src="<?php echo $photo ?>" width="400" height="400" data-zoom-image="<?php echo $photo ?>" alt="Photo of <?php echo $item["ItemName"] ?>" >
    	</div>	
    </form>

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

<script>$("#zoom_05").elevateZoom({
	zoomType: "inner", cursor: "crosshair"
});
</script>

</body>
</html>