<?php
    
    require_once("classes/DBConnect.php");
    require_once("classes/ShoppingCart.php");
    require_once("classes/CartItem.php");
    $DB = new DBConnect("mysql:host=localhost; dbname=sportgear", "root", "");
    $DB->connect();
   
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
    <title>Contact us</title>
    <link rel="icon" href="images/logo-sports-shop-v1.gif" >
    <link rel="stylesheet" href="css/style.css">
    <script src="js/modernizr-custom.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/date.js"></script>
    <script src="js/validation.js"></script>
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
            <li class="active"><a href="ContactUs.php">Contact us</a></li>
        </ul>
    </nav>
</header>

<form class="wrapper" id="contactUs" method="post" action="SendEmail.php">
    <fieldset>
        <legend>Contact us</legend>
        <p class="contact">
            <label for="firstname">First name:*</label>
            <input type="text" id="firstname" name="firstname"  placeholder="John" required="" autofocus="" >
        </p>
        <p class="contact">
            <label for="lastname">Last name:*</label>
            <input type="text" id="lastname" name="lastname"   placeholder="Smith" required="" >
        </p>
        <p class="contact">
            <label for="phone">Contact number:*</label>
            <input type="text" name="phone" id="phone" placeholder="02 9988 7766" required="">
        </p>
        <p class="contact">
            <label for="email">Email address:*</label>
            <input type="email" name="email" id="email" placeholder="john.smith@gmail.com" required="">
        </p>
        <p class="contact">
            <label class="q" for="question">Question:*</label>
            <textarea class="q" name="question" id="question" cols="50" rows="5" required=""></textarea>
        </p>
    </fieldset>

    <p class="center">
        <input type="submit" class="submit" name="submit" value="Send">
    <p>

</form>
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